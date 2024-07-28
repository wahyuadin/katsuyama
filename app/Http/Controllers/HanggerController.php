<?php

namespace App\Http\Controllers;

use App\Models\Hangger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HanggerController extends Controller
{
    public function OperatorLoadingHanger() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('loading.hangger', [
            'data'      => Hangger::show_by_id(Auth::user()->id),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function OperatorLoadingHangerTambah(Request $request) {
        $this->validate($request, [
            'user_id'   => 'required',
            'type'      => 'required',
            'qty'       => 'required|numeric'
        ]);

        if (Hangger::create($request->except('__token'))) {
            Alert::success('Berhasil','Data Berhasil Di Tambah!');
            return redirect()->back();
        }
    }

    public function OperatorLoadingHangerEdit(Request $request, $id) {
        $this->validate($request, [
            'type'      => 'required',
            'qty'       => 'required|numeric'
        ]);

        if (Hangger::find($id)->update($request->except('__token'))) {
            Alert::success('Berhasil','Data Berhasil Di Edit!');
            return redirect()->back();
        }
    }

    public function OperatorLoadingHangerHapus($id) {
        if (Hangger::find($id)->delete()) {
            Alert::success('Berhasil','Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }
}
