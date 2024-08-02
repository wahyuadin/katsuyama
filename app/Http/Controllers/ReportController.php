<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Factory as Faker;

class ReportController extends Controller
{

    // admin
    public function adminReport() {
        return view('admin.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    public function pdf() {
        $faker = Faker::create();
        $pdf = Pdf::loadView('pdf.report', ['data' => Report::show_all()]);
        $pdf->setPaper(array(0,0,600,1100), 'landscape');
        $randomNumber = $faker->numberBetween(10000, 99999);
        $fileName = 'Report-' . $randomNumber . '.pdf';return $pdf->stream($fileName);
    }

    // loading
    public function LoadingReport() {
        return view('loading.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    public function pdfReportLoading() {
        $faker = Faker::create();
        $pdf = Pdf::loadView('pdf.report', ['data' => Report::show_all()]);
        $pdf->setPaper(array(0,0,600,1100), 'landscape');
        $randomNumber = $faker->numberBetween(10000, 99999);
        $fileName = 'Report-' . $randomNumber . '.pdf';return $pdf->stream($fileName);
    }

    // packing
    public function PackingReport() {
        return view('packing.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }
}
