<?php

namespace App\Http\Controllers;

use App\Models\Loading;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoadingController extends Controller
{
    public function adminLoading() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.loading', [
            'data'      => Loading::show_all(),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function adminLoadingEdit(Request $request, $id) {
        $this->validate($request, [
            'lot_no'    => 'required',
            'hangger'   => 'required',
            'qty_in'    => 'required'
        ]);

        if (Loading::ubah($id, $request->all())) {
           Alert::success('Berhasil','Data Berhasil Di Update!');
           return redirect()->back();
        }
    }

    public function adminLoadingHapus($id) {
        if (Loading::hapus($id)) {
            Alert::success('Berhasil','Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }
}
