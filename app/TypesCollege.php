<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\College;
use App\SubjectsCollege;
use App\Lesson;
use App\University;
use App\User;
use App\Typecollege_Rate;
use App\VideosCollege;
use App\Tag;

class TypesCollege extends Model
{
    protected  $guarded = [];

    protected $table = 'typescollege';
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
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'typescollege_id');
    }
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function center()
    {
        return $this->belongsTo(User::class, 'center_id');
    }
    public function rates()
    {
        return $this->hasMany(Typecollege_Rate::class, 'typecollege_id');
    }
    public function studentscollege()
    {
        return $this->belongsToMany(User::class, 'students_typescollege', 'typecollege_id', 'student_id')->withPivot('created_at','updated_at');
    }
    public function videos()
    {
        return $this->hasMany(VideosCollege::class, 'typescollege_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'typescollege_tags', 'typescollege_id', 'tag_id');
    }

    
    public function getUserNameAttribute()
    {
        return $this->doctor->name ?? "";
    }


}
