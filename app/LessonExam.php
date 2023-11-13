<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\College;
use App\Division;
use App\University;
use App\Section;
use App\Lesson;
use App\TypesCollege;
use App\SubjectsCollege;
use App\LessonexamQuestion;

class LessonExam extends Model
{
    protected  $guarded = [];
    protected $table = "lessons_exams";
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
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
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function typescollege()
    {
        return $this->belongsTo(TypesCollege::class, 'typescollege_id');
    }
    public function questions()
    {
        return $this->hasMany(LessonexamQuestion::class, 'lessonexam_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'lessonexams_results', 'exam_id', 'student_id')->withPivot('exam_score', 'student_score', 'created_at');
    }
}
