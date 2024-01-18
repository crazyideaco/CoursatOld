<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\SubjectquestionAnswer;
use App\TypeexamQuestion;
use App\Video;
use Carbon\Carbon;

class TypeExam extends Model
{
    protected  $guarded = [];
    protected $table = "types_exams";
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
    public function questions()
    {
        return $this->hasMany(TypeexamQuestion::class, 'typeexam_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'typeexams_results', 'exam_id', 'student_id')->withPivot('exam_score', 'student_score', 'created_at');
    }


    public function getStartDateTimeAttribute()
    {
        $from = Carbon::parse("{$this->date_day} {$this->date_time}")->format('Y-m-d H:i:s');

        return $from;
    }
    public function getEndDateTimeAttribute()
    {
        $to = Carbon::parse("{$this->end_date} {$this->end_time}")->format('Y-m-d H:i:s');

        return $to;
    }


}//End of model
