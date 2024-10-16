@extends('layouts.dashboard')

@section('title')
    <title>Update team</title>
@endsection



@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Teams
          <i class="fa-solid fa-angle-right"></i>Update Team
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.editTeam',$team->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            @if(session('fillError'))
            <div class="alert alert-danger">{{session('fillError')  }}</div>
            @endif

            <label for=""> Team Name:</label>
            <input type="text" name="name" value="{{ $team->name }}" />

            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for=""> Team Division:</label>
            <select name="division" id="">
                <option value="">Select Division</option>
                <option value="first">First</option>
                <option value="second">Second</option>
                <option value="third">Third</option>
                <option value="fourth">Fourth</option>
                <option value="national">National</option>
            </select>

              @error('division')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

            <label for="">Team Logo:</label>
            <input type="file"  name="logo" accept="image/*">

            @error('logo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Update The Team" />
          </form>

        </div>
      </div>
    </div>
        </div>




@endsection
