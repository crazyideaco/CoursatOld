<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;


use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(){
        return view('website.login');}
}