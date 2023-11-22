<?php

use App\Http\Controllers\api\FetchPaymentwayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Student\studentController;
use Dashboard\CampaignController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['namespace' => 'api'], function () {


    Route::get('app_status', 'AuthController@app_status');

    // route for setting avatar

    Route::post("setAvatar", "Student\SetAvatarController@setAvatar")->middleware('auth:api');
    // Route for switching centers
    Route::post('switch', "Student\studentController@switchCenter")->middleware('auth:api');
    Route::get("fetchPaymentway", "FetchPaymentwayController@fetchPaymentway");
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register');
    Route::post('register_info', 'AuthController@register_info');
    Route::post('check_phone', 'AuthController@check_phone');
    Route::post('lecturer_cover', 'AuthController@lecturer_cover');
    Route::post('forget_password', 'AuthController@forget_password');
    Route::get('get_points', 'PointController@get_points')->middleware('auth:api');
    Route::post('buy_points', 'PointController@buy_points')->middleware('auth:api');
    Route::get('tags', 'TagController@tags')->name('tags');
    Route::get('phone_verify', 'AuthController@phone_verify')->middleware('auth:api');
    Route::post('change_password', 'AuthController@change_password')->middleware('auth:api');
    Route::post('addcenter', 'AuthController@addcenter')->middleware('auth:api');
    Route::get('home_categories', 'AuthController@home_categories')->middleware('auth:api');
    Route::post('course_classes', 'AuthController@course_classes')->middleware('auth:api');
    Route::get('mynotifications', 'AuthController@mynotifications')->middleware('auth:api');
    Route::post('show_center', 'AuthController@show_center');
    Route::get('general_courses', 'AuthController@general_courses')->middleware('auth:api');
    Route::post('lecturer_info', 'AuthController@lecturer_info')->middleware('auth:api');
    Route::get('education_stages', 'AuthController@education_stages');
    Route::get('states', 'AuthController@states');
    Route::post('alllecturers', 'AuthController@alllecturers')->middleware('auth:api');
    Route::post('subjectcourses', 'AuthController@subjectcourses')->middleware('auth:api');
    Route::post('center_code', 'AuthController@center_code')->middleware('auth:api');
    Route::get('mycenters', 'AuthController@mycenters')->middleware('auth:api');

    Route::get('fetch_centers', 'AuthController@fetch_centers');
    Route::post('buycourse', 'AuthController@buycourse')->middleware('auth:api');
    Route::post('buygeneralcourse', 'AuthController@buygeneralcourse')->middleware('auth:api');
    Route::get('mycourses', 'AuthController@mycourses')->middleware('auth:api');
    Route::post('buyclass', 'AuthController@buyclass')->middleware('auth:api');
    Route::post('getcoursevideos', 'AuthController@getcoursevideos')->middleware('auth:api');;
    Route::get('logoutnow', 'AuthController@logoutnow')->middleware('auth:api');;
    Route::post('rate_course', 'AuthController@rate_course')->middleware('auth:api');
    Route::post('sendmessage', 'AuthController@sendmessage')->middleware('auth:api');
    Route::post('course_rate', 'AuthController@course_rate')->middleware('auth:api');
    Route::post('getcoursegeneral', 'AuthController@getcoursegeneral')->middleware('auth:api');
    Route::post('searshforcourses', 'AuthController@searshforcourses')->middleware('auth:api');
    Route::get('sendbasicemail/{email}', 'api\MailController@basic_email');
    //Route::get('states','api\AuthController@states');
    Route::get('years', 'api\AuthController@years');
    Route::get('centeroffers', 'TagController@centeroffers')->middleware('auth:api');
    //exams
    Route::post('fetch_exam_availability', 'Exam\ExamController@fetch_exam_availability')->middleware('auth:api');
    Route::get('fetch_daily_exams', 'ExamController@fetch_daily_exams')->middleware('auth:api');
    Route::get('periodicexams', 'ExamController@periodicexams')->middleware('auth:api');
    Route::get('fetch_new_exams', 'ExamController@fetch_new_exams')->middleware('auth:api');
    Route::get('fetch_current_exams', 'ExamController@fetch_current_exams')->middleware('auth:api');
    //exam questions
    Route::post('fetch_exam_questions', 'ExamController@fetch_exam_questions')->middleware('auth:api');
    //discussions
    Route::post('add_discussion', 'DiscussionController@add_discussion')->middleware('auth:api');
    Route::post('add_discussion_reply', 'DiscussionController@add_discussion_reply')->middleware('auth:api');
    Route::get('fetch_discussions', 'DiscussionController@fetch_discussions')->middleware('auth:api');
    Route::post('fetch_groups_discussions', 'DiscussionController@fetch_groups_discussions')->middleware('auth:api');
    Route::get('fetch_my_groups', 'DiscussionController@fetch_my_groups')->middleware('auth:api');
    Route::post('discussion_replies', 'DiscussionController@discussion_replies')->middleware('auth:api');
    Route::post('skip_lesson_exam', 'ExamController@skip_lesson_exam')->middleware('auth:api');
    Route::post('delete_discussion', 'DiscussionController@delete_discussion')->middleware('auth:api');
    //examlessons
    Route::post('fetch_lesson_exam', 'SkipLessonController@fetch_lesson_exam')->middleware('auth:api');
    Route::post('fetch_exam_lesson_questions', 'SkipLessonController@fetch_exam_lesson_questions')->middleware('auth:api');
    Route::post('skip_lesson_exam', 'SkipLessonController@skip_lesson_exam')->middleware('auth:api');
    Route::get('archived_exams_pre_lessons', 'SkipLessonController@archived_exams_pre_lessons')->middleware('auth:api');
    Route::post('fetch_live_lessons', 'SkipLessonController@fetch_live_lessons')->middleware('auth:api');
    Route::get('fetch_subjects', 'ExamController@fetch_subjects')->middleware('auth:api');
    Route::post('add_to_library', 'LibraryController@add_to_library')->middleware('auth:api');
    Route::post('fetch_my_library', 'LibraryController@fetch_my_library')->middleware('auth:api');
    Route::post('buypart', 'LibraryController@buypart')->middleware('auth:api');
    Route::post('send_attendance', 'SkipLessonController@send_attendance')->middleware('auth:api');
    Route::post('build_custom_exam', 'ExamController@build_custom_exam')->middleware('auth:api');
    Route::post('sendcourse_exam_result', 'ExamController@sendcourse_exam_result')->middleware('auth:api');
    Route::post('start_exam', 'ExamController@start_exam')->middleware('auth:api');
    Route::post('sendlesson_exam_result', 'ExamController@sendlesson_exam_result')->middleware('auth:api');

    //
    Route::post('add_course_join', 'TypecollegeJoinController@index')->middleware('auth:api');
    ###########################################################
    Route::get('offers', 'api\HomeController@offers');


    Route::post('join_by_qr', 'QrController@join_by_qr')->middleware('auth:api');
    Route::get('fetch_reels', 'AppReelController@fetch_reels')->middleware('auth:api');

    //Route::get('products/all','api\ProductController@products_all');

    // //product with rate
    // Route::post('product','api\ProductController@product');
    // Route::get('products/search','api\ProductController@search');
    // Route::post('product/review','api\ProductController@product_review');
    // Route::post('product/filter','api\ProductController@product_filter');
    //view all
    // Route::post('product/view_all','api\ProductController@view_all');
    Route::group(['middleware' => 'auth:api', 'namespace' => 'api'], function () {



        Route::get('index', 'api\ProductController@index');
        Route::get('teacher/videos/{id}', 'api\ProductController@teacher_video');
        Route::get('teacher/videos/paginate/{id}', 'api\ProductController@teacher_video_paginate');
        Route::get('teacher/videos/profile/{id}', 'api\ProductController@teacher_profile');
        Route::post('view_all', 'api\ProductController@view_all');
        Route::get('subject/videos/{id}', 'api\ProductController@subject_videos');

        Route::post('update_user', 'api\AuthController@update_user');
        Route::post('contact', 'api\HomeController@contact');
        //allproduct that user like it
        // type for class
        Route::post('type', 'api\ProductController@type');

        Route::post('suptype', 'api\ProductController@suptype');
    });






    ##############################################################
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});
