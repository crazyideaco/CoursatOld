@extends('website.website_layout')
@section('centent')
<section class="single_cource">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <!--begin::Aside-->
                <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                    <!--begin::Brand-->
                    <div class="brand flex-column-auto" id="kt_brand">
                        <!--begin::Logo-->
                        <p class="title">Cource name</p>
                        <!--end::Logo-->
                    </div>
                    <!--end::Brand-->
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                       
                        <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                            @foreach($lessons as $lesson1)
                      
                                <!-- parent lesson -->

                                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="{{route('course_lessons_videos_website',['lesson_id' => $lesson1->id,'course_id' => $course->id])}}" 
                                    class="menu-link menu-toggle">
                                        <span class="svg-icon menu-icon">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </span>
                                        <span class="menu-text">{{$lesson1->name_ar ?? ""}}</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                <span class="menu-link">
                                                    <span class="menu-text">{{$lesson1->name_ar ?? ""}}</span>
                                                </span>
                                            </li>
                                        </ul>
                                        <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                <a href="{{route('course_lessons_videos_website',['lesson_id' => $lesson1->id,'course_id' => $course->id])}}" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">  عرض الدرس</span>
                                                </a>
                                            </li>
                                            @foreach($lesson->videos as $video)
                                            <!-- Child video -->
                                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                <a href="{{route('course_videos',['video_id' => $video->id,'lesson_id',$lesson->id])}}" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{$video->name_ar}}</span>
                                                </a>
                                            </li>
                                            <!-- Child video -->
                                                @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <!-- parent lesson -->
@endforeach
                                
          
                        
                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>
                <!--end::Aside-->
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="video_lesson">
                    <p class="number">{{auth()->guard("website_student")->user()->name}}</p>
                    <video controls controlsList="nodownload nofullscreen" donotallowfullscreen 
                    disablePictureInPicture src="{{asset('uploads/'.$lesson->intro)}}"></video>
                </div>
                @if($lesson->pdf)
                <a href="{{asset('uploads/'.$lesson->pdf)}}" 
                target="_blank" download class="btn download_btn">Download PDF</a>
              @endif
            </div>  
        </div>
    </div>
</section>
@endsection