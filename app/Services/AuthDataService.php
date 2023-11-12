<?php


namespace App\Services;

use App\Type;
use Illuminate\Support\Facades\Auth;

class AuthDataService
{
    public function getAuthType()
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            $types = Type::orderBy('created_at', 'desc')->get();
        } else if (Auth::user() && Auth::user()->is_student == 2) {
            $types = Type::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        } else if (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id = 1) {
            $types = Type::orderBy('created_at', 'desc')->where('center_id', Auth::user()->id)->get();
        }
        return $types;
    }
}
