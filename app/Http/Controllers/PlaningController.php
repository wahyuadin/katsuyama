<?php

namespace App\Http\Controllers;

use App\Models\Planing;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PlaningController extends Controller
{
    public function adminPlaning() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.planing', [
            'data'      => Planing::show_all(),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function adminPlaningTambah(Request $request) {
        $this->validate($request, [
            'user_id'   => 'required',
            'tanggal'   => 'required|date',
            'part_no'   => 'required|max:30',
            'part_name' => 'required|max:30',
            'qty'       => 'required'
        ]);

        if (Planing::tambah($request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah!');
            return redirect()->back();
        }
    }

    public function adminPlaningEdit(Request $request, $id) {
        $this->validate($request, [
            'user_id'   => 'required',
            'tanggal'   => 'required|date',
            'part_no'   => 'required|max:30',
            'part_name' => 'required|max:30',
            'qty'       => 'required'
        ]);

        if (Planing::ubah($id, $request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Di Rubah!');
            return redirect()->back();
        }
    }

    public function adminPlaningHapus($id) {
        if (Planing::hapus($id)) {
            Alert::success('Berhasil', 'Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }
}
