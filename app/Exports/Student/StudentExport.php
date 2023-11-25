<?php

namespace App\Exports\Student;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements  FromQuery, WithMapping, Responsable, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    //basic
    protected $stage_id;
    protected $year_id;
    protected $type_id;
    // college
    protected $university_id;
    protected $division_id;
    protected $section_id;
    protected $type_college_id;

    public function __construct(Request $request)
    {
        $this->stage_id = $request->stage_id ?? null;
        $this->year_id = $request->year_id ?? null;
        $this->type_id = $request->type_id ?? null;
        $this->university_id = $request->university_id ?? null;
        $this->division_id = $request->division_id ?? null;
        $this->section_id = $request->section_id ?? null;
        $this->type_college_id = $request->type_college_id ?? null;

    }
}
