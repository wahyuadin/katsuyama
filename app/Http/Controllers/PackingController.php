<?php

namespace App\Http\Controllers;

use App\Models\Loading;
use App\Models\Packing;
use App\Models\Printag;
use App\Models\Report;
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

    // role packing
    public function OperatorPacking() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('packing.data', [
            'data'      => Packing::show_all(),
            'loading'   => Loading::show_all(),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function OperatorPackingTambah(Request $request) {
        $this->validate($request, [
            'user_id'       => 'required',
            'loading_id'    => 'required',
            'lot_no_edp'    => 'required',
            'qty_ok'        => 'required',
            'qty_ng'        => 'required',
            'remark'        => 'required',
            'time_out'      => 'required'
        ]);

        $packing = Packing::create($request->all());
        if ($packing) {
            $id_packing = $packing->id;
            if (Printag::create(['id_packing' => $id_packing])) {
                if (Report::where('id_loading', $request->loading_id)->update(['id_packing' => $id_packing])) {
                    Alert::success('Berhasil', 'Data Berhasil Ditambah!');
                    return redirect()->back();
                }
                Report::create(['id_packing' => $id_packing]);
                Alert::success('Berhasil', 'Data Berhasil Ditambah!');
                return redirect()->back();
            }
        }
    }

    public function OperatorPackingEdit(Request $request, $id) {
        $this->validate($request, [
            'user_id'       => 'required',
            'loading_id'    => 'required',
            'lot_no_edp'    => 'required',
            'qty_ok'        => 'required',
            'qty_ng'        => 'required',
            'remark'        => 'required',
            'time_out'      => 'required'
        ]);

        if (Packing::ubah($id, $request->all())) {
            Alert::success('Berhasil', 'Data Berhasil Di Edit!');
            return redirect()->back();
        }
    }

    public function OperatorPackingHapus($id) {
        if (Packing::find($id)->delete()) {
            Alert::success('Berhasil', 'Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }
}
