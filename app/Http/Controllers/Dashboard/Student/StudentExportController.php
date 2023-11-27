<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Exports\Student\StudentExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

class StudentExportController extends Controller
{


    public function export(Request $request)
    {
        // dd($request);
        return new StudentExport($request);
    }
}
