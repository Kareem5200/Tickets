@extends('layouts.dashboard')

@section('title')
<title>Add new station</title>

@endsection

@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Stations
          <i class="fa-solid fa-angle-right"></i>Add New Station
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" method="POST" action="{{ route('admin.addStation') }}">
            @csrf
            @if(session('Error'))

            <div class="alert alert-danger">{{ session('Error') }}</div>

            @endif
            <label for="ssn">Station Location:</label>
            <input type="text" name="station_location" value="{{ old('station_location') }}" required />
            @error('station_location')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Station" />
          </form>
        </div>
      </div>
    </div>
        </div>

@endsection
