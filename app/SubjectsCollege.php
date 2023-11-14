<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Division;
use App\College;
use App\TypesCollege;
use App\Lesson;
use App\University;
use App\User;
use App\SubjectscollegeQuestion;

class SubjectsCollege extends Model
{
    protected  $guarded = [];

    protected $table = 'subjectscollege';
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
    public function typescollege()
    {
        return $this->hasMany(TypesCollege::class, 'subjectscollege_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'subjectscollege_id');
    }
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctors_subcolleges', 'subcollege_id', 'doctor_id');
    }
    public function questions()
    {
        return $this->hasMany(SubjectscollegeQuestion::class, 'subjectscollege_id');
    }
}
