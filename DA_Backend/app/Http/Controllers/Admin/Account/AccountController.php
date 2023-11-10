<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\SessionGuard;

class AccountController extends Controller
{

    public function index()
    {

        $users = User::orderBy('role_id', 'desc')->get();
        return view('admin.pages.users.index', compact('users'));
    }

    public function remove($id)
    {
        $model=User::find($id);
        if(!empty($model->avatar)){
            $imgPath = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($imgPath);
        }
        $model->delete();
        return redirect(route('user.index'));
    }
    
}

