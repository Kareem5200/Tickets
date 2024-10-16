@extends('layouts.dashboard')
@section('title')
    <title>Add Bus</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Busses
          <i class="fa-solid fa-angle-right"></i>Add New Bus
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addBus') }}" method="POST">
            @csrf
            @if(session('Error'))

            <div class="alert alert-danger">{{ session('Error') }}</div>

            @endif
            <label for="">Bus number</label>
            <input type="text" name="bus_number" value="{{ old('bus_number') }}" required />
            @error('bus_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">seats</label>
            <input type="number" name="seats" value="{{ old('seats') }}"  required />
            @error('seats')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="submit" value="Add The Bus" />
          </form>
        </div>
      </div>
    </div>
        </div>

@endsection
