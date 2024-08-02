<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Faker\Factory as Faker;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function pdf() {
        $faker = Faker::create();
        $pdf = Pdf::loadView('pdf.report');
        $pdf->setPaper(array(0,0,600,1100), 'landscape');
        $randomNumber = $faker->numberBetween(10000, 99999);
        $fileName = 'Printag-' . $randomNumber . '.pdf';return $pdf->stream($fileName);
    }
}
