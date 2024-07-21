<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller

{
    // Admin
    public function dashboardAdmin() {
        return view('admin.dashboard');
    }

    public function dashboardProfile() {
        return view('admin.profile', ['faker' => Faker::create()]);
    }

    public function dashboardUser() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.user', ['data' => User::show_all()]);
    }

    public function dashboardUserTambah(Request $request) {
        $this->validate($request, [
            'nama'      => 'required',
            'id_card'   => 'required',
            'role'      => 'required',
        ]);

        $data               = $request->all();
        $data['password']   = Hash::make('katsuyama2024');
        if ( User::create($data)) {
            Alert::success('Berhasil','Data Berhasil Ditambah!');
            return redirect()->back();
        }
    }

    public function dashboardUserEdit(Request $request, $id) {
        $this->validate($request, [
            'nama'      => 'required',
            'id_card'   => 'required',
            'role'      => 'required',
            'password'  => 'nullable'
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }

        if (User::find($id)->update($data)) {
            Alert::success('Berhasil','Data Berhasil Diupdate!');
            return redirect()->back();
        }
    }

    public function dashboardUserHapus($id) {
        if (User::find($id)->delete()) {
            Alert::success('Berhasil','Data Berhasil Dihapus!');
            return redirect()->back();
        }
    }
}
