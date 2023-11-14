<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Subject;
use App\State;
use App\City;
use App\College;
use App\Section;
use App\Division;
use App\General;
use App\Course;
use App\University;
use App\Category;
use App\Year;
use App\SubjectsCollege;
use App\TypesCollege;
use App\Type;
use App\Subtype;
use App\Lesson;
use App\Sub;
use App\Stage;
use App\User_Owner;
use App\VideosCollege;
use App\Video;
use App\GroupType;
use App\GroupTypescollege;
use App\GroupCourse;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id');
    }
    public function videoscollege()
    {
        return $this->hasMany(VideosCollege::class, 'user_id');
    }
    public function types()
    {
        return $this->hasMany(Type::class, 'user_id');
    }
    public function centertypes()
    {
        return $this->hasMany(Type::class, 'center_id');
    }
    public function typescollege()
    {
        return $this->hasMany(TypesCollege::class, 'doctor_id');
    }
    public function centertypescollege()
    {
        return $this->hasMany(TypesCollege::class, 'center_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
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
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function subjectscollege()
    {
        return $this->belongsTo(SubjectsCollege::class, 'subjectscollege_id');
    }
    public function general()
    {
        return $this->belongsTo(General::class, 'general_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }
    public function centercourses()
    {
        return $this->hasMany(Course::class, 'center_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'users_subjects', 'user_id', 'subject_id');
    }
    public function years()
    {
        return $this->belongsToMany(Year::class, 'users_years', 'user_id', 'year_id');
    }
    public function subcolleges()
    {
        return $this->belongsToMany(SubjectsCollege::class, 'doctors_subcolleges', 'doctor_id', 'subcollege_id');
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'doctors_sections', 'doctor_id', 'section_id');
    }
    public function divisions()
    {
        return $this->belongsToMany(Division::class, 'doctors_divisions', 'doctor_id', 'division_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'centers_teachers', 'center_id', 'teacher_id');
    }
    public function belongcenter1()
    {
        return $this->belongsToMany(User::class, 'centers_teachers', 'teacher_id', 'center_id');
    }
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'centers_doctors', 'center_id', 'doctor_id');
    }
    public function belongcenter2()
    {
        return $this->belongsToMany(User::class, 'centers_doctors', 'doctor_id', 'center_id');
    }
    public function lecturers()
    {
        return $this->belongsToMany(User::class, 'centers_lecturers', 'center_id', 'lecturer_id');
    }
    public function stutypes()
    {
        return $this->belongsToMany(Type::class, 'students_types', 'student_id', 'type_id')->withPivot('active', "created_at", "updated_at")->using(Student_Type::class);
    }
    public function stutypescollege()
    {
        return $this->belongsToMany(TypesCollege::class, 'students_typescollege', 'student_id', 'typecollege_id')->withPivot('active', "created_at", "updated_at")->using(Student_Typecollege::class);
    }
    public function stucourses()
    {
        return $this->belongsToMany(Course::class, 'students_courses', 'student_id', 'course_id')->withPivot('active');
    }
    public function stusubtypes()
    {
        return $this->belongsToMany(Subtype::class, 'students_subtypes', 'student_id', 'subtype_id');
    }
    public function stulessons()
    {
        return $this->belongsToMany(Lesson::class, 'students_lessons', 'student_id', 'lesson_id');
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
    public function stdcenters()
    {
        return $this->belongsToMany(User::class, 'users_owners', 'user_id', 'owner_id');
    }
    public function centerstudents()
    {
        return $this->belongsToMany(User::class, 'users_owners', 'owner_id', 'user_id');
    }
    public function subs()
    {
        return $this->belongsToMany(Sub::class, 'sub_user', 'user_id', 'sub_id');
    }
    public function groupstype()
    {
        return $this->belongsToMany(GroupType::class, 'groupstypes_students', 'student_id', 'grouptype_id');
    }
    public function groupstypescollege()
    {
        return $this->belongsToMany(GroupTypescollege::class, 'groupstypescollege_students', 'student_id', 'grouptypescollege_id');
    }
    public function groupscourse()
    {
        return $this->belongsToMany(GroupCourse::class, 'groupscourses_students', 'student_id', 'groupcourse_id');
    }
    public function typecollege_joins()
    {
        return $this->belongsToMany(TypesCollege::class, 'typecollege_joins', 'student_id', 'typecollege_id ')->withPivot('status');
    }
    public function getTypeSellNumberAttribute()
    {
        $number = 0;
        if ($this->types) {
            foreach ($this->types as $type) {
                $number += count($type->studentstype);
            }
        }
        return  $number;
    }



    public function getTypecollegeSellNumberAttribute()
    {
        $number = 0;
        if ($this->typescollege) {
            foreach ($this->typescollege as $type) {
                $number += count($type->studentscollege);
            }
        }
        return  $number;
    }


    public function ur_courses()
    {
        if ($this->is_student == 2) {
            return $this->types();
        } elseif ($this->is_student == 3) {
            return $this->typescollege();
        }
    }


}
