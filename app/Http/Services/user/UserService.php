<?php

namespace App\Http\Services\user;

use App\Mail\MailResetPW;
use App\Mail\MyMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{

    public function create($request)
    {
        try {
            $user = $this->findByEmail((string)$request->input('email'));
            if($user){
                Session::flash('error', 'Email này đã được đăng ký');
                return false;
            }
            User::create([
                'full_name' => (string)$request->input('fullname'),
                'phone' => (string)$request->input('phone'),
                'email' => (string)$request->input('email'),
                'password' => bcrypt((string)$request->input('password')),
                'role' => 'KH',
                'status' => '1'
            ]);
            Session::flash('success', 'Bạn đã đăng ký thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function findByEmail($email)
    {
        return DB::table('USER')
        ->where('email', '=', $email)->first();
    }

    public function updateDetail($id, $request)
    {
        $user = User::find($id);
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $address = $request->province . '-' . $request->district . '-' . $request->ward . '-' . $request->village;
        $user->address = $address;
        $user->usercode = Str::slug($request->fullname, '-');
        $user->save();
        return true;
    }

    public function changePass($request)
    {
        try {
            $user = User::find((string)$request->input('id-user'));
            if(!$user){
                Session::flash('error','Không thấy thông tin tài khoản');
                return false;
            }
            if(!Hash::check((string)$request->input('password'),$user->password)){
                Session::flash('error','Mật khẩu nhập không chính xác');
                return false;
            }
            $user->password = bcrypt((string)$request->input('password-new'));
            $user->save();

        }catch (\Exception $ex){
            Log::error($ex->getTraceAsString());
            Session::flash('error','Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        Session::flash('success','Thay đổi mật khẩu thành công, hãy đăng nhập lại');
        return true;
    }

    public function resetPass($email)
    {
        try {
            $user = $this->findByEmail($email);
            if(!$user){
                Session::flash('error','Email này chưa được đăng ký trên hệ thống');
                return false;
            }
            $user = User::find($user->id);
            $password = Str::random(6);
            $user->password = bcrypt($password);
            $user->save();

            Mail::to($email)->send(new MailResetPW($email,$password));

        }catch (\Exception $ex){
            Log::error($ex->getTraceAsString());
            Session::flash('error','Có lỗi xảy ra, xin thử lại sau!');
            return false;
        }
        Session::flash('success','Yêu cầu lấy lại mật khẩu đã được gửi tới email');
        return true;
    }
}
