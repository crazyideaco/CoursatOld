<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Subject;
use App\Type;
use App\User;
use App\Video;
class GroupscourseStudent extends Model
{
     protected  $guarded = [];
      protected $table = "groupscourses_students";
     
}
