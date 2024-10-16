@extends('layouts.dashboard')
@section('title')
    <title>Add prices for trip</title>
@endsection
@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Prices</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Trip price
          <i class="fa-solid fa-angle-right"></i>Add New price
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">

          <form class="mt-3" action="{{ route('admin.addPrices')  }}" method="POST">
            @csrf
            @if (session('duplicated_key'))
            <div class='alert alert-danger text-center'>{{ session('duplicated_key') }}</div>
            @endif
            <label for="">Choose Stadium:</label>
            <select name="stadium_id" id="" required>
                <option value="">Select Stadium</option>
                @foreach ($stadiums as $stadium )
                <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                @endforeach
            </select>
            @error('stadium_id')
            <div class='alert alert-danger'>{{ $message }}</div>
            @enderror

            <label for="">Choose Station: </label>
            <select name="station_id" id="" required>
                <option value="">Select Station</option>
                @foreach ($stations as $station )
                <option value="{{ $station->id }}">{{ $station->location }}</option>
                @endforeach
            </select>
            @error('station_id')
            <div class='alert alert-danger'>{{ $message }}</div>
            @enderror

            <label for="">Trip price:</label>
            <input type="number" name="trip_price" value="{{ old('trip_price') }}" required/>
            @error('trip_price')
            <div class='alert alert-danger'>{{ $message }}</div>
            @enderror

            <label for="">Seat price:</label>
            <input type="number" name="seat_price" value="{{ old('seat_price') }}" required/>
            @error('seat_price')
            <div class='alert alert-danger'>{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Price"/>
          </form>
        </div>
      </div>
    </div>
        </div>


@endsection

