@extends('layouts.dashboard')

@section("title")
<title>Update stadium</title>
@endsection

@section("content")
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Stadiums
          <i class="fa-solid fa-angle-right"></i>Update stadium
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.editStadium',$stadium->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for=""> stadium Name:</label>
            <input type="text" name="name" value="{{ $stadium->name }}"/>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- <label for="">Stadium Capacity </label>
            <input type="number"  name="capacity" value="{{ $stadium->capacity }}"/>
            @error('capacity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}

            <input type="submit" value="Update The Stadium" />
          </form>
        </div>
      </div>
    </div>
        </div>

@endsection

