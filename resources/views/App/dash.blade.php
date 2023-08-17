<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="dexcription" content="">

    <meta name="author" content="ehabtalaat">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{!! asset('images/pro.png')!!}" type="image/ico" />
    <title>coursat</title>
    <link rel="icon" href="{!! asset('images/ehab.svg')!!}" />
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/bootstrap-rtl.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/Chart.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/sweet-alert.css')}}" rel="stylesheet">
    {{-- <script src="{{asset('js/sweetalert2.all.min.js')}}"></script> --}}

    <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/promise-polyfill/8.3.0/polyfill.min.js" integrity="sha512-310GmPyrxvjHYxcTy7HdjCN7EYL9ou4DldEiu1oABpNFUcEbPfcESbQ+4lZBIAsYb2KuKjJpvWaDxQUINj4I8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <!--font awesome 5-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" integrity="sha512-z13ghwce5srTmilJxE0+xd80zU6gJKJricLCq084xXduZULD41qpjRE9QpWmbRyJq6kZ2yAaWyyPAgdxwxFEAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: 35%;
            left: 35%;
            z-index: 100;
        }

        .setting .info .form-group button.dropdown-toggle {
            width: 100% !important;
        }

        .bootstrap-select .dropdown-toggle .filter-option {
            text-align: start;
        }

        table tbody tr td {
            padding: 2rem 1rem !important;
        }

        .table tbody tr {
            margin-bottom: 10px !important;
            border-bottom: 2px solid #f8f9fd !important;
        }

        .table thead tr th {
            background: #fff !important;
            border-bottom: 4px solid #eceffa !important;
        }

        .table thead tr td {
            background: #fff !important;
            border-bottom: 4px solid #eceffa !important;
        }

        .table tbody tr td {
            background: #fff !important;
            border-bottom: 1px solid #eceffa !important;
        }




        /* Layout */
        .s-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .s-layout__content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        /* Sidebar */
        .s-sidebar__trigger {
            z-index: 2;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4em;
            background: #243e56;
        }

        .s-sidebar__trigger>i {
            display: inline-block;
            margin: 1.5em 0 0 1.5em;
            color: #f07ab0;
        }

        .s-sidebar__nav {
            position: fixed;
            top: 0;
            right: 0;
            overflow-y: auto;
            transition: all .3s ease-in;
            width: 18%;
            height: 100%;
            background: #243e56;
            color: rgba(255, 255, 255, 0.7);
            overflow-x: hidden;
        }

        .s-sidebar__nav .lists {
            height: 100%;
        }

        .s-sidebar__nav:hover,
        .s-sidebar__nav:focus,
        .s-sidebar__trigger:focus+.s-sidebar__nav,
        .s-sidebar__trigger:hover+.s-sidebar__nav {
            left: 0;
        }

        .s-sidebar__nav ul {
            position: absolute;
            top: 4em;
            left: 0;
            margin: 0;
            padding: 0;
            width: 15em;
        }

        .s-sidebar__nav ul li {
            width: 100%;
        }

        .s-sidebar__nav-link {
            position: relative;
            display: inline-block;
            width: 100%;
            height: 4em;
        }

        .s-sidebar__nav-link em {
            position: absolute;
            top: 50%;
            left: 4em;
            transform: translateY(-50%);
        }

        .s-sidebar__nav-link:hover {
            background: #4d6276;
        }

        .s-sidebar__nav-link>i {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            width: 4em;
            height: 4em;
        }

        .s-sidebar__nav-link>i::before {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Mobile First */
        @media only screen and (max-width: 991.98px) {
            .s-layout__content {
                margin-left: 4em;
            }

            .side-bar {
                width: 0;
            }

            .page-body {
                width: 100%;
            }

            .page-body {
                margin-top: 15%;
            }

            /* Sidebar */
            .s-sidebar__trigger {
                width: 100%;
                display: flex;
                z-index: 99999;
            }

            .s-sidebar__trigger svg {
                color: #fff;
                font-size: 2rem;
                align-items: center;
                height: 100%;
                margin-right: 5%;
            }

            .s-sidebar__nav {
                width: 0;
                right: 0;
            }

            .s-sidebar__nav:hover,
            .s-sidebar__nav:focus,
            .s-sidebar__trigger:hover+.s-sidebar__nav,
            .s-sidebar__trigger:focus+.s-sidebar__nav {
                width: 15em;
                z-index: 99;
                top: 4em;
            }

            .page-body .heed .profile {
                width: 30%;
            }

            .page-body .heed .noti {
                width: 5%;
                margin-right: 10%;
                margin-left: 10%;
            }

            .page-body .heed .flag,
            .page-body .heed .datee {
                width: 20%;
            }
        }

        @media only screen and (max-width: 767.98px) {
            .page-body .heed {
                height: fit-content;
                padding: 5% 0;
            }

            .page-body .heed .profile,
            .page-body .heed .noti,
            .page-body .heed .flag,
            .page-body .heed .datee {
                width: 40%;
                margin: 2% 5%;
            }

            .page-body .heed .profile h5,
            .page-body .heed .profile p {
                font-size: 10px;
                margin: 0;
            }
        }

        @media (min-width: 68em) {
            .s-layout__content {
                margin-left: 15em;
            }

            /* Sidebar */
            .s-sidebar__trigger {
                display: none
            }

            .s-sidebar__nav {
                width: 18%;
            }

            .s-sidebar__nav ul {
                top: 1.3em;
            }
        }
    </style>
    @yield('style')

</head>

<body>

    <!--start sidebar-->

    <div id="loading">
        <img id="loading-image" src="{{asset('600.jpg')}}" style="width:300px;height:300px;">
    </div>
    <div class="row">
        <div class="s-layout__sidebar side-bar">
            <a class="s-sidebar__trigger" href="#0">
                <i class="fa fa-bars"></i>
            </a>

            <nav class="s-sidebar__nav">
                <div class="logo text-center">
                    <h5><img src="{{asset('images/pro.png')}}" style="width:100px;height:80px;margin-top:20px;"></h5>
                </div>

                <div class="lists">
                    <div>
                    @if(Auth::user() &&Auth::user()->is_student == 3 || (Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 2))
                        <div class="row">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-8">

                               <a href="{{route('main_page_college')}}"> <p>الرئيسية</p></a>

                                <p>الرئيسية</p>

                            </div>
                        </div>
                        @elseif(auth()->user()->isAdmin == 'admin')

                        @else
                        <div class="row">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-8">

                               <p>الرئيسية</p>



                            </div>
                        </div>
                        @endif

                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting2" data-toggle="collapse">الرئيسية</a>
                                <div id="setting2" class="collapse
                                @if(request()->is('main_page_basic')  ||
                                 request()->is('main_page_college')) show    @endif">

                                    <a href="{{route('main_page_basic')}}"
                                    style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('main_page_basic'))active @endif">
                                         اساسى</a>
                                    <a href="{{route('main_page_college')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('main_page_college'))
    active @endif">
                                         جامعى</a>

                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting2" data-toggle="collapse">
                                    <img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>



                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting2" data-toggle="collapse">البروفايل</a>
                                <div id="setting2" class="collapse @if(request()->is('editprofile')  || request()->is('editpassword') || request()->is('edityourinformation')) show    @endif">
                                    <a href="{{route('editprofile')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('editprofile'))active @endif">
                                        تعديل البروفايل</a>
                                    <a href="{{route('edityourinformation')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('edityourinformation'))active @endif">
                                        تعديل معلوماتك</a>
                                    <a href="{{route('editpassword')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('editpassword'))active @endif">
                                        تعديل كلمه السر</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting2" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#nots" data-toggle="collapse">الاشعارات</a>
                                <div id="nots" class="collapse @if(request()->is('sendnotification') || request()->is('senduniversitynotification') || request()->is('sendgeneralnotification') || request()->is('sendnoty')) show    @endif">
                                    <a href="{{route('sendnoty')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('sendnoty'))active @endif">
                                        ارسال اشعارات </a>
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                                    <a href="{{route('sendnotification')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('sendnotification'))active @endif">
                                        ارسال اشعارات اساسى </a>

                                    <a href="{{route('senduniversitynotification')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('senduniversitynotification'))active @endif">
                                        ارسال اشعارات جامعى </a>
                                    <a href="{{route('sendgeneralnotification')}}" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="@if(request()->is('sendgeneralnotification'))active @endif">
                                        ارسال اشعارات لكورس عام </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#nots" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/setting.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting" data-toggle="collapse">الاعدادات</a>
                                <div id="setting" class="collapse @if(request()->is('states') ||request()->is('states') || request()->is('admins') ||  request()->is('cities') ||
                             request()->is('categoryall') || request()->is('messages') ||
                             request()->is('website_students')) show  @endif">
                                    <a href="{{route('categoryall')}}" class="@if(request()->is('categoryall'))active @endif">
                                        الفئات</a>
                                        <a href="{{route('offers')}}" class="@if(request()->is('offers'))active @endif">
                                            السلايدر</a>
                                    <a href="{{route('admins')}}" class="@if(request()->is('admins'))active @endif">
                                        الادمنز</a>
                                    <a href="{{route('states')}}" class="@if(request()->is('states'))active @endif">
                                        المحافظات</a>
                                    <a href="{{route('cities')}}" class="@if(request()->is('cities'))active @endif">
                                        المدن</a>

                                    <a href="{{route('points')}}" class="@if(request()->is('points'))active @endif">
                                        النقاط</a>
                                    <a href="{{route('pointscash')}}" class="@if(request()->is('pointscash'))active @endif">
                                        صرف النقاط</a>
                                    <a href="{{route('messages')}}" class="@if(request()->is('messages'))active @endif">
                                        رسائل المستخدمين</a>
                                        <a href="{{route('website_students.index')}}" class="@if(request()->is('website_students'))active @endif">
                                        طلاب الموقع </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user() && (Auth::user()->isAdmin == 'admin'||Auth::user()->is_student == 2
                        || (Auth::user()->is_student == 5 && Auth()->user()->category_id == 1)))
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/primery.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#products" data-toggle="collapse" id="kk">اساسى </a>
                                <div id="products" class="collapse @if(request()->is('stages') || request()->is('years')
                    || request()->is('types') || request()->is('subtypes') || request()->is('subjects') || request()->is('addvideo')
                    || request()->is('videos')  || request()->is('addpaqabasic') || request()->is('userpaqabasic') || request()->is('subjectquestionsscenter') ||
                                              request()->is('alltypeexamresults') ||
                                              request()->is('allsubtypeexamresults') ||
                                               request()->is('typecollege_joins')) show  @endif">
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                                    <a href="{{route('stages')}}" class="@if(request()->is('stages'))active @endif">المراحل</a>
                                    <a href="{{route('years')}}" class="@if(request()->is('years'))active @endif">السنوات</a>
                                    <a href="{{route('subjects')}}" class="@if(request()->is('subjects'))active @endif">
                                        المواد</a>
                                    @endif
                                    <a href="{{route('types')}}" class="@if(request()->is('types'))active @endif">
                                        الدورات التعلميه الشهريه
                                    </a>
                                    @if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 1)
                                    <a href="{{route('offers')}}" class="@if(request()->is('offers'))active @endif">
                                        السلايدر</a>
                                    <a href="{{route('addteacher')}}" class="@if(request()->is('addteacher'))active @endif">
                                        اضافه مدرس</a>
                                    <a href="{{route('teachers')}}" class="@if(request()->is('teachers'))active @endif">
                                        المدرسين</a>
                                    <a href="{{route('givetypecourse')}}" class="@if(request()->is('givetypecourse'))active @endif">
                                        اضافه كورس لطالب</a>
                                    <a href="{{route('mytypestudents')}}" class="@if(request()->is(' mytypestudents'))active @endif">
                                        طلاب كورساتى </a>

                                    @endif @if(Auth::user()->is_student == 2)

                                    <a href="{{route('givetypecourse')}}" class="@if(request()->is('givetypecourse'))active @endif">
                                        اضافه كورس لطالب</a>
                                    <a href="{{route('mytypestudents')}}" class="@if(request()->is(' mytypestudents'))active @endif">
                                        طلاب كورساتى </a>
                                    <a href="{{route('userstudents')}}" class="@if(request()->is('userstudents'))active @endif">
                                        الطلاب </a>

                                    @endif
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')

                                    <a href="{{route('addpaqabasic')}}" class="@if(request()->is('addpaqabasic'))active @endif">
                                        اضافه اشتراك</a>
                                    <a href="{{route('userpaqabasic')}}" class="@if(request()->is('userpaqabasic'))active @endif">
                                        الاشتراكات</a>
                                    <a href="{{route('alltypeexamresults')}}" class="@if(request()->is('alltypeexamresults'))active @endif">
                                        نتائج امتحانات الكورسات </a>
                                    <a href="{{route('allsubtypeexamresults')}}" class="@if(request()->is('allsubtypeexamresults'))active @endif">
                                        نتائج امتحانات الحصص </a>

                                    @endif
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                                    @if(Auth::user()->hasPermission("typecollege_joins-read"))

                                    <a href="{{route('type_joins')}}" class="
                              @if(request()->is('type_joins'))active @endif">
                                        طلبات الانضمام</a>
                                        
                                        @endif

                                        @else
                                        <a href="{{route('type_joins')}}" class="
                                        @if(request()->is('type_joins'))active @endif">
                                                  طلبات الانضمام</a>
                                                  @endif

                                    <a href="{{route('subjectquestionsscenter')}}" class="@if(request()->is('subjectquestionsscenter'))active @endif">
                                        بنك الاسئله</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#products" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @endif

                        @if(Auth::user() && (Auth::user()->isAdmin == 'admin' || Auth::user()->is_student == 3
                        || Auth::user()->category_id == 2))

                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/collage.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#report" data-toggle="collapse">جامعى </a>
                                <div id="report" class="collapse @if(request()->is('colleges') || request()->is('divisions')
                    || request()->is('sections') || request()->is('subcolleges') || request()->is('typescolleges')
                     || request()->is('lessons') || request()->is('videoscolleges') || request()->is('addvideoscollege')|| request()->is('addpaqacollage')|| request()->is('userpaqacollage') || request()->is('subjectscollegequestionscenter') || request()->is('alltypecollegeexamresults') || request()->is('alllessonexamresults'))
                    show  @endif">

                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                                    <a href="{{route('universities')}}" class="@if(request()->is('universities'))active @endif">الجامعات</a>
                                    <a href="{{route('colleges')}}" class="@if(request()->is('colleges'))active @endif">الكليات</a>
                                    <a href="{{route('divisions')}}" class="@if(request()->is('divisions'))active @endif">الاقسام</a>
                                    <a href="{{route('sections')}}" class="@if(request()->is('sections'))active @endif">الفرق</a>
                                    <a href="{{route('subcolleges')}}" class="@if(request()->is('subcolleges'))active @endif">المواد
                                    </a>
                                    @endif


                                    <a href="{{route('typescolleges')}}" class="@if(request()->is('typescolleges'))active @endif">
                                        كورسات جامعيه</a>

                                    @if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 2)
                                    <a href="{{route('offers')}}" class="@if(request()->is('offers'))active @endif">
                                        السلايدر</a>
                                    <a href="{{route('adddoctor')}}" class="@if(request()->is('adddoctor'))active @endif">
                                        اضافه دكتور</a>
                                    <a href="{{route('doctors')}}" class="@if(request()->is('doctors'))active @endif">
                                        الدكاتره</a>
                                    @endif
                                    @if((Auth::user()->is_student == 5 && Auth()->user()->category_id == 2) || Auth::user()->is_student == 3)
                                    <a href="{{route('givetypecollegecourse')}}" class="@if(request()->is('givetypecollegecourse'))active @endif">
                                        اضافه كورس لطالب</a>
                                    <a href="{{route('mytypestudents')}}" class="@if(request()->is(' mytypestudents'))active @endif">
                                        طلاب كورساتى </a>
                                    <a href="{{route('userstudents')}}" class="@if(request()->is('userstudents'))active @endif">
                                        الطلاب </a>
                                    @endif
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')

                                    <a href="{{route('addpaqacollage')}}" class="@if(request()->is('addpaqacollage'))active @endif">
                                        اضافه اشتراك</a>


                                    <a href="{{route('userpaqacollage')}}" class="@if(request()->is('userpaqacollage'))active @endif">
                                        الاشتراكات</a>
                                    <a href="{{route('alltypecollegeexamresults')}}" class="@if(request()->is('alltypecollegeexamresults'))active @endif">
                                        نتائج امتحانات الكورسات </a>
                                    <a href="{{route('alllessonexamresults')}}" class="@if(request()->is('alllessonexamresults'))active @endif">
                                        نتائج امتحانات الحصص </a>

                                    @endif

                                    <a href="{{route('subjectscollegequestionscenter')}}" class="@if(request()->is('subjectscollegequestionscenter'))active @endif">
                                        بنك الاسئله</a>
                                    <a href="{{route('typecollege_joins')}}" class="
                              @if(request()->is('typecollege_joins'))active @endif">
                                        طلبات الانضمام</a>

                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#report" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user() && (Auth::user()->isAdmin == 'admin'||Auth::user()->is_student == 4 ||
                        Auth::user()->category_id == 3))
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/all.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#orders" data-toggle="collapse">عام</a>
                                <div id="orders" class="collapse  @if(request()->is('general') || request()->is('sub')
                    || request()->is('addcourse') || request()->is('course') ||  request()->is('videosgeneral') ||
                    request()->is('addvideosgeneral')||
                    request()->is('addpaqapublic') ||
                    request()->is('userpaqapublic')  ||
                    request()->is('subquestioncenterss'))
                    show  @endif">
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')

                                    <a href="{{route('general')}}" class="@if(request()->is('general'))active @endif">الاقسام الرئيسيه</a>
                                    <a href="{{route('sub')}}" class="@if(request()->is('sub'))active @endif">الاقسام الفرعيه</a>
                                    @endif
                                    <!---     <a href="{{route('addcourse')}}" class="@if(request()->is('addcourse'))active @endif">اضافه كورس</a> -->
                                    <a href="{{route('course')}}" class="@if(request()->is('course'))active @endif">كورسات عامه
                                    </a>


                                    @if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 3)
                                    <a href="{{route('addlecturer')}}" class="@if(request()->is('addlecturer'))active @endif">
                                        اضافه محاضر</a>
                                    <a href="{{route('lecturers')}}" class="@if(request()->is('lecturers'))active @endif">
                                        المحاضرين</a>
                                    <a href="{{route('givecourse')}}" class="@if(request()->is('givecourse'))active @endif">
                                        اضافه كورس لطالب</a>
                                    <a href="{{route('mytypestudents')}}" class="@if(request()->is('mytypestudents'))active @endif">
                                        طلاب كورساتى </a>
                                    @endif
                                    @if(Auth::user()->is_student == 4)
                                    <a href="{{route('givecourse')}}" class="@if(request()->is('givecourse'))active @endif">
                                        اضافه كورس لطالب</a>
                                    <a href="{{route('mytypestudents')}}" class="@if(request()->is('mytypestudents'))active @endif">
                                        طلاب كورساتى </a>
                                    <a href="{{route('userstudents')}}" class="@if(request()->is('userstudents'))active @endif">
                                        الطلاب </a>
                                    @endif
                                    @if(Auth::user() && Auth::user()->isAdmin == 'admin')

                                    <a href="{{route('addpaqapublic')}}" class="@if(request()->is('addpaqapublic'))active @endif">
                                        اضافه اشتراك</a>



                                    <a href="{{route('userpaqapublic')}}" class="@if(request()->is('userpaqapublic'))active @endif">
                                        الاشتراكات</a>

                                    @endif
                                    <a href="{{route('subquestioncenterss')}}" class="@if(request()->is('subquestioncenterss'))active @endif">
                                        بنك الاسئله</a>


                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#orders" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user() && Auth::user()->isAdmin == 'admin')
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/all.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#set1" data-toggle="collapse">باقات</a>
                                <div id="set1" class="collapse  @if(request()->is('paqas'))show  @endif">

                                    <a href="{{route('paqas')}}" class="@if(request()->is('paqas'))active @endif"> الباقات</a>

                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#set1" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>

                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="{{asset('images/qenoicon/users.svg')}}" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting1" data-toggle="collapse">المستخدمين</a>
                                <div id="setting1" class="collapse @if(request()->is('teachers') || request()->is('addteacher') ||
                            request()->is('students') || request()->is('doctors') || request()->is('adddoctor')
                            || request()->is('lecturers') || request()->is('addlecturer') || request()->is('addcenter')
                            || request()->is('centers')  || request()->is('basicstudents') ||  request()->is('collegestudents')
                            || request()->is('unverified_students'))
                            show  @endif">
                                    <a href="{{route('addteacher')}}" class="@if(request()->is('addteacher'))active @endif">
                                        اضافه مدرس</a>
                                    <a href="{{route('teachers')}}" class="@if(request()->is('teachers'))active @endif">
                                        المدرسين</a>
                                    <a href="{{route('adddoctor')}}" class="@if(request()->is('adddoctor'))active @endif">
                                        اضافه دكتور</a>
                                    <a href="{{route('doctors')}}" class="@if(request()->is('doctors'))active @endif">
                                        الدكاتره</a>
                                    <a href="{{route('addlecturer')}}" class="@if(request()->is('addlecturer'))active @endif">
                                        اضافه محاضر</a>
                                    <a href="{{route('lecturers')}}" class="@if(request()->is('lecturers'))active @endif">
                                        المحاضرين</a>
                                    <a href="{{route('addcenter')}}" class="@if(request()->is('addcenter'))active @endif">
                                        اضافه مركز</a>
                                    <a href="{{route('centers')}}" class="@if(request()->is('centers'))active @endif">
                                        المراكز</a>
                                    <a href="{{route('students')}}" class="@if(request()->is('students'))active @endif">
                                        الطلاب</a>

                                    <a href="{{route('basicstudents')}}" class="@if(request()->is('basicstudents'))active @endif">
                                        طلاب الاساسى </a>
                                    <a href="{{route('collegestudents')}}" class="@if(request()->is('collegestudents'))active @endif">
                                        طلاب الجامعى</a>

                                        <a href="{{route('unverified_students')}}" class="@if(request()->is('collegestudents'))active @endif">
                                        unverified students</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting1" data-toggle="collapse"><img src="{{asset('images/arrow.svg')}}" id="arr"></a>
                            </div>
                        </div>
                        @endif

                        <div class="row log text-center">
                            <div class="col-1 offset-1">
                                <img src="{{asset('images/qenoicon/logout.svg')}}" id="img">
                            </div>
                            <div class="col-9">
                                <a href="{{route('logoutall')}}" id="log-p">تسجيل الخروج</a>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
        <!--end sidebar-->
        @yield('content')
    </div>
</body>
<!--<script src="{{asset('js/bootstrap.min.js')}}"></script>-->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/all.min.js')}}"></script>
<script src="{{asset('js/Chart.min.js')}}"></script>
<script src="{{asset('js/Chart.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script>
    window.onload = function() {
        document.getElementById("loading").style.display = 'none';
        //   document.getElementById('#loading').style.display = 'none';
    };
    $(".selectpicker").selectpicker();
</script>
<script src="{{asset('js/sweet-alert.min.js')}}"></script>


@yield('scripts')

</html>
