 <?php

use App\Lesson;
use App\VideosCollege;
use Illuminate\Support\Facades\Route;


// Route::get('/cache', function() {
//   Artisan::call('config:clear');
//     Artisan::call('cache:clear');
//     Artisan::call('view:clear');
//     return "Cache is cleared";
// });
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('dashLogin','LoginController@dashlogin')->name('dashlogin')->middleware("guest");
Route::post('startlogin','LoginController@startlogin')->name('startlogin');


  //tags

  Route::resource("tags",'TagController');
//Route::group(['middleware' => ['auth','isAdmin']],function(){
Route::group(['middleware' => ['auth']],function(){
    Route::get('main_page_basic','MainPageController@main_page_basic')->name('main_page_basic');

Route::get('deleteuser/{id}','userscontroller@deleteuser')->name('deleteuser');
  //courses_students
  Route::get('studentstype/{id}','StudentController@studentstype')->name('studentstype');
  Route::get('studentstypecollege/{id}','StudentController@studentstypecollege')->name('studentstypecollege');
   Route::post('deletestudentcourse','StudentController@deletestudentcourse')->name('deletestudentcourse');
   Route::post('activestudentcourse','StudentController@activestudentcourse')->name('activestudentcourse');
  Route::get('studentscourse/{id}','StudentController@studentscourse')->name('studentscourse');
  Route::get('userstudents','StudentController@userstudents')->name('userstudents');
   Route::get('teacherstudents/{id}','StudentController@teacherstudents')->name('teacherstudents');
  //start notification
Route::get('sendnotification','NotificationController@sendnotification')->name('sendnotification');
Route::post('storenotification','NotificationController@storenotification')->name('storenotification');
  Route::get('senduniversitynotification','NotificationController@senduniversitynotification')->name('senduniversitynotification');
Route::post('storeuniversitynotification','NotificationController@storeuniversitynotification')->name('storeuniversitynotification');
    Route::get('sendgeneralnotification','NotificationController@sendgeneralnotification')->name('sendgeneralnotification');
Route::post('storegeneralnotification','NotificationController@storegeneralnotification')->name('storegeneralnotification');
  Route::get('sendnoty','NotificationController@sendnoty')->name('sendnoty');
Route::post('storenoty','NotificationController@storenoty')->name('storenoty');
  //end notification
Route::get('mytypestudents','StudentController@mytypestudents')->name('mytypestudents');
  Route::post('addcoursesstudents','CourseController@addcoursesstudents')->name('addcoursesstudents');
Route::get('addadmin','AdminController@addadmin')->name('addadmin');
  Route::post('addtypesollegestudent/{id}','StudentController@addtypesollegestudent')->name('addtypesollegestudent');
    Route::post('addtypestudent/{id}','StudentController@addtypestudent')->name('addtypestudent');

  //results
Route::get('typeresults_students/{id}','StudentController@typeresults_students')->name('typeresults_students');
Route::get('typecollegeresults_students/{id}','StudentController@typecollegeresults_students')->name('typecollegeresults_students');
Route::get('edityourinformation','ProfileController@edityourinformation')->name('edityourinformation');
Route::post('storeyourinformation','ProfileController@storeyourinformation')->name('storeyourinformation');
Route::post('storeadmin','AdminController@storeadmin')->name('storeadmin');
Route::get('editadmin/{id}','AdminController@editadmin')->name('editadmin');
Route::post('updateadmin/{id}','AdminController@updateadmin')->name('updateadmin');
Route::get('editprofile','ProfileController@editprofile')->name('editprofile');
Route::post('updateprofile','ProfileController@updateprofile')->name('updateprofile');
Route::get('admins','AdminController@admins')->name('admins');
Route::get('studentprofile/{id}','ProfileController@studentprofile')->name('studentprofile');
Route::get('teacherprofile/{id}','ProfileController@teacherprofile')->name('teacherprofile');
Route::get('centerprofile/{id}','ProfileController@centerprofile')->name('centerprofile');
Route::get('doctorprofile/{id}','ProfileController@doctorprofile')->name('doctorprofile');
Route::get('lecturerprofile/{id}','ProfileController@lecturerprofile')->name('lecturerprofile');
Route::get('messages','dashboardcontroller@messages')->name('messages');
Route::get('editpassword','ProfileController@editpassword')->name('editpassword');
Route::post('updatepassword','ProfileController@updatepassword')->name('updatepassword');
Route::get('states','StateController@states')->name('states');
Route::post('deletestate','StateController@deletestate')->name('deletestate');
Route::post('addstate','StateController@addstate')->name('addstate');
Route::get('points','PointController@points')->name('points');
Route::get('addpoints/{id}','PointController@addpoints')->name('addpoints');
Route::post('storepoints/{id}','PointController@storepoints')->name('storepoints');

Route::get('paqas','PaqaController@paqas')->name('paqas');
Route::get('addpaqabasic','PaqaUserController@addpaqabasic')->name('addpaqabasic');
Route::get('addpaqacollage','PaqaUserController@addpaqacollage')->name('addpaqacollage');
Route::get('addpaqapublic','PaqaUserController@addpaqapublic')->name('addpaqapublic');
Route::get('editpaqabasic/{id}','PaqaUserController@editpaqabasic')->name('editpaqabasic');
Route::get('editpaqacollage/{id}','PaqaUserController@editpaqacollage')->name('editpaqacollage');
Route::get('editpaqapublic/{id}','PaqaUserController@editpaqapublic')->name('editpaqapublic');
  Route::post('updatepaqauser/{id}','PaqaUserController@updatepaqauser')->name('updatepaqauser');
//srore paqa
Route::get('addpaqas','PaqaController@addpaqas')->name('addpaqas');
Route::post('storepaqas','PaqaController@storepaqas')->name('storepaqas');
  Route::get('editpaqas/{id}','PaqaController@editpaqas')->name('editpaqas');
Route::post('updatepaqas/{id}','PaqaController@updatepaqas')->name('updatepaqas');
Route::get('deletepaqas/{id}','PaqaController@deletepaqas')->name('deletepaqas');
Route::get('/cities','CityController@cities')->name('cities');
Route::post('/addcity','CityController@addcity')->name('addcity');
Route::get('/editcity/{id}','CityController@editcity')->name('editcity');
Route::post('/updatecity/{id}','CityController@updatecity')->name('updatecity');
Route::post('/deletecity','CityController@deletecity')->name('deletecity');
//show user paqa

Route::get('userpaqabasic','PaqaUserController@userpaqabasic')->name('userpaqabasic');
Route::get('userpaqacollage','PaqaUserController@userpaqacollage')->name('userpaqacollage');
Route::get('userpaqapublic','PaqaUserController@userpaqapublic')->name('userpaqapublic');

Route::post('storepaqasuser','PaqaUserController@storepaqasuser')->name('storepaqasuser');

Route::post('storestates','StateController@storestates')->name('storestates');
//years
Route::get('years','YearController@years')->name('years');
Route::post('storeyears','YearController@storeyears')->name('storeyears');
Route::get('edityears/{id}','YearController@edityears')->name('edityears');
  Route::get('deleteyear/{id}','YearController@deleteyear')->name('deleteyear');
Route::post('updateyears/{id}','YearController@updateyears')->name('updateyears');

//subjects
Route::get('subjects','SubjectController@subjects')->name('subjects');
Route::get('addsubject','SubjectController@addsubject')->name('addsubject');
Route::post('storesubject','SubjectController@storesubject')->name('storesubject');
Route::get('editsubject/{id}','SubjectController@editsubject')->name('editsubject');
Route::post('updatesubject/{id}','SubjectController@updatesubject')->name('updatesubject');
  Route::get('deletesubject/{id}','SubjectController@deletesubject')->name('deletesubject');
//edit stage
Route::get('editstage/{id}','dashboardcontroller@editstage')->name('editstage');
Route::post('updatestage/{id}','dashboardcontroller@updatestage')->name('updatestage');
//offers
Route::get('offers','OfferController@offers')->name('offers');
Route::get('addoffer','OfferController@addoffer')->name('addoffer');
Route::post('storeoffer','OfferController@storeoffer')->name('storeoffer');
Route::get('editoffer/{id}','OfferController@editoffer')->name('editoffer');
Route::post('updateoffer/{id}','OfferController@updateoffer')->name('updateoffer');
Route::get('deleteoffer/{id}','OfferController@deleteoffer')->name('deleteoffer');


//logout
//ajax city
Route::get('getcity/{id}','CityController@getcity')->name('getcity');
//ajax subtype
Route::get('gettype/{id}','TypeController@gettype')->name('gettype');
//edit
Route::get('editstate/{id}','StateController@editstate')->name('editstate');
Route::post('updatestate/{id}','StateController@updatestate')->name('updatestate');
//students
Route::get('students','StudentController@students')->name('students');
Route::get('basicstudents','StudentController@basicstudents')->name('basicstudents');
Route::post('filterbasicstudents','StudentController@filterbasicstudents')->name('filterbasicstudents');
  Route::get('collegestudents','StudentController@collegestudents')->name('collegestudents');
Route::post('filtercollegestudents','StudentController@filtercollegestudents')->name('filtercollegestudents');
//addcategory
Route::get('editcategory/{id}','CategoryController@editcategory')->name('editcategory');
Route::post('storecategory/{id}','CategoryController@storecategory')->name('storecategory');
Route::get('categoryall','CategoryController@category')->name('categoryall');

//addcategory
Route::get('addstage','StageController@addstage')->name('addstage');
Route::post('storestage','StageController@storestage')->name('storestage');
    Route::get('deletestage/{id}','StageController@deletestage')->name('deletestage');
Route::get('stages','StageController@stages')->name('stages');
//ajax stage
Route::get('getsandl/{id}','dashboardcontroller@getsandl')->name('getsandl');
//addcollege
Route::get('adduniversity','UniversityController@adduniversity')->name('adduniversity');
Route::post('storeuniversity','UniversityController@storeuniversity')->name('storeuniversity');
Route::get('universities','UniversityController@universities')->name('universities');
Route::get('edituniversity/{id}','UniversityController@edituniversity')->name('edituniversity');
Route::post('updateuniversity/{id}','UniversityController@updateuniversity')->name('updateuniversity');
Route::get('deleteuniversity/{id}','UniversityController@deleteuniversity')->name('deleteuniversity');
//addcollege
Route::get('addcollege','CollegeController@addcollege')->name('addcollege');
Route::post('storecollege','CollegeController@storecollege')->name('storecollege');
Route::get('colleges','CollegeController@colleges')->name('colleges');
Route::get('editcollege/{id}','CollegeController@editcollege')->name('editcollege');
Route::post('updatecollege/{id}','CollegeController@updatecollege')->name('updatecollege');
Route::get('deletecollege/{id}','CollegeController@deletecollege')->name('deletecollege');
//adddivision
Route::get('adddivision','DivisionController@adddivision')->name('adddivision');
Route::post('storedivision','DivisionController@storedivision')->name('storedivision');
Route::get('divisions','DivisionController@divisions')->name('divisions');
Route::get('editdivision/{id}','DivisionController@editdivision')->name('editdivision');
Route::post('updatedivision/{id}','DivisionController@updatedivision')->name('updatedivision');
Route::get('deletedivision/{id}','DivisionController@deletedivision')->name('deletedivision');
//addsection
Route::get('addsection','SectionController@addsection')->name('addsection');
Route::post('storesection','SectionController@storesection')->name('storesection');
Route::get('sections','SectionController@sections')->name('sections');
Route::get('editsection/{id}','SectionController@editsection')->name('editsection');
Route::post('updatesection/{id}','SectionController@updatesection')->name('updatesection');
Route::get('deletesection/{id}','SectionController@deletesection')->name('deletesection');
//ajax college
//adddoctor
Route::get('adddoctor','DoctorController@adddoctor')->name('adddoctor');
Route::post('storedoctor','DoctorController@storedoctor')->name('storedoctor');
Route::get('editdoctor/{id}','DoctorController@editdoctor')->name('editdoctor');
Route::post('updatedoctor/{id}','DoctorController@updatedoctor')->name('updatedoctor');
Route::get('doctors','DoctorController@doctors')->name('doctors');
//addgeneral
Route::get('addgeneral','GeneralController@addgeneral')->name('addgeneral');
Route::post('storegeneral','GeneralController@storegeneral')->name('storegeneral');
Route::get('general','GeneralController@general')->name('general');
Route::get('editgeneral/{id}','GeneralController@editgeneral')->name('editgeneral');
Route::post('updategeneral/{id}','GeneralController@updategeneral')->name('updategeneral');
//addsub
Route::get('addsub','SubController@addsub')->name('addsub');
Route::post('storesub','SubController@storesub')->name('storesub');
Route::get('sub','SubController@sub')->name('sub');
Route::get('editsub/{id}','SubController@editsub')->name('editsub');
Route::post('updatesub/{id}','SubController@updatesub')->name('updatesub');
  Route::get('deletesub/{id}','SubController@deletesub')->name('deletesub');
//addlecturer
Route::get('addlecturer','LecturerController@addlecturer')->name('addlecturer');
Route::post('storelecturer','LecturerController@storelecturer')->name('storelecturer');
Route::get('editlecturer/{id}','LecturerController@editlecturer')->name('editlecturer');
Route::post('updatelecturer/{id}','LecturerController@updatelecturer')->name('updatelecturer');
Route::get('lecturers','LecturerController@lecturers')->name('lecturers');
//getsub ajax
//getlecturer
//getlecturer
//addcenter
Route::get('addcenter','CenterController@addcenter')->name('addcenter');
Route::post('storecenter','CenterController@storecenter')->name('storecenter');
 Route::get('editcenter/{id}','CenterController@editcenter')->name('editcenter');
Route::post('updatecenter/{id}','CenterController@updatecenter')->name('updatecenter');
Route::get('centers','CenterController@centers')->name('centers');
});



