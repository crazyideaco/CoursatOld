<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
use App\Http\Requests\Website\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\WebsiteStudent;
use PDO;

class CourseController extends Controller
{
        public function courses(){
            return view('website.courses');

        }
}