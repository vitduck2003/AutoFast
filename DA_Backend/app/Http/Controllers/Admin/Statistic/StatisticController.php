<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Staff;
// use App\Http\Controllers\Admin\Staff\StaffController;
// use App\Http\Controllers\Admin\Account\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\SessionGuard;

class StatisticController extends Controller
{
    
    public function index()
    {
        $total_user = User::count('id');
        $total_staff = Staff::count('id');
        return view('admin.pages.statistic.index', compact('total_user', 'total_staff'));
    }
}