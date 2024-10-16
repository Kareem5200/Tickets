@extends('layouts.app')
@section('title')
<title> Profile</title>
@endsection

@section('content')
<!-- start of profile section -->
<div class="profile container  mt-5 mb-5 w-100">
  <div class="row g-3">
    <div class="col-lg-3 col-md-4">
        <aside class="profileInfo d-flex justify-content-center ">
        <div class="pCard d-flex justify-content-evenly mb-3">
            <img class="profileLogo" src="{{ asset('imgs/logo.jpeg') }}" alt="">
            <div class="profilePicDiv auto-resize-portrait">
                    @if(filter_var($user->personal_image, FILTER_VALIDATE_URL))
                    <img class="profilePic" src="{{$user->personal_image}}" alt="">
                    @else
                    <img class="profilePic" src="{{ asset('imgs/profile_pictures/'.$user->personal_image) }}" alt="">
                    @endif


            </div>
            <h6 class="text-center">Fan ID:</h6>
            <span class="fanId mb-1 fw-bold">{{ $user->id }}</span>
        </div>
        {{-- <div class="profileLinks">
            <a href="#"><i class="fa-solid fa-ticket" style="color: #5980a1;"></i> Match Tickets</a>
            <a href="#"><i class="fa-solid fa-ticket" style="color: #5980a1;"></i> Bus Tickets</a>

            <form action="{{ route('user.displayDependents',Auth::id()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Manage Family</button>

            </form>

            <a href="#"><i class="fa-solid fa-gear" style="color: #5980a1;"></i> Settings</a>
        </div> --}}

        <div class="profileLinks mt-3">


            <ul>
                <li class="mb-1">
                    <form action="{{ route('user.getMatchTickets') }}">
                    <button type="submit"><i class="fa-solid fa-ticket"></i> Match Tickets</button>
                     </form>
                </li>

                <li  class="mb-1">
                    <form action="{{ route('user.getBusTickets') }}">

                    <button type="submit"><i class="fa-solid fa-ticket"></i> Bus Tickets</button>
                    </form>
                </li>

                <li  class="mb-1">
                    <form action="{{ route('user.displayDependents',Auth::id()) }}">
                        {{-- @csrf
                        @method('PUT') --}}
                        <button type="submit"><i class="fa-solid fa-people-group"></i> Manage Family</button>

                        </form>

                </li>

                <li  class="mb-1">
                    <form action="{{ route('user.UpdatePassworfForm') }}">
                    <button type="submit"><i class="fa-solid fa-gear"></i> Change Password</button>
                    </form>
                </li>
            </ul>
            </div>


        {{-- <form action="{{ route('logout') }} " method="POST">
            @csrf
            <button class="rounded-pill logout " type=""><i class="fa-solid fa-right-from-bracket"
                    style="color: #ffffff;"></i> Logout</button>
        </form> --}}


    </aside>
    </div>
    <div class="col-lg-9 col-md-8">
         <section class="profileData h-100">
        <h1 class="p-4">Profile Info</h1>



        <div class="accDetailes d-flex p-4">
          <div class="container">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif            <div class="row">
              <div class="col-lg-6 col-sm-12 view-info">
                <label class="fw-medium" for="">Name:</label>
                <p>{{ $user->name }}</p>
                <label class="fw-medium" for="">Email:</label>
                <p>{{ $user->email }}</p>
                <label class="fw-medium" for="">Phone:</label>
                <p>{{ $user->phone_1 }}</p>
                <label class="fw-medium" for="">Country:</label>
                <p>{{ $user->address }}</p>

                <div class="d-flex">
                  <form action="{{ route('user.update')}}">
                    <button class="btn main-btn me-3">Update Data</button>
                  </form>

                </div>
              </div>

              <div
                class="myfavTeam d-flex justify-content-center align-content-center text-center col-lg-6 col-sm-12">
                <div class="py-3 fav-team">
                  <p class="fs-5 fw-medium">Favorite team</p>
                  <div class="w-75 mx-auto">
                    <img class="w-100" src="{{ asset('imgs/teams/'.$user->team->logo) }}" alt="" />
                  </div>
                  <p class="theTeam fw-bold">{{ $user->team->name }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>









</div>
<!-- end of profile section -->



@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
