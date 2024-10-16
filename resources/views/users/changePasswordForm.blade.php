@extends('layouts.app')

@section('title')
<title>Change password</title>
@endsection

@section('content')

<!--content-->
<div class="update-acc-data py-5">
    <div class="container">
      <h2 class="text-center">
        <i class="fa-solid fa-key"></i> <br />Update Account Password
      </h2>
      <div class="update-acc-section d-flex justify-content-center py-3">
        <form action="{{ route('user.editPassword') }}" method="POST" id="updateFanPassForm">
            @csrf
            @method('PUT')

            @if(session('oldPasswordWrong'))
                <div class="alert alert-danger">{{session('oldPasswordWrong')  }}</div>
            @endif
          <div class="form-group">
            <label for="old-password">Old Password:</label>
            <input
              type="password"
              id="old-password"
              name="old_password"
              minlength="6"
              maxlength="16"
              required />
          </div>

          @error('old_password')
          <div class="alert alert-danger">{{$message }}</div>
          @enderror

          <div class="form-group">
            <label for="new-password">New Password:</label>
            <input
              type="password"
              id="new-password"
              name="password"
              minlength="6"
              maxlength="16"
              required />
          </div>
          @error('password')
          <div class="alert alert-danger">{{$message }}</div>
          @enderror
          <div class="form-group">
            <label for="confirm-password">Confirm New Password:</label>
            <input
              type="password"
              id="confirm-password"
              name="password_confirmation"
              minlength="6"
              maxlength="16"
              required />
            <span class="error-message" id="password-error"></span>
          </div>
          <input type="submit" value="Update" />
        </form>
      </div>
    </div>
  </div>
  <!--content-->

@endsection
