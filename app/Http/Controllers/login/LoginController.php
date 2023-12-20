<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\user\UserService;

class LoginController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function index(){
        return view('login.login',[
            'title'=>'Login'
        ]);
    }

    public function store(Request $request)
    {
        $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials,$request->input('remember'))){

            $user=Auth::user();
            if($user->status!=0){
                if($user->role=='QL'){
                    return redirect()->route('admin');
                }
                return redirect()->route('home');
            }else{
                Auth::logout();
                Session::flash('error','Tài khoản đã bị khóa');
                return redirect()->back();
            }
        }

        Session::flash('error','Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->back();
    }

    public function logout()
    {
        $user = Auth::user();
        if($user){
            if ($user->roles == 'QL') {
                Auth::logout();
                return redirect()->route('login');
            }
        }
        Auth::logout();
        return redirect()->route('home');
    }
}
