@extends('layouts.dashboard')

@section('title')
<title>Fan profile </title>
@endsection

@section("content")




    <div class="dashboard_content">
      <div class="container">
        <div class="col-md-12 col-lg-12">
          <h1>Fan information</h1>
        </div>
        <div class="row">
          <div class="d-flex align-items-center mb-4">
            <div class="fan-picture me-3">
                @if(filter_var($user->personal_image, FILTER_VALIDATE_URL))
                <img class="profilePic" src="{{$user->personal_image}}" alt="">
                @else
                <img class="profilePic" src="{{ asset('imgs/profile_pictures/'.$user->personal_image) }}" alt="">
                @endif
            </div>
            <div>
              <p class="h3">{{ $user->name }}</p>
              <p class="text-black-50 m-0 fs-5">Fan</p>
            </div>
          </div>
          <table id="dataTable" class="table">
            <thead>
              <tr>
                <th scope="col">#Fan ID</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Nationality</th>
                <th scope="col">Gender</th>
                <th scope="col">ID card "SSN"</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->phone_1 }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->gender }}</td>
                @if($user->address =='Egypt')
                <td>
                    <button
                      onclick="showId()"
                      id="showId"
                      class="btn btn-primary rounded-pill openId">
                      <i class="fa-solid fa-address-card"></i> Open
                    </button>
                  </td>
                @else
                <td>
                    {{ $user->passport_id }}
                </td>

                @endif

                <div
                  id="fixedbox"
                  class="d-none justify-content-center align-items-center vh-100">
                  <div id="parent" class="bg-white p-2 position-relative">
                    @if(filter_var($user->ssn_image, FILTER_VALIDATE_URL))
                    <img class="profilePic rounded-0" src="{{$user->ssn_image}}" alt="">
                    @else
                    <img class="profilePic rounded-0" src="{{ asset('imgs/ssn_images/'.$user->ssn_image) }}" alt="">
                    @endif
                    <button
                      onclick="closeId()"
                      class="btn position-absolute top-0 closeId">
                      <i class="fa-solid fa-square-xmark fs-2"></i>
                    </button>
                  </div>
                </div>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>





<script>
    console.log(fixedbox);
    function showId() {
      document
        .getElementById("fixedbox")
        .classList.replace("d-none", "d-flex");
    }
    function closeId() {
      document
        .getElementById("fixedbox")
        .classList.replace("d-flex", "d-none");
}
</script>
@endsection

