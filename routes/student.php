<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'website'], function() {

    Route::get("login_website","website\LoginController@login")->name("login_website");
    Route::post("signin_website","website\LoginController@signin")->name("signin_website");
    Route::get("logout_website","website\LoginController@logout")->name("logout_website");
    Route::group(['middleware' => 'auth:website_student'], function() {
  
    Route::get("courses_website","website\CourseController@courses")->name("courses_website");
    });
  });