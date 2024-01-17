<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubjectquestionAnswer;
use App\SubtypeexamQuestion;
use App\Video;
use App\Subtype;
use Carbon\Carbon;

class SubtypeExam extends Model
{
    protected  $guarded = [];
    protected $table = "subtypes_exams";
    public function year()
    {
        return $this->belongsTo(Year::class, 'years_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function subtype()
    {
        return $this->belongsTo(Subtype::class, 'subtype_id');
    }
    public function questions()
    {
        return $this->hasMany(SubtypeexamQuestion::class, 'subtypeexam_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'subtypeexams_results', 'exam_id', 'student_id')->withPivot('exam_score', 'student_score', 'created_at');
    }

    public function getStartDateTimeAttribute()
    {
        return  Carbon::parse($this->date_time)->format('g:i A');
    }

    public function getEndDateTimeAttribute()
    {
        return  Carbon::parse($this->date_time)->addMinutes($this->duration_time)->format('g:i A');
    }
}
