<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Az cources</title>
    <link rel="icon" type="image/x-icon" href="{{asset('website/media/logo.ico')}}" />

    <link rel="stylesheet" href="{{asset('website/scss/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}" />
  </head>
  <body oncontextmenu="return false">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('courses_website')}}">
            <img src="{{asset('website/media/logo_nav.png')}}" alt="logo">
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('courses_website')}}">الرئيسيه</a>
            </li>
            <li class="nav-item">
              <p class="nav-link"> {{auth()->guard("website_student")->user()->name}}</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('logout_website')}}">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @yield("centent")