<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PackingController extends Controller
{
    public function adminPacking() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.packing', [
            'data'  => Packing::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    public function adminPackingEdit(Request $request, $id) {
        $this->validate($request, [
            'qty_ok'    => 'required|numeric',
            'qty_ng'    => 'required|numeric',
            'remark'    => 'required|max:50'
        ]);

        if (Packing::ubah($id, $request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Di Update!');
            return redirect()->back();
        }
    }

    public function adminPackingHapus($id) {
        if (Packing::hapus($id)) {
            Alert::success('Berhasil', 'Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }
}
