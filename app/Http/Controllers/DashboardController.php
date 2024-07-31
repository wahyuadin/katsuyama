<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function dashboardProfilePut(Request $request, $id) {
        $this->validate($request, [
            'nama'          => 'required|max:255',
            'id_card'       => 'required|max:20',
            'foto_profile'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password_lama' => 'nullable|min:8',
            'password'      => 'nullable|min:8',
            'repassword'    => 'nullable|same:password',
        ]);
        $data = $request->except('password_lama','__token','repassword');

        if ($request->filled('password_lama')) {
            if (!Hash::check($request->password_lama, Auth::user()->password)) {
                return redirect()->back()->withErrors('Password lama tidak sesuai.');
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            $existingData = User::find(Auth::user()->id);
            if ($existingData && $existingData->foto_profile) {
                $previousFilePath = public_path('assets/img/profile/') . $existingData->foto_profile;
                if (file_exists($previousFilePath)) {
                    // unlink($previousFilePath);
                }
            }

            $file = $request->file('foto_profile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile/'), $fileName);
            $data['foto_profile'] = $fileName;
        }

        if (User::find($id)->update($data)) {
            Alert::success('Berhasil','Data Berhasil Diupdate!');
            return redirect()->back();
        }
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
        if (User::create($data)) {
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

    // Loading
    public function dashboardLoading() {
        return view('loading.dashboard');
    }

    public function ProfileLoading() {
        return view('loading.profile');
    }

    // packing
    public function dashboardPacking() {
        return view('packing.dashboard');
    }

    public function ProfilePacking() {
        return view('packing.profile');
    }

}
