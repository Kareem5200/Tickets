<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FanZone Admins Only</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">




</head>

<body>

    <div class="adminLogin">
        <div class="wrapper">
            <form action="{{ route('admin.checkLogin') }}" method="POST">
                @csrf
                <h1>Login "Admin"</h1>
                <legend class="fs-6 text-center mb-3">This login page is for admins only <i
                        title="dont Share this page with other people" class="fa-solid fa-circle-exclamation"></i>
                </legend>



                <div class="text-center my-3">
                    <a id="signup-btn" class="btn-primary">Go to Sign Up</a>
                </div>
                @if (session('loginError'))
                <div class="alert alert-danger">
                    {{ session('loginError') }}
                </div>
                @endif
                @if(session('registerError'))
                <div class="alert alert-danger">
                    {{ session('registerError') }}
                </div>
                @endif
                <div class="input-box">
                    <input type="text" placeholder="Email" name="email" class=" @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    <span></span>

                    @error('error')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                <div class="input-box">
                    <input type="password" placeholder="Password" name="password"
                        class=" @error('password') is-invalid @enderror" autocomplete="email" autofocus required>

                </div>
                @error('Password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <div class="adminSinup">
        <div class="wrapper">


            <form action="{{ route('admin.store') }}" enctype="multipart/form-data" method="POST"
                id="admin-signup-form">
                @csrf
                <h1>Sign Up "Admin"</h1>
                <legend class="fs-6 text-center mb-3">This Signup page is for admins only <i
                        title="dont Share this page with other people" class="fa-solid fa-circle-exclamation"></i>
                </legend>
                <div class="text-center mt-3">
                    <a id="login-btn" class=" btn-primary"> Go To Login</a>
                </div>
                <div class="row flex-wrap">
                    <div class="col-md-6">
                        <div class="input-box">
                            <input type="text" id="admin-name" placeholder="Admin Name" name="name" required>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="input-box">
                            <input type="email" id="admin-email" placeholder="Admin email" name="email" required>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 w-50-xsm">
                        <div class="input-box">
                            <input type="password" id="admin-password" placeholder="Password" name="password" required>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 w-50-xsm">
                        <div class="input-box">
                            <input type="password" id="admin-confirm-password" placeholder="Confirm Password"
                                name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="col-md-6 w-50-xsm">
                        <div class="input-box">
                            <input type="text" id="admin-key" placeholder="Key" name="secret_key" required>
                        </div>
                        @error('secret_key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 w-50-xsm">
                        <div class="input-box">
                            <input type="text" id="admin-ssn" placeholder="SSN" name="ssn" required minlength="14"
                                maxlength="14">
                        </div>
                        @error('ssn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="input-box">
                            <select id="sgender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="admin-image">
                            <input class="w-100" type="file" id="admin-image" placeholder="Profile pricture "
                                accept="image/*" name="profile_picture" required>
                        </div>
                        @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>




    <script>
    //-------toggel for el page of admin singup&login------------------
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    const adminLogin = document.querySelector('.adminLogin');
    const adminSignup = document.querySelector('.adminSinup');

    loginBtn.addEventListener('click', () => {
        adminLogin.style.display = 'block';
        adminSignup.style.display = 'none';
    });

    signupBtn.addEventListener('click', () => {
        adminLogin.style.display = 'none';
        adminSignup.style.display = 'block';
    });
    </script>
    <!-- script files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- script files -->




</body>

</html>
