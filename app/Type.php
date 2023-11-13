<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Subtype;
use App\Stage;
use App\User;
use App\Type_Rate;
use App\Video;
use App\Tag;

class Type extends Model
{
    protected  $guarded = [];
    protected $table = "types";
    public function year()
    {
        return $this->belongsTo(Year::class, 'years_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }
    public function subtypes()
    {
        return $this->hasMany(Subtype::class, 'type_id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class, 'type_id');
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function rates()
    {
        return $this->hasMany(Type_Rate::class, 'type_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function center()
    {
        return $this->belongsTo(User::class, 'center_id');
    }
    public function studentstype()
    {
        return $this->belongsToMany(User::class, 'students_types', 'type_id', 'student_id')->withPivot("created_at","updated_at");
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'types_tags', 'type_id', 'tag_id');
    }
    public function students()
    {
        return $this->hasMany(Student_Type::class, 'student_id');
    }
    public function getUserNameAttribute()
    {
        return $this->user->name ?? "";
    }
}
