<?php

namespace App\Http\Controllers;

use App\Models\Hangger;
use App\Models\Loading;
use App\Models\Planing;
use App\Models\Printag;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoadingController extends Controller
{
    public function adminLoading() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.loading', [
            'data'      => Loading::show_all(),
            'hangger'   => Hangger::show_all(),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function adminLoadingEdit(Request $request, $id) {
        $this->validate($request, [
            'lot_no'        => 'required',
            'hangger_id'    => 'required',
            'qty_in'        => 'required'
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

    // Role Operator Loading
    public function OperatorLoading() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('loading.loading', [
            'data'      => Loading::show_by_id(Auth::user()->id),
            'planing'   => Planing::show_all(),
            'hanger'    => Hangger::show_by_id(Auth::user()->id),
            'date'      => now()->format('Y-m-d')
        ]);
    }

    public function OperatorLoadingTambah(Request $request) {
        $this->validate($request, [
            'user_id'       => 'required',
            'planing_id'    => 'required',
            'hangger_id'    => 'required',
            'lot_no'        => 'required',
            'qty_in'        => 'required',
            'time_in'       => 'required'
        ]);
        $loading = Loading::create($request->except('__token'));
        if ($loading) {
            $id_loading = $loading->id;
            if (Printag::create(['id_loading' => $id_loading])) {
                if (Report::create(['id_loading' => $id_loading])) {
                    Alert::success('Berhasil', 'Data Berhasil Ditambah!');
                    return redirect()->back();
                }
            }
        }
        Alert::error('Gagal', 'Terjadi kesalahan saat menambah data!');
        return redirect()->back();
    }


    public function OperatorLoadingEdit(Request $request, $id) {
        $this->validate($request, [
            'hangger_id'    => 'required',
            'lot_no'        => 'required',
            'qty_in'        => 'required',
            'time_in'       => 'required'
        ]);

        if (Loading::find($id)->update($request->except('__token'))) {
            Alert::success('Berhasil','Data Berhasil Di Edit!');
            return redirect()->back();
        }
    }

    public function OperatorLoadingHapus($id) {
        if (Loading::hapus($id)) {
            Alert::success('Berhasil','Data Berhasil Di Hapus!');
            return redirect()->back();
        }
    }

    // operator packing
    public function loadingPacking() {
        return view('packing.loading', [
            'data'      => Loading::show_all(),
            'planing'   => Planing::show_all(),
            'hanger'    => Hangger::show_by_id(Auth::user()->id),
            'date'      => now()->format('Y-m-d')
        ]);
    }
}
