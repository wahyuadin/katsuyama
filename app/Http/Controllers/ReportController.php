<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    // admin
    public function adminReport() {
        return view('admin.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    // loading
    public function LoadingReport() {
        return view('loading.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }

    // packing
    public function PackingReport() {
        return view('packing.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }
}
