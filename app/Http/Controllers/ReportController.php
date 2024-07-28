<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function LoadingReport() {
        return view('loading.report', [
            'data'  => Report::show_all(),
            'date'  => now()->format('Y-m-d')
        ]);
    }
}
