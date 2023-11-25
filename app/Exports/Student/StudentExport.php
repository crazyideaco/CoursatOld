<?php

namespace App\Exports\Student;

use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

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
    protected $college_id;
    protected $division_id;
    protected $section_id;
    protected $type_college_id;

    public function __construct(Request $request)
    {
        $this->stage_id = $request->stage_id ?? null;
        $this->year_id = $request->year_id ?? null;
        $this->type_id = $request->type_id ?? null;
        $this->university_id = $request->university_id ?? null;
        $this->college_id = $request->college_id ?? null;
        $this->division_id = $request->division_id ?? null;
        $this->section_id = $request->section_id ?? null;
        $this->type_college_id = $request->type_college_id ?? null;

    }


     /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = "users.xlsx";


   /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;


    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];


    public function query(){
        $query = User::query()->where("is_student", config("project_types.auth_user_is_student.student"))
        // basic
        ->when($this->stage_id != null && $this->stage_id != 0, function ($query) {
            return $query->where('stage_id', $this->stage_id);
        })
        ->when($this->year_id != null && $this->year_id != 0, function ($query) {
            return $query->where('year_id', $this->year_id);
        })
        ->when($this->type_id != null, function ($query) {

            return $query->whereHas('stutypes', function ($typeq) {
                return $typeq->where('types.id', $this->type_id);
            });
        })
        // college
        ->when($this->university_id != null && $this->university_id != 0, function ($query) {
            return $query->where('university_id', $this->university_id);
        })
        ->when($this->college_id != null && $this->college_id != 0, function ($query) {
            return $query->where('college_id', $this->college_id);
        })
        ->when($this->division_id != null && $this->division_id != 0, function ($query) {
            return $query->where('division_id', $this->division_id);
        })
        ->when($this->section_id != null && $this->section_id != 0, function ($query) {
            return $query->where('section_id', $this->section_id);
        })
        ->when($this->type_college_id != null && $this->type_college_id != 0, function ($query) {

            return $query->whereHas('stutypescollege', function ($typeq)  {
                return $typeq->where('typescollege.id', (int)$this->type_college_id);
            });
        })
        ;
        // if ($this->stage_id) {
        //     $query->where('stage_id', $this->stage_id);
        // }
        // if ($this->year_id) {
        //     $query->where('year_id', $this->year_id);
        // }
        // if ($this->type_id) {
        //     $query->where('type_id', $this->type_id);
        // }
        // if ($this->university_id) {
        //     $query->where('university_id', $this->university_id);
        // }
        // if ($this->college_id) {
        //     $query->where('college_id', $this->college_id);
        // }
        // if ($this->division_id) {
        //     $query->where('division_id', $this->division_id);
        // }
        // if ($this->section_id) {
        //     $query->where('section_id', $this->section_id);
        // }
        // if ($this->type_college_id) {
        //     $query->where('type_college_id', $this->type_college_id);
        // }
        return $query;
    }


    public function headings(): array
    {
        return [
            'الكود',
            'الإسم',
            'رقم الهاتف',
            'تاريخ التسجيل',
            'نوع التعليم',
            'المنصة',
            'السنة',
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->phone,
            Carbon::parse($student->created_at)->format('Y-m-d'),
            $student->category_id == config('project_types.system_category_type.category_id_college') ? 'جامعي' : 'أساسي',
            $student->getCenterNameAttribute(),
            $student->getYearNameAttribute(),
        ];

    }


}