Route::group(['middleware' => ['auth','basic']],function(){
//addteacher
Route::get('addteacher','TeacherController@addteacher')->name('addteacher');
Route::post('storeteacher','TeacherController@storeteacher')->name('storeteacher');
Route::get('teachers','TeacherController@teachers')->name('teachers');
  Route::get('editteacher/{id}','TeacherController@editteacher')->name('editteacher');
Route::post('updateteacher/{id}','TeacherController@updateteacher')->name('updateteacher');
Route::get('addspecialbasic/{id}','SpecialbasicController@addspecialbasic')->name('addspecialbasic');
Route::post('storespecialbasic/{id}','SpecialbasicController@storespecialbasic')->name('storespecialbasic');
  Route::get('editspecialbasic/{id}','SpecialbasicController@editspecialbasic')->name('editspecialbasic');
Route::post('updatespecialbasic/{id}','SpecialbasicController@updatespecialbasic')->name('updatespecialbasic');
    Route::get('deletespecialbasic/{id}','SpecialbasicController@deletespecialbasic')->name('deletespecialbasic');
Route::get('givetypecourse','CourseController@givetypecourse')->name('givetypecourse');
Route::post('addtypecourse','dashboardcontroller@addtypecourse');
    //types
Route::get('types','TypeController@types')->name('types');
Route::get('addtype','TypeController@addtype')->name('addtype');
Route::post('storetype','TypeController@storetype')->name('storetype');
Route::get('edittype/{id}','TypeController@edittype')->name('edittype');
Route::post('updatetype/{id}','TypeController@updatetype')->name('updatetype');
Route::get('deletetype/{id}','TypeController@deletetype')->name('deletetype');
    Route::get('getstage/{id}','StageController@getstage')->name('getstage');

    //ajax in add video
    Route::get('getteacher/{id}','TeacherController@getteacher')->name('getteacher');
        Route::get('gettype/{id}/{value}','dashboardcontroller@gettype');//->name('gettype');

    Route::get('getyear/{id}','YearController@getyear')->name('getyear');
Route::get('getsubtype/{id}','SubtypeController@getsubtype')->name('getsubtype');

    //subtypes
Route::get('subtypes/{id}','SubtypeController@subtypes')->name('subtypes');
Route::get('addsubtype/{id}','SubtypeController@addsubtype')->name('addsubtype');
Route::post('storesubtype/{id}','SubtypeController@storesubtype')->name('storesubtype');
Route::get('editsubtype/{id}','SubtypeController@editsubtype')->name('editsubtype');
Route::post('updatesubtype/{id}','SubtypeController@updatesubtype')->name('updatesubtype');
  Route::get('deletesubtype/{id}','SubtypeController@deletesubtype')->name('deletesubtype');
  Route::get('subtypeattendstudents/{id}','SubtypeController@subtypeattendstudents')->name('subtypeattendstudents');

//grouptypes
Route::get('grouptypes/{id}','GroupTypeController@grouptypes')->name('grouptypes');
Route::get('addgrouptype/{id}','GroupTypeController@addgrouptype')->name('addgrouptype');
Route::post('storegrouptype/{id}','GroupTypeController@storegrouptype')->name('storegrouptype');
Route::get('editgrouptype/{id}','GroupTypeController@editgrouptype')->name('editgrouptype');
Route::post('updategrouptype/{id}','GroupTypeController@updategrouptype')->name('updategrouptype');
  Route::get('deletegrouptype/{id}','GroupTypeController@deletegrouptype')->name('deletegrouptype');
  //grouptypelivelessons
Route::get('grouptypelivelessons/{id}','GrouptypeLivelessonController@grouptypelivelessons')->name('grouptypelivelessons');
Route::get('addgrouptypelivelesson/{id}','GrouptypeLivelessonController@addgrouptypelivelesson')->name('addgrouptypelivelesson');
Route::post('storegrouptypelivelesson/{id}','GrouptypeLivelessonController@storegrouptypelivelesson')->name('storegrouptypelivelesson');
Route::get('editgrouptypelivelesson/{id}','GrouptypeLivelessonController@editgrouptypelivelesson')->name('editgrouptypelivelesson');
Route::post('updategrouptypelivelesson/{id}','GrouptypeLivelessonController@updategrouptypelivelesson')->name('updategrouptypelivelesson');
  Route::get('deletegrouptypelivelesson/{id}','GrouptypeLivelessonController@deletegrouptypelivelesson')->name('deletegrouptypelivelesson');
  //grouptypesstudents
  Route::get('grouptypestudents/{id}','GroupTypeController@grouptypestudents')->name('grouptypestudents');
Route::get('addgrouptypestudent/{id}','GroupTypeController@addgrouptypestudent')->name('addgrouptypestudent');
Route::post('storegrouptypestudent/{id}','GroupTypeController@storegrouptypestudent')->name('storegrouptypestudent');
  //subjectquestionss
Route::get('subjectquestionss/{id}','SubjectQuestionController@subjectquestionss')->name('subjectquestionss');
Route::get('addsubjectquestions/{id}','SubjectQuestionController@addsubjectquestions')->name('addsubjectquestions');
Route::post('storesubjectquestions/{id}','SubjectQuestionController@storesubjectquestions')->name('storesubjectquestions');
Route::get('editsubjectquestions/{id}','SubjectQuestionController@editsubjectquestions')->name('editsubjectquestions');
Route::post('updatesubjectquestions/{id}','SubjectQuestionController@updatesubjectquestions')->name('updatesubjectquestions');
  Route::get('deletesubjectquestions/{id}','SubjectQuestionController@deletesubjectquestions')->name('deletesubjectquestions');
//subjectquestionsscenter
    Route::get('subjectquestionsscenter','SubjectQuestionCenterController@subjectquestionsscenter')->name('subjectquestionsscenter');
    Route::get('addsubjectquestionscenter','SubjectQuestionCenterController@addsubjectquestionscenter')->name('addsubjectquestionscenter');
    Route::post('storesubjectquestionscenter','SubjectQuestionCenterController@storesubjectquestionscenter')->name('storesubjectquestionscenter');
    Route::get('editsubjectquestionscenter/{id}','SubjectQuestionCenterController@editsubjectquestionscenter')->name('editsubjectquestionscenter');
    Route::post('updatesubjectquestionscenter/{id}','SubjectQuestionCenterController@updatesubjectquestionscenter')->name('updatesubjectquestionscenter');
      Route::get('deletesubjectquestionscenter/{id}','SubjectQuestionCenterController@deletesubjectquestionscenter')->name('deletesubjectquestionscenter');
   Route::post('filtersubjectquestions','SubjectQuestionCenterController@filtersubjectquestions')->name('filtersubjectquestions');
  //typeexams
Route::get('typeexams/{id}','TypeExamController@typeexams')->name('typeexams');
Route::get('addtypeexam/{id}','TypeExamController@addtypeexam')->name('addtypeexam');
Route::post('storetypeexam/{id}','TypeExamController@storetypeexam')->name('storetypeexam');
Route::get('edittypeexam/{id}','TypeExamController@edittypeexam')->name('edittypeexam');
Route::post('updatetypeexam/{id}','TypeExamController@updatetypeexam')->name('updatetypeexam');
  Route::get('deletetypeexam/{id}','TypeExamController@deletetypeexam')->name('deletetypeexam');
  Route::get('typeexamresults/{id}','TypeExamController@typeexamresults')->name('typeexamresults');
      Route::get('alltypeexamresults','TypeExamController@alltypeexamresults')->name('alltypeexamresults');
  //subtypeexams
Route::get('subtypeexams/{id}','SubtypeExamController@subtypeexams')->name('subtypeexams');
Route::get('addsubtypeexam/{id}','SubtypeExamController@addsubtypeexam')->name('addsubtypeexam');
Route::post('storesubtypeexam/{id}','SubtypeExamController@storesubtypeexam')->name('storesubtypeexam');
Route::get('editsubtypeexam/{id}','SubtypeExamController@editsubtypeexam')->name('editsubtypeexam');
Route::post('updatesubtypeexam/{id}','SubtypeExamController@updatesubtypeexam')->name('updatesubtypeexam');
  Route::get('deletesubtypeexam/{id}','SubtypeExamController@deletesubtypeexam')->name('deletesubtypeexam');
  Route::get('subtypeexamresults/{id}','SubtypeExamController@subtypeexamresults')->name('subtypeexamresults');
  Route::get('allsubtypeexamresults','SubtypeExamController@allsubtypeexamresults')->name('allsubtypeexamresults');
  //videoexams
Route::get('videoexams/{id}','VideoExamController@videoexams')->name('videoexams');
Route::get('addvideoexam/{id}','VideoExamController@addvideoexam')->name('addvideoexam');
Route::post('storevideoexam/{id}','VideoExamController@storevideoexam')->name('storevideoexam');
Route::get('editvideoexam/{id}','VideoExamController@editvideoexam')->name('editvideoexam');
Route::post('updatevideoexam/{id}','VideoExamController@updatevideoexam')->name('updatevideoexam');
  Route::get('deletevideoexam/{id}','VideoExamController@deletevideoexam')->name('deletevideoexam');
//videos
Route::get('addvideo/{id}','VideoController@addvideo')->name('addvideo');
Route::get('editvideo/{id}','VideoController@editvideo')->name('editvideo');
  Route::get('deletevideo/{id}','VideoController@deletevideo')->name('deletevideo');
Route::get('videos/{id}','VideoController@videos')->name('videos');
  Route::post('storevideo/{id}','VideoController@storevideo')->name('storevideo');
Route::post('updatevideo/{id}','VideoController@updatevideo')->name('updatevideo');
});

