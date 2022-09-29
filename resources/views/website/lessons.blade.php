@extends('website.website_layout')
@section('centent')
<section class="single_cource">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <!--begin::Aside-->
            <div
              class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
              id="kt_aside"
            >
              <!--begin::Brand-->
              <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <p class="title">Cource name</p>
                <!--end::Logo-->
              </div>
              <!--end::Brand-->
              <!--begin::Aside Menu-->
              <div
                class="aside-menu-wrapper flex-column-fluid"
                id="kt_aside_menu_wrapper"
              >
                <!--begin::Menu Container-->
                <div
                  id="kt_aside_menu"
                  class="aside-menu"
                  data-menu-vertical="1"
                  data-menu-scroll="1"
                  data-menu-dropdown-timeout="500"
                >
                  <!--begin::Menu Nav-->
                  <ul class="menu-nav">
                    <!-- parent lesson -->
                
                    <li
                      class="menu-item menu-item-submenu"
                      aria-haspopup="true"
                      data-menu-toggle="hover"
                    >
                      <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                          <i class="fas fa-chalkboard-teacher"></i>
                        </span>
                        <span class="menu-text">Lesson 1</span>
                        <i class="menu-arrow"></i>
                      </a>
                      <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                          <li
                            class="menu-item menu-item-parent"
                            aria-haspopup="true"
                          >
                            <span class="menu-link">
                              <span class="menu-text">Lesson 1</span>
                            </span>
                          </li>
                        </ul>
                        <ul class="menu-subnav">
                          <!-- Child video -->
                          <li
                            class="menu-item menu-item-submenu"
                            aria-haspopup="true"
                            data-menu-toggle="hover"
                          >
                            <a href="#" class="menu-link menu-toggle">
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">Video 1</span>
                            </a>
                          </li>
                          <!-- Child video -->

                          <!-- Child video -->
                          <li
                            class="menu-item menu-item-submenu"
                            aria-haspopup="true"
                            data-menu-toggle="hover"
                          >
                            <a
                              href="single_course.html"
                              class="menu-link menu-toggle"
                            >
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">Video 2</span>
                            </a>
                          </li>
                          <!-- Child video -->
                        </ul>
                      </div>
                    </li>
                    <!-- parent lesson -->

                    <!-- parent lesson -->
                    <li
                      class="menu-item menu-item-submenu"
                      aria-haspopup="true"
                      data-menu-toggle="hover"
                    >
                      <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                          <i class="fas fa-chalkboard-teacher"></i>
                        </span>
                        <span class="menu-text">Lesson 2</span>
                        <i class="menu-arrow"></i>
                      </a>
                      <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                          <li
                            class="menu-item menu-item-parent"
                            aria-haspopup="true"
                          >
                            <span class="menu-link">
                              <span class="menu-text">Lesson 1</span>
                            </span>
                          </li>
                        </ul>
                        <ul class="menu-subnav">
                          <!-- Child video -->
                          <li
                            class="menu-item menu-item-submenu"
                            aria-haspopup="true"
                            data-menu-toggle="hover"
                          >
                            <a href="#" class="menu-link menu-toggle">
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">Video 1</span>
                            </a>
                          </li>
                          <!-- Child video -->

                          <!-- Child video -->
                          <li
                            class="menu-item menu-item-submenu"
                            aria-haspopup="true"
                            data-menu-toggle="hover"
                          >
                            <a href="#" class="menu-link menu-toggle">
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">Video 2</span>
                            </a>
                          </li>
                          <!-- Child video -->
                        </ul>
                      </div>
                    </li>
                    <!-- parent lesson -->
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
              <p class="number">01111488849</p>
              <video controls controlsList="nodownload nofullscreen" donotallowfullscreen disablePictureInPicture src="./media/video/Dondorma.mp4"></video>
            </div>
            <a href="https://www.africau.edu/images/default/sample.pdf" target="_blank" download class="btn download_btn">Download PDF</a>
          </div>
        </div>
      </div>
    </section>
    @endsec