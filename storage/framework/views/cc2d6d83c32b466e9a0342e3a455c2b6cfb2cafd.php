<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="dexcription" content="">

    <meta name="author" content="ehabtalaat">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="icon" href="<?php echo asset('images/pro.png'); ?>" type="image/ico" />
    <title>coursat</title>
    <link rel="icon" href="<?php echo asset('images/ehab.svg'); ?>" />
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/Chart.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="sweetalert2.all.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <!--font awesome 5-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
        @media  only screen and (max-width: 991.98px) {
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

        @media  only screen and (max-width: 767.98px) {
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
    <?php echo $__env->yieldContent('style'); ?>

</head>

<body>

    <!--start sidebar-->

    <div id="loading">
        <img id="loading-image" src="<?php echo e(asset('600.jpg')); ?>" style="width:300px;height:300px;">
    </div>
    <div class="row">
        <div class="s-layout__sidebar side-bar">
            <a class="s-sidebar__trigger" href="#0">
                <i class="fa fa-bars"></i>
            </a>

            <nav class="s-sidebar__nav">
                <div class="logo text-center">
                    <h5><img src="<?php echo e(asset('images/pro.png')); ?>" style="width:100px;height:80px;margin-top:20px;"></h5>
                </div>

                <div class="lists">
                    <div>
                        <div class="row">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/setting.svg')); ?>" id="img">
                            </div>
                            <div class="col-8">
                                <p>الرئيسية</p>
                            </div>
                        </div>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/setting.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting2" data-toggle="collapse">البروفايل</a>
                                <div id="setting2" class="collapse <?php if(request()->is('editprofile')  || request()->is('editpassword') || request()->is('edityourinformation')): ?> show    <?php endif; ?>">
                                    <a href="<?php echo e(route('editprofile')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('editprofile')): ?>active <?php endif; ?>">
                                        تعديل البروفايل</a>
                                    <a href="<?php echo e(route('edityourinformation')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('edityourinformation')): ?>active <?php endif; ?>">
                                        تعديل معلوماتك</a>
                                    <a href="<?php echo e(route('editpassword')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('editpassword')): ?>active <?php endif; ?>">
                                        تعديل كلمه السر</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting2" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/setting.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#nots" data-toggle="collapse">الاشعارات</a>
                                <div id="nots" class="collapse <?php if(request()->is('sendnotification') || request()->is('senduniversitynotification') || request()->is('sendgeneralnotification') || request()->is('sendnoty')): ?> show    <?php endif; ?>">
                                    <a href="<?php echo e(route('sendnoty')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('sendnoty')): ?>active <?php endif; ?>">
                                        ارسال اشعارات </a>
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                                    <a href="<?php echo e(route('sendnotification')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('sendnotification')): ?>active <?php endif; ?>">
                                        ارسال اشعارات اساسى </a>

                                    <a href="<?php echo e(route('senduniversitynotification')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('senduniversitynotification')): ?>active <?php endif; ?>">
                                        ارسال اشعارات جامعى </a>
                                    <a href="<?php echo e(route('sendgeneralnotification')); ?>" style="color: #aa7700;
    font-family: med;
    font-size: 12px;
    margin-top: 8px;
    white-space: nowrap !important;" class="<?php if(request()->is('sendgeneralnotification')): ?>active <?php endif; ?>">
                                        ارسال اشعارات لكورس عام </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#nots" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/setting.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting" data-toggle="collapse">الاعدادات</a>
                                <div id="setting" class="collapse <?php if(request()->is('offers')  || request()->is('states') || request()->is('admins') ||  request()->is('cities') ||
                             request()->is('categoryall') || request()->is('messages')): ?> show  <?php endif; ?>">
                                    <a href="<?php echo e(route('categoryall')); ?>" class="<?php if(request()->is('categoryall')): ?>active <?php endif; ?>">
                                        الفئات</a>
                                    <a href="<?php echo e(route('offers')); ?>" class="<?php if(request()->is('offers')): ?>active <?php endif; ?>">
                                        السلايدر</a>
                                    <a href="<?php echo e(route('admins')); ?>" class="<?php if(request()->is('admins')): ?>active <?php endif; ?>">
                                        الادمنز</a>
                                    <a href="<?php echo e(route('states')); ?>" class="<?php if(request()->is('states')): ?>active <?php endif; ?>">
                                        المحافظات</a>
                                    <a href="<?php echo e(route('cities')); ?>" class="<?php if(request()->is('cities')): ?>active <?php endif; ?>">
                                        المدن</a>

                                    <a href="<?php echo e(route('points')); ?>" class="<?php if(request()->is('points')): ?>active <?php endif; ?>">
                                        النقاط</a>
                                    <a href="<?php echo e(route('pointscash')); ?>" class="<?php if(request()->is('pointscash')): ?>active <?php endif; ?>">
                                        صرف النقاط</a>
                                    <a href="<?php echo e(route('messages')); ?>" class="<?php if(request()->is('messages')): ?>active <?php endif; ?>">
                                        رسائل المستخدمين</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(Auth::user() && (Auth::user()->isAdmin == 'admin'||Auth::user()->is_student == 2
                        || (Auth::user()->is_student == 5 && Auth()->user()->category_id == 1))): ?>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/primery.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#products" data-toggle="collapse" id="kk">اساسى </a>
                                <div id="products" class="collapse <?php if(request()->is('stages') || request()->is('years')
                    || request()->is('types') || request()->is('subtypes') || request()->is('subjects') || request()->is('addvideo')
                    || request()->is('videos')  || request()->is('addpaqabasic') || request()->is('userpaqabasic') || request()->is('subjectquestionsscenter') ||
                                              request()->is('alltypeexamresults') ||
                                              request()->is('allsubtypeexamresults') ||
                                               request()->is('typecollege_joins')): ?> show  <?php endif; ?>">
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                                    <a href="<?php echo e(route('stages')); ?>" class="<?php if(request()->is('stages')): ?>active <?php endif; ?>">المراحل</a>
                                    <a href="<?php echo e(route('years')); ?>" class="<?php if(request()->is('years')): ?>active <?php endif; ?>">السنوات</a>
                                    <a href="<?php echo e(route('subjects')); ?>" class="<?php if(request()->is('subjects')): ?>active <?php endif; ?>">
                                        المواد</a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('types')); ?>" class="<?php if(request()->is('types')): ?>active <?php endif; ?>">
                                        الدورات التعلميه الشهريه
                                    </a>
                                    <?php if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 1): ?>
                                    <a href="<?php echo e(route('addteacher')); ?>" class="<?php if(request()->is('addteacher')): ?>active <?php endif; ?>">
                                        اضافه مدرس</a>
                                    <a href="<?php echo e(route('teachers')); ?>" class="<?php if(request()->is('teachers')): ?>active <?php endif; ?>">
                                        المدرسين</a>
                                    <a href="<?php echo e(route('givetypecourse')); ?>" class="<?php if(request()->is('givetypecourse')): ?>active <?php endif; ?>">
                                        اضافه كورس لطالب</a>
                                    <a href="<?php echo e(route('mytypestudents')); ?>" class="<?php if(request()->is(' mytypestudents')): ?>active <?php endif; ?>">
                                        طلاب كورساتى </a>

                                    <?php endif; ?> <?php if(Auth::user()->is_student == 2): ?>

                                    <a href="<?php echo e(route('givetypecourse')); ?>" class="<?php if(request()->is('givetypecourse')): ?>active <?php endif; ?>">
                                        اضافه كورس لطالب</a>
                                    <a href="<?php echo e(route('mytypestudents')); ?>" class="<?php if(request()->is(' mytypestudents')): ?>active <?php endif; ?>">
                                        طلاب كورساتى </a>
                                    <a href="<?php echo e(route('userstudents')); ?>" class="<?php if(request()->is('userstudents')): ?>active <?php endif; ?>">
                                        الطلاب </a>
                                    <?php endif; ?>
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>

                                    <a href="<?php echo e(route('addpaqabasic')); ?>" class="<?php if(request()->is('addpaqabasic')): ?>active <?php endif; ?>">
                                        اضافه اشتراك</a>
                                    <a href="<?php echo e(route('userpaqabasic')); ?>" class="<?php if(request()->is('userpaqabasic')): ?>active <?php endif; ?>">
                                        الاشتراكات</a>
                                    <a href="<?php echo e(route('alltypeexamresults')); ?>" class="<?php if(request()->is('alltypeexamresults')): ?>active <?php endif; ?>">
                                        نتائج امتحانات الكورسات </a>
                                    <a href="<?php echo e(route('allsubtypeexamresults')); ?>" class="<?php if(request()->is('allsubtypeexamresults')): ?>active <?php endif; ?>">
                                        نتائج امتحانات الحصص </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('subjectquestionsscenter')); ?>" class="<?php if(request()->is('subjectquestionsscenter')): ?>active <?php endif; ?>">
                                        بنك الاسئله</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#products" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(Auth::user() && (Auth::user()->isAdmin == 'admin' || Auth::user()->is_student == 3
                        || Auth::user()->category_id == 2)): ?>

                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/collage.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#report" data-toggle="collapse">جامعى </a>
                                <div id="report" class="collapse <?php if(request()->is('colleges') || request()->is('divisions')
                    || request()->is('sections') || request()->is('subcolleges') || request()->is('typescolleges')
                     || request()->is('lessons') || request()->is('videoscolleges') || request()->is('addvideoscollege')|| request()->is('addpaqacollage')|| request()->is('userpaqacollage') || request()->is('subjectscollegequestionscenter') || request()->is('alltypecollegeexamresults') || request()->is('alllessonexamresults')): ?>
                    show  <?php endif; ?>">

                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                                    <a href="<?php echo e(route('universities')); ?>" class="<?php if(request()->is('universities')): ?>active <?php endif; ?>">الجامعات</a>
                                    <a href="<?php echo e(route('colleges')); ?>" class="<?php if(request()->is('colleges')): ?>active <?php endif; ?>">الكليات</a>
                                    <a href="<?php echo e(route('divisions')); ?>" class="<?php if(request()->is('divisions')): ?>active <?php endif; ?>">الاقسام</a>
                                    <a href="<?php echo e(route('sections')); ?>" class="<?php if(request()->is('sections')): ?>active <?php endif; ?>">الفرق</a>
                                    <a href="<?php echo e(route('subcolleges')); ?>" class="<?php if(request()->is('subcolleges')): ?>active <?php endif; ?>">المواد
                                    </a>
                                    <?php endif; ?>


                                    <a href="<?php echo e(route('typescolleges')); ?>" class="<?php if(request()->is('typescolleges')): ?>active <?php endif; ?>">
                                        كورسات جامعيه</a>

                                    <?php if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 2): ?>

                                    <a href="<?php echo e(route('adddoctor')); ?>" class="<?php if(request()->is('adddoctor')): ?>active <?php endif; ?>">
                                        اضافه دكتور</a>
                                    <a href="<?php echo e(route('doctors')); ?>" class="<?php if(request()->is('doctors')): ?>active <?php endif; ?>">
                                        الدكاتره</a>
                                    <?php endif; ?>
                                    <?php if((Auth::user()->is_student == 5 && Auth()->user()->category_id == 2) || Auth::user()->is_student == 3): ?>
                                    <a href="<?php echo e(route('givetypecollegecourse')); ?>" class="<?php if(request()->is('givetypecollegecourse')): ?>active <?php endif; ?>">
                                        اضافه كورس لطالب</a>
                                    <a href="<?php echo e(route('mytypestudents')); ?>" class="<?php if(request()->is(' mytypestudents')): ?>active <?php endif; ?>">
                                        طلاب كورساتى </a>
                                    <a href="<?php echo e(route('userstudents')); ?>" class="<?php if(request()->is('userstudents')): ?>active <?php endif; ?>">
                                        الطلاب </a>
                                    <?php endif; ?>
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>

                                    <a href="<?php echo e(route('addpaqacollage')); ?>" class="<?php if(request()->is('addpaqacollage')): ?>active <?php endif; ?>">
                                        اضافه اشتراك</a>


                                    <a href="<?php echo e(route('userpaqacollage')); ?>" class="<?php if(request()->is('userpaqacollage')): ?>active <?php endif; ?>">
                                        الاشتراكات</a>
                                    <a href="<?php echo e(route('alltypecollegeexamresults')); ?>" class="<?php if(request()->is('alltypecollegeexamresults')): ?>active <?php endif; ?>">
                                        نتائج امتحانات الكورسات </a>
                                    <a href="<?php echo e(route('alllessonexamresults')); ?>" class="<?php if(request()->is('alllessonexamresults')): ?>active <?php endif; ?>">
                                        نتائج امتحانات الحصص </a>

                                    <?php endif; ?>

                                    <a href="<?php echo e(route('subjectscollegequestionscenter')); ?>" class="<?php if(request()->is('subjectscollegequestionscenter')): ?>active <?php endif; ?>">
                                        بنك الاسئله</a>
                                    <a href="<?php echo e(route('typecollege_joins')); ?>" class="
                              <?php if(request()->is('typecollege_joins')): ?>active <?php endif; ?>">
                                        طلبات الانضمام</a>

                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#report" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(Auth::user() && (Auth::user()->isAdmin == 'admin'||Auth::user()->is_student == 4 ||
                        Auth::user()->category_id == 3)): ?>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/all.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#orders" data-toggle="collapse">عام</a>
                                <div id="orders" class="collapse  <?php if(request()->is('general') || request()->is('sub')
                    || request()->is('addcourse') || request()->is('course') ||  request()->is('videosgeneral') ||
                    request()->is('addvideosgeneral')||
                    request()->is('addpaqapublic') ||
                    request()->is('userpaqapublic')  ||
                    request()->is('subquestioncenterss')): ?>
                    show  <?php endif; ?>">
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>

                                    <a href="<?php echo e(route('general')); ?>" class="<?php if(request()->is('general')): ?>active <?php endif; ?>">الاقسام الرئيسيه</a>
                                    <a href="<?php echo e(route('sub')); ?>" class="<?php if(request()->is('sub')): ?>active <?php endif; ?>">الاقسام الفرعيه</a>
                                    <?php endif; ?>
                                    <!---     <a href="<?php echo e(route('addcourse')); ?>" class="<?php if(request()->is('addcourse')): ?>active <?php endif; ?>">اضافه كورس</a> -->
                                    <a href="<?php echo e(route('course')); ?>" class="<?php if(request()->is('course')): ?>active <?php endif; ?>">كورسات عامه
                                    </a>


                                    <?php if(Auth::user()->is_student == 5 && Auth()->user()->category_id == 3): ?>
                                    <a href="<?php echo e(route('addlecturer')); ?>" class="<?php if(request()->is('addlecturer')): ?>active <?php endif; ?>">
                                        اضافه محاضر</a>
                                    <a href="<?php echo e(route('lecturers')); ?>" class="<?php if(request()->is('lecturers')): ?>active <?php endif; ?>">
                                        المحاضرين</a>
                                    <a href="<?php echo e(route('givecourse')); ?>" class="<?php if(request()->is('givecourse')): ?>active <?php endif; ?>">
                                        اضافه كورس لطالب</a>
                                    <a href="<?php echo e(route('mytypestudents')); ?>" class="<?php if(request()->is('mytypestudents')): ?>active <?php endif; ?>">
                                        طلاب كورساتى </a>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->is_student == 4): ?>
                                    <a href="<?php echo e(route('givecourse')); ?>" class="<?php if(request()->is('givecourse')): ?>active <?php endif; ?>">
                                        اضافه كورس لطالب</a>
                                    <a href="<?php echo e(route('mytypestudents')); ?>" class="<?php if(request()->is('mytypestudents')): ?>active <?php endif; ?>">
                                        طلاب كورساتى </a>
                                    <a href="<?php echo e(route('userstudents')); ?>" class="<?php if(request()->is('userstudents')): ?>active <?php endif; ?>">
                                        الطلاب </a>
                                    <?php endif; ?>
                                    <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>

                                    <a href="<?php echo e(route('addpaqapublic')); ?>" class="<?php if(request()->is('addpaqapublic')): ?>active <?php endif; ?>">
                                        اضافه اشتراك</a>



                                    <a href="<?php echo e(route('userpaqapublic')); ?>" class="<?php if(request()->is('userpaqapublic')): ?>active <?php endif; ?>">
                                        الاشتراكات</a>

                                    <?php endif; ?>
                                    <a href="<?php echo e(route('subquestioncenterss')); ?>" class="<?php if(request()->is('subquestioncenterss')): ?>active <?php endif; ?>">
                                        بنك الاسئله</a>


                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#orders" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(Auth::user() && Auth::user()->isAdmin == 'admin'): ?>
                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/all.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#set1" data-toggle="collapse">باقات</a>
                                <div id="set1" class="collapse  <?php if(request()->is('paqas')): ?>show  <?php endif; ?>">

                                    <a href="<?php echo e(route('paqas')); ?>" class="<?php if(request()->is('paqas')): ?>active <?php endif; ?>"> الباقات</a>

                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#set1" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>

                        <div class="row sub-side">
                            <div class="col-2">
                                <img src="<?php echo e(asset('images/qenoicon/users.svg')); ?>" id="img">
                            </div>
                            <div class="col-6">
                                <a href="#setting1" data-toggle="collapse">المستخدمين</a>
                                <div id="setting1" class="collapse <?php if(request()->is('teachers') || request()->is('addteacher') ||
                            request()->is('students') || request()->is('doctors') || request()->is('adddoctor')
                            || request()->is('lecturers') || request()->is('addlecturer') || request()->is('addcenter')
                            || request()->is('centers')  || request()->is('basicstudents') ||  request()->is('collegestudents')): ?>
                            show  <?php endif; ?>">
                                    <a href="<?php echo e(route('addteacher')); ?>" class="<?php if(request()->is('addteacher')): ?>active <?php endif; ?>">
                                        اضافه مدرس</a>
                                    <a href="<?php echo e(route('teachers')); ?>" class="<?php if(request()->is('teachers')): ?>active <?php endif; ?>">
                                        المدرسين</a>
                                    <a href="<?php echo e(route('adddoctor')); ?>" class="<?php if(request()->is('adddoctor')): ?>active <?php endif; ?>">
                                        اضافه دكتور</a>
                                    <a href="<?php echo e(route('doctors')); ?>" class="<?php if(request()->is('doctors')): ?>active <?php endif; ?>">
                                        الدكاتره</a>
                                    <a href="<?php echo e(route('addlecturer')); ?>" class="<?php if(request()->is('addlecturer')): ?>active <?php endif; ?>">
                                        اضافه محاضر</a>
                                    <a href="<?php echo e(route('lecturers')); ?>" class="<?php if(request()->is('lecturers')): ?>active <?php endif; ?>">
                                        المحاضرين</a>
                                    <a href="<?php echo e(route('addcenter')); ?>" class="<?php if(request()->is('addcenter')): ?>active <?php endif; ?>">
                                        اضافه مركز</a>
                                    <a href="<?php echo e(route('centers')); ?>" class="<?php if(request()->is('centers')): ?>active <?php endif; ?>">
                                        المراكز</a>
                                    <a href="<?php echo e(route('students')); ?>" class="<?php if(request()->is('students')): ?>active <?php endif; ?>">
                                        الطلاب</a>

                                    <a href="<?php echo e(route('basicstudents')); ?>" class="<?php if(request()->is('basicstudents')): ?>active <?php endif; ?>">
                                        طلاب الاساسى </a>
                                    <a href="<?php echo e(route('collegestudents')); ?>" class="<?php if(request()->is('collegestudents')): ?>active <?php endif; ?>">
                                        طلاب الجامعى</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#setting1" data-toggle="collapse"><img src="<?php echo e(asset('images/arrow.svg')); ?>" id="arr"></a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row log text-center">
                            <div class="col-1 offset-1">
                                <img src="<?php echo e(asset('images/qenoicon/logout.svg')); ?>" id="img">
                            </div>
                            <div class="col-9">
                                <a href="<?php echo e(route('logoutall')); ?>" id="log-p">تسجيل الخروج</a>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
        <!--end sidebar-->
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
<!--<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>-->
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/all.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.bundle.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script>
    window.onload = function() {
        document.getElementById("loading").style.display = 'none';
        //   document.getElementById('#loading').style.display = 'none';
    };
    $(".selectpicker").selectpicker();
</script>

<?php echo $__env->yieldContent('scripts'); ?>

</html>
<?php /**PATH /home/azcour/public_html/resources/views/App/dash.blade.php ENDPATH**/ ?>