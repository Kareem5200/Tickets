@extends('layouts.dashboard')
@section('title')
    <title>Add Stadium</title>
@endsection
@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Stadiums
          <i class="fa-solid fa-angle-right"></i>Add New stadium
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addStadium') }}" method="POST">
            @csrf
            @if(session('Error'))

            <div class="alert alert-danger">{{ session('Error') }}</div>

            @endif
            <label for=""> Stadium Name:</label>
            <input type="text" name="name"  value="{{ old('name') }}" required />
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Stadium location:</label>
            <input type="text" name="location" value="{{ old('location') }}" required />
            @error('location')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Stadium Capacity </label>
            <input type="number" name="capacity" value="{{ old('capacity') }}" required />
            @error('capacity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Stadium" />
          </form>
        </div>
      </div>
    </div>
        </div>


@endsection

