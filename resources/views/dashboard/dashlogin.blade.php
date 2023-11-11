<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset('images/logooo.svg') !!}" type="image/ico" />
    <title>coursat</title>

    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Chart.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">




</head>

<body>


    <div class="login">
        <div class="login-detials">
            <div class="login-title text-center">
                <h4>تسجيل الدخول</h4>
                <img src="{{ asset('images/login-lock.svg') }}">
            </div>
            <form method="POST" action="{{ route('startlogin') }}">
                @csrf
                <div class="form-group">
                    <label>البريد الالكتروني</label>
                    <div class="login-frm">
                        <input type="email" required class="form-control" placeholder="البريد الالكترونى"
                            name="email">
                        <span class="login-icon"><i class="far fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>الرمز السرى</label>
                    <div class="login-frm">
                        <input type="password" class="form-control" required placeholder="الرمز السرى" name="password">
                        <span class="login-icon"><i class="fas fa-lock"></i></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-check login-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">تذكرنى</label>
                </div>

                <div class="form-group text-center">
                    <input type="submit" class="btn login-submit" value="تسجيل الدخول">
                </div>

            </form>
        </div>

        <div class="login-rights">
            <h5>Made with <img src="{{ asset('images/red.svg') }}"> by Crazy Idea</h5>
            <p>Think Out Of The Box</p>
        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</html>
