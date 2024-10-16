@extends('layouts.app')
@section('title')
<title> Contact us</title>
@endsection




@section('content')


<!-- start of contact section -->
<div class="conatct_section">
    <div class="container">

        <div class="text-center">
            <h1 class="mb-3">contact us</h1>
            <div class="p-1 rounded-2 locationBox mb-5 d-flex align-items-center shadow">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1727.7643736845368!2d31.31617776132203!3d29.99297049373743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583921c000aaad%3A0x89f4cbf0b7d34872!2z2KfZhNin2YPYp9iv2YrZhdmK2Kkg2KfZhNit2K_Zitir2Kkg2YTZhNmH2YbYr9iz2Kkg2YjYp9mE2KrZg9mG2YjZhNmI2KzZitin!5e0!3m2!1sar!2seg!4v1718907238939!5m2!1sar!2seg"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>

        </div>
        @if(session('Done'))
        <div class="alert alert-success alert_contact" id="liveAlertPlaceholder">
            <i class="fa-regular fa-circle-check"></i>
            {{ session('Done')}}
        </div>
        @endif

        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="contact_from ">
                    <form action="{{ route('sendMail') }}" method="GET">
                        <input class="d-block form-control " type="text" placeholder=" YOUR NAME" name="name" id="">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="d-block form-control " type="email" placeholder="YOUR MAIL" name="mail" id="">
                        @error('mail')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea class="d-block form-control " name="message" id=""
                            placeholder="YOUR MESSAGE"></textarea>
                        @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="btn btn-primary sendBtn mb-3 rounded-pill" type="submit" value="SEND">
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 pb-5">
                <h2>Get in touch</h2>
                <p class="text-black-50 mb-3"> Get in touch with us via mail, phone. we are wating for your call or
                    message</p>

                <div class="d-flex justify-content-between flex-wrap g-5 contact-infoo ">
                    <div class="w-50">
                        <div class="item d-flex align-items-center ">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            <span>Maddi, Cairo, EG</span>
                        </div>
                    </div>
                    <div class="w-50">
                        <div class="item d-flex align-items-center ">
                            <i class="fa-solid fa-envelope me-2" style="color: #5980a1;"></i>
                            <span class="text-break">Fanzone@gmail.com</span>
                        </div>
                    </div>
                    <div class="w-50">
                        <div class="item d-flex align-items-center ">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            <span>Shoubra Misr, Cairo</span>
                        </div>
                    </div>
                    <div class="w-50">
                        <div class="item d-flex align-items-center ">
                            <i class="fa-solid fa-phone me-2" style="color: #3a8742;"></i>
                            <span class="text-break">+201228987781</span>
                        </div>
                    </div>


                </div>


            </div>

        </div>

    </div>
</div>


<!-- end of contact section -->





@endsection
