<?php

namespace App\Http\Controllers;

use App\Models\ResetPasswordModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AuthentifikasiController extends Controller
{
    public function login() {
        $rememberDevice = Cookie::get('remember_device', false);
        return view('login', compact('rememberDevice'));
    }

    public function loginsubmit(Request $request) {
        $this->validate($request,
            ['id_card'              => 'required','password' => 'required'],
            ['id_card.required'     => 'ID Card Wajib diisi'],
            ['password.required'    => 'Password Wajib diisi'],
        );

        if ($request->has('remember_device')) {
            Cookie::queue(Cookie::forever('remember_device', json_encode($request->all())));
        } else {
            Cookie::queue(Cookie::forget('remember_device'));
        }
        if (Auth::attempt($request->only(['id_card','password']))) {
            Alert::success('Success', 'Login Berhasil');
            return redirect(route('dashboard.'. User::role($request->id_card)));
        } else {
            Alert::error('Gagal', 'Username Atau Password Salah');
            return redirect(route('login'));
        }
    }


    public function logout() {
        Alert::success('Success', 'logout Berhasil !');
        Auth::logout();
        return redirect(route('login'));
    }
}
