<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Http\Services\user\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function index()
    {
        return view("login.change-pass",[
            'title'=>'Đổi mật khẩu'
        ]);
    }

    public function store(Request $request)
    {
        $change = $this->userService->changePass($request);
        if($change){
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->back();
    }

    public function forgot()
    {
        return view("login.forgot",[
            'title'=>'Lấy lại mật khẩu'
        ]);
    }

    public function resetPass(Request $request)
    {
        $reset = $this->userService->resetPass($request->input('email'));
        if($reset){
            return redirect()->route('login');
        }
        return redirect()->back();
    }
}
