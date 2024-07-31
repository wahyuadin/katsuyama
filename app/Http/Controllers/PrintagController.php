<?php

namespace App\Http\Controllers;

use App\Models\Loading;
use App\Models\Packing;
use App\Models\Printag;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Faker\Factory as Faker;

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

    public function pdfLoading() {
        try {
            $faker = Faker::create();
            $data = Printag::show_by_id(Auth::user()->id);
            $pdf = Pdf::loadView('pdf.printag', ['data' => $data]);
            $pdf->setPaper(array(0,0,600,400), 'portrait');
            $randomNumber = $faker->numberBetween(10000, 99999);
            $fileName = 'Printag-' . $randomNumber . '.pdf';return $pdf->stream($fileName);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function pdfPacking() {
        try {
            $faker = Faker::create();
            $data = Printag::show_id_packing(Auth::user()->id);
            $pdf = Pdf::loadView('pdf.printag', ['data' => $data]);
            $pdf->setPaper(array(0,0,600,400), 'portrait');
            $randomNumber = $faker->numberBetween(10000, 99999);
            $fileName = 'Printag-' . $randomNumber . '.pdf';return $pdf->stream($fileName);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
