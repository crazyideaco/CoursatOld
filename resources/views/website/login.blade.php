<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Az cources</title>
    <link rel="icon" type="image/x-icon" href="{{asset('website/media/logo.ico')}}" />

    <link rel="stylesheet" href="{{asset('website/scss/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body oncontextmenu="return false">
        <!-- Mobile preview -->
        <div class="mobile_preview">
          <img src="{{asset('website/media/logo_nav.png')}}" alt="logo">
          <div class="buttons">
            <a href="https://apps.apple.com/eg/app/azcourses/id1592327429" class="apple_btn">
              <img src="{{asset('website/media/apple.png')}}" alt="apple">
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.crazyidea.azcourses" class="google_btn">
              <img src="{{asset('website/media/google.png')}}" alt="google">
            </a>
          </div>
        </div>
        <!-- Mobile preview -->
    <section class="login">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-5 col-12 align-items-center px-0">
            <!-- SVG File -->
            <div id="rr">
              <lottie-player
                src="https://assets4.lottiefiles.com/private_files/lf30_vtbeu3qj.json"
                background="transparent"
                speed="1"
                loop
                autoplay
              ></lottie-player>
            </div>
          </div>

          <div class="col-lg-6 col-12 align-items-center">
            <form action="{{route('signin_website')}}" method="post" class="box">
              @csrf
              <img src="{{asset('website/media/logo.png')}}" class="logo" alt="logo" />
              <br />
              <span class="lo">User Login</span>
              <br />
              <input type="number" name="phone" placeholder="phone" required />

              <input
                type="password"
                name="password"
              
                required
              />

              <input type="Submit" id="log" value="Login" />
            </form>
          </div>
        </div>
      </div>
    </section>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('website/js/main.js')}}"></script>
    @if(session('success'))
<script>
Swal.fire({
position: 'center',
icon: 'success',
title:"{{session('success')}}",
showConfirmButton: false,
timer: 1500
})

</script>
@endif
@if(session('error'))
<script>

Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: "{{session('error')}}"
  })

</script>
@endif
  </body>
</html>
