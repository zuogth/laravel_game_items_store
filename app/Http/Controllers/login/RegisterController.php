<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\user\UserService;

class RegisterController extends Controller
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function store(Request $request)
    {
        $result=$this->userService->create($request);
        if($result){
            return redirect('/user/login');
        }
        return redirect()->back();
    }

    public function register()
    {
        return view('login.register',[
            'title'=>'Đăng ký tài khoản mới'
        ]);
    }
}
