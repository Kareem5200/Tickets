@extends('layouts.app')
@section('title')
<title>Welcome</title>
@endsection


@section('content')

<!-- start of lnading -->





<div class="landing  align-items-center justify-content-between ">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>

        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('imgs/background.jpg') }}" class="d-block w-100" alt="background one">

                <div class="container  text-center  homedataOne carousel-caption  d-md-block">
                    <p class="title">Be with your <br> favorite team and <br><span>Book Now!</span> </p>
                    <div class=" d-flex">
                        @if (Route::has('register'))
                        <a class="signup-btn scondary-btn me-2" href="{{ route('register') }}"><i
                                class="fa-solid fa-user-plus"></i> <br> Become a fan</a>
                        @endif
                        <a class="higlight-btn scondary-btn" href="{{ route('highlights') }}"><i class="fa-solid fa-eye"></i><br> View
                            Highlights</a>
                    </div>
                </div>


            </div>

            <div class="carousel-item">
                <img src="{{ asset('imgs/background2-3.jpg') }}" class="d-block w-100" alt="...">

                <div class="container text-start  homedataTwo carousel-caption  d-md-block">

                    <div class="d-flex justify-content-around">
                        <p class="title fs-1  d-inline-block">Join Us on Mobile<br>Available on App
                            Store<br><span>Download
                                Now!</span><br>
                            <span class="landing-Icon google p-2 me-2"><i
                                    class="fa-brands fa-google-play pe-2"></i>Google Play</span>
                            <span class="landing-Icon apple p-2"><i class="fa-brands fa-apple pe-2"></i>App Store</span>



                        </p>
                        <img class="imgPhone position-relative d-none d-md-block" src="{{ asset('imgs/phone1.png') }}"
                            alt="">
                    </div>

                </div>


                <div class="carousel-caption d-none d-md-block">
                    <h5>FANZONE</h5>
                    <p>We Also provide Mobile App Downlaod It Now.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end of landing -->
@endsection
