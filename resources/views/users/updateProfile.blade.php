@extends('layouts.app')
@section('title')
<title>Update profile</title>
@endsection

@section('content')

<!--content-->
<div class="update-acc-data py-5">
    <div class="container">
      <h2 class="text-center">
        <i class="fa-solid fa-pen-to-square"></i> <br />Update Account Info
      </h2>
      <div class="update-acc-section d-flex justify-content-center py-3">
        <form action="{{ route('user.edit') }}" method="POST">
            @csrf
            @method('PUT')

{{--
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" value="{{ $user->email }}" id="email" name="email"  />
          </div>

          @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror --}}

          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" value="{{$user->phone_1  }}" id="phone_1" name="phone_1"  />
          </div>
          @error('phone_1')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <input type="submit" value="Update" />
        </form>
      </div>
    </div>
  </div>
  <!--content-->

@endsection

