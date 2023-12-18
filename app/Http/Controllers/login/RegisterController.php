<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\user\UserClientService;

class RegisterController extends Controller
{

    protected UserClientService $userService;

    public function __construct(UserClientService $userService)
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
