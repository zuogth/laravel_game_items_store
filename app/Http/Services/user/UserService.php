<?php

namespace App\Http\Services\user;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function create($request)
    {
        try{
            $user=User::create([
                'full_name'=>(string)$request->input('fullname'),
                'phone'=>(string)$request->input('phone'),
                'email'=>(string)$request->input('email'),
                'password'=>bcrypt((string)$request->input('password')),
                'role'=>'KH',
                'status'=>'1'
            ]);
            Session::flash('success','Bạn đăng ký thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function findByEmail($email)
    {
        return User::where('email','=',$email)->first();
    }

    public function updateDetail($id,$request)
    {
        $user=User::find($id);
        $user->fullname=$request->fullname;
        $user->phone=$request->phone;
        $address=$request->province.'-'.$request->district.'-'.$request->ward.'-'.$request->village;
        $user->address=$address;
        $user->usercode=Str::slug($request->fullname,'-');
        $user->save();
        return true;
    }

    public function changePass($id,$new_pass)
    {
        $user=User::find($id);
        $user->password=bcrypt($new_pass);
        $user->save();
        return true;
    }
}
