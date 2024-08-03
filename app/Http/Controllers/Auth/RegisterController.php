<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index() {
        // Hiển thị view trang đăng ký
        return view('auth.register');
    }

    public function register(Request $request) {
        // Xử lý logic đăng ký
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // Thêm giá trị mặc định cho trường `type`
        $data['type'] = 'member';

        // Tạo người dùng mới
        $user = User::query()->create($data);

        // // Gửi email xác nhận
        // $token = base64_encode($user->email);
        // Mail::to($user->email)->send(new VerifyEmail($token, $user->name));

        // Đăng nhập với người dùng vừa tạo
        Auth::login($user);

        // Sinh lại token cho người dùng vừa đăng nhập
        $request->session()->regenerate();

        // Quay lại trang phía trước
        return redirect()->intended('/');
    }
}
