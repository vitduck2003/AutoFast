<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    //
    public function index()
    {
        $staffs = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where('users.role_id', '=', 2)
            ->whereNull(['users.deleted_at', 'staff.deleted_at'])
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->get();
        return view('admin/pages/staffs/staffs', compact('staffs'));
    }
    public function showDetail($id)
    {
        $staff = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where([
                ['users.role_id', '=', 2],
                ['staff.id', '=', $id]
            ])
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->first();
        return view('admin/pages/staffs/staffEdit', compact('staff'));
    }
    public function formAdd()
    {
        $users = User::all()->where('role_id', '=', 3);
        return view('admin/pages/staffs/staffFormAdd');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
                'description' => 'max:255',
                'salary' => 'required|integer',
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu không nhỏ hơn 6 chữ số',
                'salary.required' => 'Vui lòng nhập Lương.',
            ];

            $validatedData = $request->validate($rules, $messages);
            $checkemail = User::where('email', $validatedData['email'])->exists();
            $checkphone = User::where('phone', $validatedData['phone'])->exists();
            if ($checkemail) {
                return redirect()->route('show.form.add')->with('warning', 'Email đã tồn tại');
            }
            if ($checkphone) {
                return redirect()->route('show.form.add')->with('warning', 'Số điện thoại đã tồn tại');
            }

            $user = new User();            
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->email = $validatedData['email'];
            $user->role_id = 2;
            $user->password = Hash::make($validatedData['password']);
            $user->description = $validatedData['description'];
            
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::delete($user->avatar);
                }
                $path = $request->file('avatar')->store('public/avatar');
                $path=substr($path, 7);
                $user->avatar = $path;
            }
            $user->save();

            $staff=Staff::Create([
                'salary'=>$validatedData['salary'],
                'review' => '',
                'status' =>'Đang đợi việc',
                'id_user' => $user->id,
            ]);
            return redirect()->route('staff')->with('message', 'Thêm thành công');

        }
    }
    public function update(Request $request, $id)
    {

        if ($request->isMethod('PUT')) {
            $rules = [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'address' => 'max:255',
                'description' => 'max:255',
                'salary' => 'required|integer',
                'status' => 'required|string|max:255',
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'salary.required' => 'Vui lòng nhập Lương.',
                'status.required' => 'Vui lòng nhập trạng thái.',
            ];

            $validatedData = $request->validate($rules, $messages);
            $staff = Staff::findOrFail($id);
            $user = User::findOrFail($staff->id_user);
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::delete('public/' . $user->avatar);
                }
                $path = $request->file('avatar')->store('public/avatar');
                $path=substr($path, 7);
                $user->avatar = $path;
            }
            $staff->update($validatedData);
            $user->update($validatedData);
            return redirect()->route('showDetail', ['id' => $staff->id])->with('message', 'Sửa thành công');

        }
    }
    public function remove($id)
    {
        $staff = Staff::findOrFail($id);
        $user = User::findOrFail($staff->id_user);
        $staff->delete();
        $user->delete();
        if ($staff && $user) {
            return redirect()->route('staff')->with('message', 'Xóa thành công');
        }
    }
    public function searchUser()
    {
        $user = User::search()->where('role_id', '=', 3)->get();
        return $user;
    }
    public function preview($id)
    {
        $users = DB::table('users')->where([
            ['role_id', '=', 3],
            ['id', '=', $id]
        ])->first();
        return response()->json($users);
    }
    public function showClient()
    {
        $staff = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where('users.role_id', '=', 2)
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->get();
        return response()->json($staff);
    }
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu không nhỏ hơn 6 chữ số'
            ];

            $validatedData = $request->validate($rules, $messages);
            $checkemail = User::where('email', $validatedData['email'])->exists();
            $checkphone = User::where('phone', $validatedData['phone'])->exists();
            if ($checkemail) {
                return response()->json(['message' => 'Email đã tồn tại', 'success' => false], 200);
            }
            if ($checkphone) {
                return response()->json(['message' => 'Số điện thoại đã tồn tại', 'success' => false], 200);
            }
            $user = User::create([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role_id' => 2,
                'password' => Hash::make($validatedData['password']),
            ]);
            
            $staff=Staff::Create([
                'salary'=>0,
                'review' => '',
                'status' => '',
                'id_user' => $user->id,
            ]);
            if($user->id & $staff->id){
                return redirect()->route('auth')->with('message', 'Đăng ký thành công');
            }
        }
    }
    public function StaffAction(){
        $staffs = DB::table('users')
        ->join('staff', 'users.id', '=', 'staff.id_user')
        ->where([
            ['users.role_id', '=', 2],
            ['staff.status','=','Nghỉ']
        ])
        ->whereNull(['users.deleted_at', 'staff.deleted_at'])
        ->select(
            'staff.*',
            'users.name',
            'users.password',
            'users.avatar',
            'users.email',
            'users.phone',
            'users.description',
            'users.address'
        )
        ->get();
    return view('admin/pages/staffs/staffAction', compact('staffs'));
    }
    public function restore($id){
        $staff=DB::table('staff')->where('id', $id)->update(['status'=>'Đang chờ việc']);
        if($staff){
            return redirect()->route('staff-action')->with('message', 'Khôi phục thành công');
        }else{
            return redirect()->route('staff-action')->with('error', 'Khôi phục không thành công');

        }
    }
    public function showRegister(){
        return view('admin/pages/auth/register');
    }
    public function showJobStaff(){
        $staffs=DB::table('staff')
        ->join('users', 'users.id','=','staff.id_user')
        ->select('staff.*','users.name','users.avatar','users.description')
        ->get();
        return view('admin/pages/staffs/staffjob',compact('staffs'));
    }
    public function showJobByStaff($id){

        $jobs = DB::table('jobs')
        ->join('booking', 'booking.id','=','jobs.id_booking')
        ->where('jobs.id_staff', $id)
        ->select('jobs.*','booking.name','booking.target_date','booking.target_time')
        ->get();
        foreach ($jobs as $job) {
            $booking = DB::table('booking')
                ->where('id', $job->id_booking)
                ->first();
        
            if ($booking) {
                $model_car = $booking->model_car;
                $job->model_car = $model_car;
            }
        }
        return view('admin/pages/staffs/jobBystaff',compact('jobs'));
    }
    public function staffDetail($id)
    {
        $staff = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where([
                ['users.role_id', '=', 2],
                ['staff.id', '=', $id]
            ])
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->first();
        return view('admin/pages/staffs/detailStaff', compact('staff'));
    }
}