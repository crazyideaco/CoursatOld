<?php

namespace App\Models;

use App\College;
use App\Division;
use App\Section;
use App\Stage;
use App\Subject;
use App\SubjectsCollege;
use App\University;
use App\User;
use App\Year;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ReelInformation extends Model
{
    use HasFactory;

    protected $table = 'reel_informations';
    protected $guarded = [];


    public function reel()
    {
        return $this->belongsTo(Reel::class, 'reel_id');
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

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