Route::group(['middleware' => ['auth','college']],function(){

   // Route::get('logoutall','dashboardcontroller@logoutall')->name('logoutall');
   Route::get('main_page_college','MainPageController@main_page_college')->name('main_page_college');

Route::get('givetypecollegecourse','CourseController@givetypecollegecourse')->name('givetypecollegecourse');
Route::post('addtypecollegecourse','CourseController@addtypecollegecourse');

//addsubjectscollege
Route::get('addsubcollege','SubjectsCollegeController@addsubcollege')->name('addsubcollege');
Route::post('storesubcollege','SubjectsCollegeController@storesubcollege')->name('storesubcollege');
Route::get('subcolleges','SubjectsCollegeController@subcolleges')->name('subcolleges');
Route::get('editsubcollege/{id}','SubjectsCollegeController@editsubcollege')->name('editsubcollege');
Route::post('updatesubcollege/{id}','SubjectsCollegeController@updatesubcollege')->name('updatesubcollege');
Route::get('deletesubcollege/{id}','SubjectsCollegeController@deletesubcollege')->name('deletesubcollege');

    Route::get('getdivision/{id}','DivisionController@getdivision')->name('getdivision');

    //groupstypescolleges
Route::get('groupstypescollege/{id}','GroupTypescollegeController@groupstypescollege')->name('groupstypescollege');
Route::get('addgroupstypescollege/{id}','GroupTypescollegeController@addgroupstypescollege')->name('addgroupstypescollege');
Route::post('storegroupstypescollege/{id}','GroupTypescollegeController@storegroupstypescollege')->name('storegroupstypescollege');
Route::get('editgroupstypescollege/{id}','GroupTypescollegeController@editgroupstypescollege')->name('editgroupstypescollege');
Route::post('updategroupstypescollege/{id}','GroupTypescollegeController@updategroupstypescollege')->name('updategroupstypescollege');
  Route::get('deletegroupstypescollege/{id}','GroupTypescollegeController@deletegroupstypescollege')->name('deletegroupstypescollege');
  //groupstypescollegesstudents
  Route::get('groupstypescollegestudents/{id}','GroupTypescollegeController@groupstypescollegestudents')->name('groupstypescollegestudents');
Route::get('addgroupstypescollegestudent/{id}','GroupTypescollegeController@addgroupstypescollegestudent')->name('addgroupstypescollegestudent');
Route::post('storegroupstypescollegestudent/{id}','GroupTypescollegeController@storegroupstypescollegestudent')->name('storegroupstypescollegestudent');
   //grouptypescollegelivelessons
Route::get('grouptypescollegelivelessons/{id}','GroupstypescollegeLivelessonController@grouptypescollegelivelessons')->name('grouptypescollegelivelessons');
Route::get('addgrouptypescollegelivelesson/{id}','GroupstypescollegeLivelessonController@addgrouptypescollegelivelesson')->name('addgrouptypescollegelivelesson');
Route::post('storegrouptypescollegelivelesson/{id}','GroupstypescollegeLivelessonController@storegrouptypescollegelivelesson')->name('storegrouptypescollegelivelesson');
Route::get('editgrouptypescollegelivelesson/{id}','GroupstypescollegeLivelessonController@editgrouptypescollegelivelesson')->name('editgrouptypescollegelivelesson');
Route::post('updategrouptypescollegelivelesson/{id}','GroupstypescollegeLivelessonController@updategrouptypescollegelivelesson')->name('updategrouptypescollegelivelesson');
  Route::get('deletegrouptypescollegelivelesson/{id}','GroupstypescollegeLivelessonController@deletegrouptypescollegelivelesson')->name('deletegrouptypescollegelivelesson');
//subjectscollegequestions
Route::get('subjectscollegequestions/{id}','SubjectscollegeQuestionController@subjectscollegequestions')->name('subjectscollegequestions');
Route::get('addsubjectscollegequestions/{id}','SubjectscollegeQuestionController@addsubjectscollegequestions')->name('addsubjectscollegequestions');
Route::post('storesubjectscollegequestions/{id}','SubjectscollegeQuestionController@storesubjectscollegequestions')->name('storesubjectscollegequestions');
Route::get('editsubjectscollegequestions/{id}','SubjectscollegeQuestionController@editsubjectscollegequestions')->name('editsubjectscollegequestions');
Route::post('updatesubjectscollegequestions/{id}','SubjectscollegeQuestionController@updatesubjectscollegequestions')->name('updatesubjectscollegequestions');
  Route::get('deletesubjectscollegequestions/{id}','SubjectscollegeQuestionController@deletesubjectscollegequestions')->name('deletesubjectscollegequestions');
//subjectscollegequestionscenter
Route::get('subjectscollegequestionscenter','SubjectscollegeQuestionCenterController@subjectscollegequestionscenter')->name('subjectscollegequestionscenter');
Route::get('addsubjectscollegequestionscenter','SubjectscollegeQuestionCenterController@addsubjectscollegequestionscenter')->name('addsubjectscollegequestionscenter');
Route::post('storesubjectscollegequestionscenter','SubjectscollegeQuestionCenterController@storesubjectscollegequestionscenter')->name('storesubjectscollegequestionscenter');
Route::get('editsubjectscollegequestionscenter/{id}','SubjectscollegeQuestionCenterController@editsubjectscollegequestionscenter')->name('editsubjectscollegequestionscenter');
Route::post('updatesubjectscollegequestionscenter/{id}','SubjectscollegeQuestionCenterController@updatesubjectscollegequestionscenter')->name('updatesubjectscollegequestionscenter');
  Route::get('deletesubjectscollegequestionscenter/{id}','SubjectscollegeQuestionCenterController@deletesubjectscollegequestionscenter')->name('deletesubjectscollegequestionscenter');
  Route::post('filtersubjectscollegequestion','SubjectscollegeQuestionCenterController@filtersubjectscollegequestion')->name('filtersubjectscollegequestion');
    //typescollegeexams
Route::get('typescollegeexams/{id}','TypescollegeExamController@typescollegeexams')->name('typescollegeexams');
Route::get('addtypescollegeexam/{id}','TypescollegeExamController@addtypescollegeexam')->name('addtypescollegeexam');
Route::post('storetypescollegeexam/{id}','TypescollegeExamController@storetypescollegeexam')->name('storetypescollegeexam');
Route::get('edittypescollegeexam/{id}','TypescollegeExamController@edittypescollegeexam')->name('edittypescollegeexam');
Route::post('updatetypescollegeexam/{id}','TypescollegeExamController@updatetypescollegeexam')->name('updatetypescollegeexam');
  Route::get('deletetypescollegeexam/{id}','TypescollegeExamController@deletetypescollegeexam')->name('deletetypescollegeexam');
  Route::get('typecollegeexamresults/{id}','TypescollegeExamController@typecollegeexamresults')->name('typecollegeexamresults');
    Route::get('alltypecollegeexamresults','TypescollegeExamController@alltypecollegeexamresults')->name('alltypecollegeexamresults');
  //lessonexams
Route::get('lessonexams/{id}','LessonExamController@lessonexams')->name('lessonexams');
Route::get('addlessonexam/{id}','LessonExamController@addlessonexam')->name('addlessonexam');
Route::post('storelessonexam/{id}','LessonExamController@storelessonexam')->name('storelessonexam');
Route::get('editlessonexam/{id}','LessonExamController@editlessonexam')->name('editlessonexam');
Route::post('updatelessonexam/{id}','LessonExamController@updatelessonexam')->name('updatelessonexam');
  Route::get('deletelessonexam/{id}','LessonExamController@deletelessonexam')->name('deletelessonexam');
  Route::get('lessonexamresults/{id}','LessonExamController@lessonexamresults')->name('lessonexamresults');
     Route::get('alllessonexamresults','LessonExamController@alllessonexamresults')->name('alllessonexamresults');
  //videoscollegeexams
Route::get('videoscollegeexams/{id}','VideoscollegeExamController@videoscollegeexams')->name('videoscollegeexams');
Route::get('addvideoscollegeexam/{id}','VideoscollegeExamController@addvideoscollegeexam')->name('addvideoscollegeexam');
Route::post('storevideoscollegeexam/{id}','VideoscollegeExamController@storevideoscollegeexam')->name('storevideoscollegeexam');
Route::get('editvideoscollegeexam/{id}','VideoscollegeExamController@editvideoscollegeexam')->name('editvideoscollegeexam');
Route::post('updatevideoscollegeexam/{id}','VideoscollegeExamController@updatevideoscollegeexam')->name('updatevideoscollegeexam');
  Route::get('deletevideoscollegeexam/{id}','VideoscollegeExamController@deletevideoscollegeexam')->name('deletevideoscollegeexam');
//addtypescollege
Route::get('addtypescollege','TypesCollegeController@addtypescollege')->name('addtypescollege');
Route::post('storetypescollege','TypesCollegeController@storetypescollege')->name('storetypescollege');
Route::get('typescolleges','TypesCollegeController@typescolleges')->name('typescolleges');
Route::get('edittypescollege/{id}','TypesCollegeController@edittypescollege')->name('edittypescollege');
Route::post('updatetypescollege/{id}','TypesCollegeController@updatetypescollege')->name('updatetypescollege');
Route::get('deletetypescollege/{id}','TypesCollegeController@deletetypescollege')->name('deletetypescollege');

//addlesson
Route::get('addlesson/{id}','LessonController@addlesson')->name('addlesson');
Route::post('storelesson/{id}','LessonController@storelesson')->name('storelesson');
Route::get('lessons/{id}','LessonController@lessons')->name('lessons');
Route::get('editlesson/{id}','LessonController@editlesson')->name('editlesson');
Route::post('updatelesson/{id}','LessonController@updatelesson')->name('updatelesson');
Route::get('deletelesson/{id}','LessonController@deletelesson')->name('deletelesson');
  Route::get('lessonattendstudents/{id}','LessonController@lessonattendstudents')->name('lessonattendstudents');

//videoscollege
Route::get('addvideoscollege/{id}','VideosCollegeController@addvideoscollege')->name('addvideoscollege');
Route::post('storevideoscollege/{id}','VideosCollegeController@storevideoscollege')->name('storevideoscollege');
Route::get('editvideoscollege/{id}','VideosCollegeController@editvideoscollege')->name('editvideoscollege');
Route::post('updatevideoscollege/{id}','VideosCollegeController@updatevideoscollege')->name('updatevideoscollege');
	Route::get('deletevideoscollege/{id}','VideosCollegeController@deletevideoscollege')->name('deletevideoscollege');
Route::get('videoscolleges/{id}','VideosCollegeController@videoscolleges')->name('videoscolleges');
//typecollege ajax
Route::get('getdocsection/{id}','SectionController@getdocsection')->name('getdocsection');
Route::get('getdocsubcollege/{id}','SubjectsCollegeController@getdocsubcollege')->name('getdocsubcollege');

Route::get('getdoctypescollege/{id}','TypesCollegeController@getdoctypescollege')->name('getdoctypescollege');

//typecollege_joins

Route::get('typecollege_joins','TypecollegeJoinController@index')->name('typecollege_joins');
Route::get('accept_typecollege_join/{id}','TypecollegeJoinController@accept_typecollege_join')->name('accept_typecollege_join');
Route::get('refuse_typecollege_join/{id}','TypecollegeJoinController@refuse_typecollege_join')->name('refuse_typecollege_join');

});



