@extends('layouts.dashboard')
@section('title')
    <title>Add Comptition</title>
@endsection

@section('content')


<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Competetions
          <i class="fa-solid fa-angle-right"></i>Add New Competetion
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addComptition') }}" method="POST">
            @csrf
            @if(session('Error'))

            <div class="alert alert-danger">{{ session('Error') }}</div>

            @endif
            <label for=""> Competetion Name:</label>
            <input type="text" name="comp_name" value="{{ old('comp_name') }}" required />
            @error('comp_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for=""> Competetion Country:</label>
            <input type="text" name="comp_country" value="{{ old('comp_country') }}" required />
            @error('comp_country')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Competetion season:</label>
            <input type="text" name="comp_session" value="{{ old('comp_session') }}"  required />
            @error('comp_session')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- <label for="">Competetion Price:</label>
            <input type="number" name="comp_price" value="{{ old('comp_price') }}"  required />
            @error('comp_price')
            <div class="alert alert-danger">{{ $message }}</div>
             @enderror --}}

            <input type="submit" value="Add The Competetion" />
          </form>
        </div>
      </div>
    </div>
        </div>
@endsection
