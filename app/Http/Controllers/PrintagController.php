<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use Illuminate\Http\Request;

class PrintagController extends Controller
{
    public function adminPrintag() {
        return view('admin.printag',[
            'data'  => Packing::printag(),
            'date'  => now()->format('Y-m-d')
        ]);
    }
}
