<?php

namespace App\Http\Controllers\Dashboard\Filter;

use App\Http\Controllers\Controller;
use App\Subject;
use App\SubjectsCollege;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getSubject_teachercollege($id){

        $users = SubjectsCollege::where('id', $id)->first()->doctors;
        $text = "";
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }
        return response()->json($text);
    }

    public function getSubject_teacher($id){
        $users = Subject::where('id', $id)->first()->teachers;
        $text = "";
        foreach ($users as $user) {
            $text .= '<option value="' . $user->id . '">' . $user->name . '</option>';
        }
        return response()->json($text);
    }


}//End of controller