Route::group(['middleware' => ['auth','lecture']],function(){
  //groupcourses
Route::get('groupcourses/{id}','GroupCourseController@groupcourses')->name('groupcourses');
Route::get('addgroupcourse/{id}','GroupCourseController@addgroupcourse')->name('addgroupcourse');
Route::post('storegroupcourse/{id}','GroupCourseController@storegroupcourse')->name('storegroupcourse');
Route::get('editgroupcourse/{id}','GroupCourseController@editgroupcourse')->name('editgroupcourse');
Route::post('updategroupcourse/{id}','GroupCourseController@updategroupcourse')->name('updategroupcourse');
  Route::get('deletegroupcourse/{id}','GroupCourseController@deletegroupcourse')->name('deletegroupcourse');
  //groupcoursesstudents
  Route::get('groupcoursestudents/{id}','GroupCourseController@groupcoursestudents')->name('groupcoursestudents');
Route::get('addgroupcoursestudent/{id}','GroupCourseController@addgroupcoursestudent')->name('addgroupcoursestudent');
Route::post('storegroupcoursestudent/{id}','GroupCourseController@storegroupcoursestudent')->name('storegroupcoursestudent');
  //groupcourselivelessons
  Route::get('groupcourselivelessons/{id}','GroupscourseLivelessonController@groupcourselivelessons')->name('groupcourselivelessons');
  Route::get('addgroupcourselivelesson/{id}','GroupscourseLivelessonController@addgroupcourselivelesson')->name('addgroupcourselivelesson');
  Route::post('storegroupcourselivelesson/{id}','GroupscourseLivelessonController@storegroupcourselivelesson')->name('storegroupcourselivelesson');
  Route::get('editgroupcourselivelesson/{id}','GroupscourseLivelessonController@editgroupcourselivelesson')->name('editgroupcourselivelesson');
  Route::post('updategroupcourselivelesson/{id}','GroupscourseLivelessonController@updategroupcourselivelesson')->name('updategroupcourselivelesson');
    Route::get('deletegroupcourselivelesson/{id}','GroupscourseLivelessonController@deletegroupcourselivelesson')->name('deletegroupcourselivelesson');
   // Route::get('logoutall','dashboardcontroller@logoutall')->name('logoutall');
 //subquestions
Route::get('subquestions/{id}','SubQuestionController@subquestions')->name('subquestions');
Route::get('addsubquestion/{id}','SubQuestionController@addsubquestion')->name('addsubquestion');
Route::post('storesubquestion/{id}','SubQuestionController@storesubquestion')->name('storesubquestion');
Route::get('editsubquestion/{id}','SubQuestionController@editsubquestion')->name('editsubquestion');
Route::post('updatesubquestion/{id}','SubQuestionController@updatesubquestion')->name('updatesubquestion');
  Route::get('deletesubquestion/{id}','SubQuestionController@deletesubquestion')->name('deletesubquestion');
    Route::get('getsub/{id}','SubController@getsub')->name('getsub');
Route::get('getlecturer/{id}','LecturerController@getlecturer')->name('getlecturer');
Route::get('getcourse/{id}','CourseController@getcourse')->name('getcourse');
Route::get('getsubcourses/{id}','CourseController@getsubcourses')->name('getsubcourses');
  //subquestioncenterss
 Route::get('subquestioncenterss','SubQuestionCenterController@subquestioncenterss')->name('subquestioncenterss');
 Route::get('addsubquestioncenters','SubQuestionCenterController@addsubquestioncenters')->name('addsubquestioncenters');
 Route::post('storesubquestioncenters','SubQuestionCenterController@storesubquestioncenters')->name('storesubquestioncenters');
 Route::get('editsubquestioncenters/{id}','SubQuestionCenterController@editsubquestioncenters')->name('editsubquestioncenters');
 Route::post('updatesubquestioncenters/{id}','SubQuestionCenterController@updatesubquestioncenters')->name('updatesubquestioncenters');
   Route::get('deletesubquestioncenters/{id}','SubQuestionCenterController@deletesubquestioncenters')->name('deletesubquestioncenters');
    //courseexams
  Route::get('courseexams/{id}','CourseExamController@courseexams')->name('courseexams');
  Route::get('addcourseexam/{id}','CourseExamController@addcourseexam')->name('addcourseexam');
  Route::post('storecourseexam/{id}','CourseExamController@storecourseexam')->name('storecourseexam');
  Route::get('editcourseexam/{id}','CourseExamController@editcourseexam')->name('editcourseexam');
  Route::post('updatecourseexam/{id}','CourseExamController@updatecourseexam')->name('updatecourseexam');
    Route::get('deletecourseexam/{id}','CourseExamController@deletecourseexam')->name('deletecourseexam');
 //videosgeneralexams
      Route::get('videosgeneralexams/{id}','VideosgeneralExamController@videosgeneralexams')->name('videosgeneralexams');
      Route::get('addvideosgeneralexam/{id}','VideosgeneralExamController@addvideosgeneralexam')->name('addvideosgeneralexam');
      Route::post('storevideosgeneralexam/{id}','VideosgeneralExamController@storevideosgeneralexam')->name('storevideosgeneralexam');
      Route::get('editvideosgeneralexam/{id}','VideosgeneralExamController@editvideosgeneralexam')->name('editvideosgeneralexam');
      Route::post('updatevideosgeneralexam/{id}','VideosgeneralExamController@updatevideosgeneralexam')->name('updatevideosgeneralexam');
        Route::get('deletevideosgeneralexam/{id}','VideosgeneralExamController@deletevideosgeneralexam')->name('deletevideosgeneralexam');
//addcourse
Route::get('addcourse','CourseController@addcourse')->name('addcourse');
Route::post('storecourse','CourseController@storecourse')->name('storecourse');
Route::get('course','CourseController@course')->name('course');
Route::get('editcourse/{id}','CourseController@editcourse')->name('editcourse');
Route::post('updatecourse/{id}','CourseController@updatecourse')->name('updatecourse');
   Route::get('deletecourse/{id}','CourseController@deletecourse')->name('deletecourse');
	Route::get('givecourse','CourseController@givecourse')->name('givecourse');
Route::post('addcourses','CourseController@addcourses');
//videosgeneral
Route::get('addvideosgeneral/{id}','VideosGeneralController@addvideosgeneral')->name('addvideosgeneral');
Route::post('storevideosgeneral/{id}','VideosGeneralController@storevideosgeneral')->name('storevideosgeneral');
Route::get('videosgeneral/{id}','VideosGeneralController@videosgeneral')->name('videosgeneral');
Route::get('editvideosgeneral/{id}','VideosGeneralController@editvideosgeneral')->name('editvideosgeneral');
  Route::get('deletevideosgeneral/{id}','VideosGeneralController@deletevideosgeneral')->name('deletevideosgeneral');
Route::post('updatevideosgeneral/{id}','VideosGeneralController@updatevideosgeneral')->name('updatevideosgeneral');
  //deletegeneral
  Route::get('deletegeneral/{id}','GeneralController@deletegeneral')->name('deletegeneral');
});


 //ajax in page adddoctor
    Route::post('getsection2','SectionController@getsection2')->name('getsection2');
    Route::post('getdivision2','DivisionController@getdivision2')->name('getdivision2');
     Route::post('getsubcollege2','SubjectsCollegeController@getsubcollege2')->name('getsubcollege2');
      Route::get('getsection/{id}','SectionController@getsection')->name('getsection');
