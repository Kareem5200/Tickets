<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FanZone-Login</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}c">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login ">
        <div class="row ">
            <div class="col-md-7 p-0">
                <div class="logimg position-relative">
                    <img class="login-logo " src="imgs/logong.png" alt="FanZone Logo">
                </div>
            </div>

            <div class="col-md-5 mob-login p-5">
                <h1 class="mb-5">Sign in</h1>
                <div class="data-log pt-5 ">
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <div class="txt-field-login position-relative mb-5">
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span></span>
                        <label for="">email</label>

                            @error('email')
                            <p class="invalid-feedback position-absolute top-100" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                    </div>


                    <div class="txt-field-login position-relative">
                        <input id="password" type="password" class=" border-0  @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <span></span>
                        <label for="">password</label>

                        @error('password')
                        <p class="invalid-feedback position-absolute top-100" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }}>

                        <label class="form-check-label pb-3" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>


                    <button type="submit" class="btn btn-success rounded-pill w-50">
                        {{ __('Login') }}
                    </button>


                    <div class="fpass ">
                        @if (Route::has('password.request'))
                        <a class="btn ps-0 btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>




                    <div class="signup_link ">Not a Fan?
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Sign up</a>
                        @endif
                    </div>

                </form>

                </div>

            </div>
        </div>


    </div>


</body>


</html>
