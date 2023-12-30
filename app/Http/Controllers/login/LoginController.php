<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Http\Services\user\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('login.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->status != 0) {
                return redirect()->route('home');
            } else {
                Auth::logout();
                Session::flash('error', 'Tài khoản đã bị khóa');
                return redirect()->back();
            }
        }

        Session::flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->back();
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->roles == 'QL') {
                Auth::logout();
                return redirect()->route('login');
            }
        }
        Auth::logout();
        return redirect()->route('home');
    }
}