Route::get('getsubcollege/{id}','SubjectsCollegeController@getsubcollege')->name('getsubcollege');
Route::get('gettypescollege/{id}','TypesCollegeController@gettypescollege')->name('gettypescollege');
Route::get('gettypescollege2/{id}','TypesCollegeController@gettypescollege2')->name('gettypescollege2');
Route::get('getlesson/{id}','LessonController@getlesson')->name('getlesson');
Route::get('logoutall','LoginController@logoutall')->name('logoutall');
//ajax get doctor from subjects
Route::get('getdoctor/{id}','DoctorController@getdoctor')->name('getdoctor');

Route::get('pointscash','PointController@pointscash')->name('pointscash');
Route::get('getstucode/{id}','PointController@getstucode')->name('getstucode');
Route::get('getmoney/{points}','PointController@getmoney')->name('getmoney');
Route::get('getpoints/{money}','PointController@getpoints')->name('getpoints');
Route::post('storestupoints','PointController@storestupoints')->name('storestupoints');
Route::get('getcolleges/{id}','CollegeController@getcolleges');
Route::get('getvideos/{id}','VideoController@getvideos');
Route::get('addspecialcollege/{id}','SpecialcollegeController@addspecialcollege')->name('addspecialcollege');
Route::get('specialbasic','SpecialbasicController@specialbasic')->name('specialbasic');
Route::get('specialcollege','SpecialcollegeController@specialcollege')->name('specialcollege');
Route::get('deletespecialcollege/{id}','SpecialcollegeController@deletespecialcollege')->name('deletespecialcollege');
Route::get('editspecialcollege/{id}','SpecialcollegeController@editspecialcollege')->name('editspecialcollege');
Route::post('updatespecialcollege/{id}','SpecialcollegeController@updatespecialcollege')->name('updatespecialcollege');
Route::post('storespecialcollege/{id}','SpecialcollegeController@storespecialcollege')->name('storespecialcollege');
Route::get('getvideosc/{id}','VideosCollegeController@getvideosc');
Route::get('activetype/{id}','TypeController@activetype');
Route::get('activesubtype/{id}','SubtypeController@activesubtype');
Route::get('activevideo/{id}','VideoController@activevideo');
Route::get('activecourse/{id}','CourseController@activecourse');
Route::get('activevideogeneral/{id}','VideosGeneralController@activevideogeneral');
Route::get('activelesson/{id}','LessonController@activelesson');
Route::get('activevideoco/{id}','VideosCollegeController@activevideoco');
Route::get('activetypecollege/{id}','TypesCollegeController@activetypecollege');
Route::get('activeuser/{id}','userscontroller@activeuser');
Route::post('getmanysubs','SubjectController@getmanysubs');
Route::post('activesubject','SubjectController@activesubject');
Route::get('getdoctorscollege/{id}','TypesCollegeController@getdoctorscollege');
Route::get('getvideossub/{id}','VideoController@getvideossub');
Route::get('getsubdocvideo/{id}','VideosCollegeController@getsubdocvideo');
Route::get('gettypecourse/{id}','CourseController@gettypecourse');
Route::get('gettypecollegecourse/{id}','CourseController@gettypecollegecourse');
Route::post("filtertypes","FilterCourseController@filtertypes");
Route::post("filtertypescollege","FilterCourseController@filtertypescollege");
Route::post("filtercourses","FilterCourseController@filtercourses");









Route::get("uploadVideos",function(){
  $videos = VideosCollege::all();
  $index = 0;
  foreach($videos as $video){  
    if($index==133){
    $file = file_get_contents(base_path() .'/public/uploads/'. $video->url,false);
      dd($video->url);
    if($file!=null){
    // $name = \Storage::disk('google')->put('13322.mp4', $file);
    // dd(\Storage::disk('google')->getMetadata("13322.mp4"));
    $value = $video->url;
      $oldName =  $video->url;
       $video->url  =  \Storage::disk("google")->getMetaData( \Storage::disk('google')->put($value,$file))["path"];
       $video->storage_type = 1;
       $video->save();
       if(public_path() . '/uploads/' . $oldName){

        $link1 = public_path() . '/uploads/' . $oldName;
            \File::delete($link1);
        }
  }
    // $name = \Storage::disk('google')->putFileAs("",$file,time(). '.mp4');
  }
  $index++;
}
});
