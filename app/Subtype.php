<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\Video;
use App\SubtypeExam;
use App\Tag;

class Subtype extends Model
{
    protected  $guarded = [];
    protected $table = "subtypes";
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
    public function videos()
    {
        return $this->hasMany(Video::class, 'subtype_id');
    }
    
    public function exams()
    {
        return $this->hasMany(SubtypeExam::class, 'subtype_id');
    }

    public function attendstudents()
    {
        return $this->belongsToMany(User::class, 'subtypes_studentsattendance', 'subtype_id', 'student_id')->withPivot('created_at','updated_at');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'subtypes_tags', 'subtype_id', 'tag_id');
    }
}//End of model
