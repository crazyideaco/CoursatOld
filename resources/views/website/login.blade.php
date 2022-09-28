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
            <form action="cources.html" method="" class="box">
              <img src="media/logo.png" class="logo" alt="logo" />
              <br />
              <span class="lo">User Login</span>
              <br />
              <input type="email" name="email" placeholder="Email" required />

              <input
                type="password"
                name="password"
                placeholder="Password"
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
  </body>
</html>
