<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FanZone-SignUp</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="signUpPage">
    <!-- start of navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top ">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img class="logo" src="imgs/logo.jpeg" alt="logo">
            </a>
            <a class="btn btn-primary rounded-pill main-btn " href="{{ route('login') }}">Login</a>


        </div>
    </nav>
    <!-- end of navbar -->

    <!--Sign up container-->
    <div class="container Signup_container position-relative">
        <h2 class="text-center mb-4">SignUp & Become A Fan </h2>
        <div class="progress">
            <div class="progress-bar bg-success" id="progress" style="width: 33.33%">Step 1</div>
        </div>

        <form method="POST" id="signup-form" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                @if(session('error'))

                <div class="alert alert-danger">{{ session('error') }}</div>

                @endif
            </div>

            <div class="step pageActive" id="step1">
                <h3>Step 1: Account Details</h3>
                <div class="row mb-3">

                    <div class="col-md-12">
                        <input id="semail" type="email" class="saveIn form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        <span><strong id="emailErrMsg" class="text-danger"></strong></span>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">


                    <div class="col-md-12">
                        <input id="spassword" type="password"
                            class="saveIn form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-md-12">
                        <input id="spassword-confirm" type="password" class="saveIn form-control"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password">
                        <span><strong id="passErrMsg" class="text-danger"></strong></span>

                    </div>
                </div>
                <div class="col-md-12">
                    <input type="tel" id="sphone" name="phone1"
                        class="saveIn form-control @error('phone1') is-invalid @enderror" name="phone1"
                        value="{{ old('phone1') }}" required autocomplete="phone1" placeholder="Phone Number">
                    <span><strong id="phoneErrMsg" class="text-danger"></strong></span>

                    @error('phone1')
                    <span class="invalid-feedback" role="alert">
                        <strong id="testTheErr" data-custom-attribute="exampleValue">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <p class="text-center my-2"><strong id="emptyErr" class="text-danger"></strong></p>

                <div class="text-center pt-3">
                    <button type="button" class="btn btn-success" onclick="nextStep()">Next</button>
                </div>
            </div>
            <div class="step" id="step2">
                <h3>Step 2: Personal Information</h3>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="sname" type="text" class="saveIn form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Name">
                        <span><strong id="nameErrMsg" class="text-danger"></strong></span>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <select class="saveIn form-control" id="sgender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="saveIn form-control" id="scountry" name="country" required>
                        <option value="">Select Country</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Romania">Romania</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Spain">Spain</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Yemen">Yemen</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" class="saveIn form-control" id="sbirth-date" name="birth_date" required>
                    <span id="age-validation-message"></span>
                </div>
                <div class="form-group">
                    <select class="saveIn form-control" id="sfavorite-team" name="team" required>
                        <option value="">Select Favorite Team</option>
                        @foreach ($teams as $team )
                        <option value="{{ $team->id }}">{{  $team->name }}</option>
                        @endforeach

                    </select>
                </div>
                <p class="text-center my-2"><strong id="emptyErr2" class="text-danger"></strong></p>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary mr-2" onclick="previousStep()">Previous</button>
                    <button type="button" class="btn btn-success" onclick='nextStep()'>Next</button>
                </div>
            </div>
            <div class="step" id="step3">
                <h3>Step 3: Photo Upload</h3>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group d-flex justify-content-between">
                                <div class="position-relative w-100">
                                    <label for="" class="uploadpart_label"> Please Upload your profile picture</label>
                                    <input id="photoInput" type="file" accept="image/*"
                                        class="form-control faceScan @error('profile_picture') is-invalid @enderror"
                                        name="profile_picture" value="{{ old('profile_picture') }}"
                                        autocomplete="profile_picture" autofocus placeholder="Profile Picture">

                                    <div class="fScanContainer position-absolute d-flex justify-content-between px-3">
                                        <div>
                                            <img class="w-100" src="{{ asset('imgs/electronics.png') }}"
                                                alt="face conditions">
                                        </div>
                                        <div class="w-70">
                                            <ul class="face-conditions">
                                                <li>Face takes up 70-80% of it.</li>
                                                <li>No sunglasses, hats, or caps.</li>
                                                <li>Show you alone with neutral expression.</li>
                                                <li>you have no rights if you uploaded another preson's photo.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="takePhotoBtn d-flex flex-column" id="takePhotoButton">
                                <i class="fa-solid fa-camera me-2"></i> <span>Take a Photo</span>
                            </div>
                        </div>
                    </div>

                </div>


                @error('profile_picture')
                <span class="invalid-feedback" role="alert">
                    <strong id='faceError'>{{ $message }}</strong>
                </span>
                @enderror
                <div class="d-none" id="faceErrMsg">
                    <span class="text-danger"> <strong>This not human image or image with low quality</strong></span>
                </div>


                <div class="col-md-12 " id="ssnId">
                    <label for="" class="uploadpart_label"> Please Upload your SSN image</label>
                    <div class="position-relative">
                        <input id="photo" type="image" accept="image/*"
                            class="form-control @error('ssn_image') is-invalid @enderror" name="ssn_image"
                            value="{{ old('ssn_image') }}" autocomplete="ssn_image" autofocus placeholder="SSN Image">

                        @error('ssn_image')
                        <span class="invalid-feedback" role="alert">
                            <strong id='ssnError'>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div
                            class="position-absolute d-flex justify-content-between align-items-center ssn-instructions px-3">
                            <div class="pt-2">
                                <img class="w-200px me-3 egy-ssn" src="{{ asset('imgs/egyssn.jpg') }}"
                                    alt="ssn instructions">
                            </div>
                            <div class="">
                                <ul class="face-conditions m-0">
                                    <li>Upload good quality photo.</li>
                                    <li>No background only ssn in the photo.</li>
                                    <li>Upload it as the following ex: .</li>
                                    <li>Make sure width is bigger than height.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3" id="passportId">
                    <label for="" class="uploadpart_label"> Please enter your SSN </label>
                    <input id="passId" type="text" class=" form-control @error('passport_id') is-invalid @enderror"
                        name="passport_id" value="{{ old('passport_id') }}" autocomplete="passport_id" autofocus
                        placeholder="passport ID ">

                    @error('passport_id')
                    <span class="invalid-feedback" role="alert">
                        <strong id="errPssportId">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="text-center pt-3">
                    <button type="button" class="btn btn-secondary mr-2" onclick="previousStep()">Previous</button>



                    <button type="submit" class="btn btn-success">
                        {{ __('Register') }}
                    </button>



                </div>

            </div>
        </form>


        <!-- camera -->
        <div id="camWindow" class="d-none justify-content-center align-items-center vh-100">
            <div id="camParent" class="position-relative">
                <video id="video" width="256" height="256" autoplay style="display: none"></video>
                <button class="btn btn-success" id="captureButton" style="display: none">
                    <i class="fa-solid fa-camera"></i>
                </button>
                <canvas id="canvas" width="256" height="256"></canvas>

                <div class="d-flex justify-content-center my-4">
                    <button class="btn btn-success m-0 me-3" id="confirmButton" style="display: none">
                        Confirm Photo <i class="fa-solid fa-check"></i>
                    </button>
                    <button class="btn btn-success m-0" id="retakeButton" style="display: none">
                        Retake Photo <i class="fa-solid fa-camera"></i>
                    </button>
                </div>

                <button class="text-danger closeCam btn position-absolute" onclick="closeCam()">
                    <i class="fa-solid fa-square-xmark fs-3"></i>
                </button>
            </div>
        </div>
        <!-- camera -->
    </div>
    <!--Sign up container-->







    <!-- camera script -->
    <script>
    //*********************************

    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const captureButton = document.getElementById("captureButton");
    const confirmButton = document.getElementById("confirmButton");
    const retakeButton = document.getElementById("retakeButton");
    const takePhotoButton = document.getElementById("takePhotoButton");
    const photoInput = document.getElementById("photoInput");
    const camWindow = document.getElementById("camWindow");

    function closeCam() {
        camWindow.classList.replace("d-flex", "d-none");
        const tracks = window.localStream.getTracks();
        tracks.forEach((track) => track.stop());
    }

    takePhotoButton.addEventListener("click", () => {
        camWindow.classList.replace("d-none", "d-flex");
        video.style.display = "block";
        captureButton.style.display = "block";

        // Access the user's camera
        navigator.mediaDevices
            .getUserMedia({
                video: true
            })
            .then((stream) => {
                video.srcObject = stream;
                window.localStream = stream; // Store the stream to stop it later
            })
            .catch((err) => {
                console.error("Error accessing the camera: " + err);
            });
    });

    // Capture the photo when the button is clicked
    captureButton.addEventListener("click", () => {
        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Stop the camera feed
        const tracks = window.localStream.getTracks();
        tracks.forEach((track) => track.stop());

        // Hide the video element and capture button
        video.style.display = "none";
        captureButton.style.display = "none";

        // Show the canvas and confirm/retake buttons
        canvas.style.display = "block";
        confirmButton.style.display = "block";
        retakeButton.style.display = "block";
    });

    // Confirm the photo
    confirmButton.addEventListener("click", () => {
        canvas.toBlob((blob) => {
            const file = new File([blob], "photo.png", {
                type: "image/png"
            });

            // Create a DataTransfer to add the file to the file input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            photoInput.files = dataTransfer.files;

            const tracks = window.localStream.getTracks();
            tracks.forEach((track) => track.stop());
            camWindow.classList.replace("d-flex", "d-none");
        });

        // Hide the confirm/retake buttons
        confirmButton.style.display = "none";
        retakeButton.style.display = "none";
    });

    // Retake the photo
    retakeButton.addEventListener("click", () => {
        // Hide the canvas and confirm/retake buttons
        canvas.style.display = "none";
        confirmButton.style.display = "none";
        retakeButton.style.display = "none";

        // Show the video element and capture button
        video.style.display = "block";
        captureButton.style.display = "block";

        // Restart the camera feed
        navigator.mediaDevices
            .getUserMedia({
                video: true
            })
            .then((stream) => {
                video.srcObject = stream;
                window.localStream = stream; // Store the stream to stop it later
            })
            .catch((err) => {
                console.error("Error accessing the camera: " + err);
            });
    });
    </script>
    <!-- camera script -->


    <!-- script files -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- script files -->

</body>

</html>
