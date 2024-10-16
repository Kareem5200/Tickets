@extends('layouts.dashboard')

@section('title')
    <title>Add teams</title>
@endsection



@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Teams
          <i class="fa-solid fa-angle-right"></i>Add New Team
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addTeam') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(session('Error'))

            <div class="alert alert-danger">{{ session('Error') }}</div>

            @endif
            <label for=""> Team Name:</label>
            <input type="text" name="team_name" value="{{ old('team_name') }}" required/>

            @error('team_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for=""> Team Division:</label>
            <select name="division" id="" required>
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
            <input type="file"  name="logo" required accept="image/*">

            @error('logo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Team" />
          </form>

        </div>
      </div>
    </div>
        </div>




@endsection
