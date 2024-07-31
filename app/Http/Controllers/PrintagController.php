<?php

namespace App\Http\Controllers;

use App\Models\Loading;
use App\Models\Packing;
use App\Models\Printag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PrintagController extends Controller
{
    public function adminPrintag() {
        return view('admin.printag',[
            'data'  => Packing::printag(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    // Role Loading

    public function loadingPrintag() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('loading.printag', [
            'data' => Printag::show_by_id(Auth::user()->id),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    public function loadingPrintagEdit(Request $request, $id) {
        $this->validate($request, [
            'proses'        => 'required',
            'next_proses'   => 'required',
            'lot_no'        => 'required',
            'qty'           => 'required'
        ]);

        if (Printag::find($id)->update($request->except('__token'))) {
            Alert::success('Berhasil', 'Data Berhasil Diedit!');
            return redirect()->back();
        }
    }

    public function loadingPrintagHapus($id) {
        if (Loading::find($id)->delete()) {
            Alert::success('Berhasil','Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }

    // Role Packing
    public function packingPrintag() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('packing.printag', [
            'data' => Printag::show_id_packing(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    public function packingPrintagEdit(Request $request, $id) {
        $this->validate($request, [
            'proses'        => 'required',
            'next_proses'   => 'required',
            'lot_no'        => 'required',
            'qty'           => 'required'
        ]);

        if (Printag::find($id)->update($request->except('__token'))) {
            Alert::success('Berhasil', 'Data Berhasil Diedit!');
            return redirect()->back();
        }
    }
}
