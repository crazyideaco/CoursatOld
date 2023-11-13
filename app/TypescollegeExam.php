<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\User;
use App\Division;
use App\SubjectsCollege;
use App\TypesCollege;
use App\College;
use App\University;
use App\TypescollegeexamsQuestion;
use Carbon\Carbon;

class TypescollegeExam extends Model
{
    protected  $guarded = [];
    protected $table = "typescollege_exams";
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function subjectscollege()
    {
        return $this->belongsTo(SubjectsCollege::class, 'subjectscollege_id');
    }
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function typescollege()
    {
        return $this->belongsTo(TypesCollege::class, 'typescollege_id');
    }
    public function questions()
    {
        return $this->hasMany(TypescollegeexamsQuestion::class, 'typescollegeexam_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'typescollegeexams_results', 'exam_id', 'student_id')->withPivot('exam_score', 'student_score', 'created_at');
    }

    

    public function getStartDateTimeAttribute()
    {
        $from = Carbon::parse("{$this->date_day} {$this->date_time}");//->format('Y-m-d H:i:s');


        return $from;
    }
    public function getEndDateTimeAttribute()
    {
        $to = Carbon::parse("{$this->end_date} {$this->end_time}");//->format('Y-m-d H:i:s');


        return $to;
    }


}//End of model
