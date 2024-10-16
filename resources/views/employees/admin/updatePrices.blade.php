@extends('layouts.dashboard')

@section('title')
    <title>Update trip prices</title>
@endsection

@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Prices</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Trip price
          <i class="fa-solid fa-angle-right"></i>Update price
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.editPrices',['stadium_id'=>$prices->stadium_id,'station_id'=>$prices->station_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="">Trip price: </label>
            <input type="number" name="trip_price" value="{{ $prices->trip_price }}"  required/>
                @error("trip_price")
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            <label for="">Seat price: </label>
            <input type="number" name="seat_price" value="{{ $prices->seat_price }}" required/>
                @error("seat_price")
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            <input type="submit" value="Update The Price" />
          </form>
        </div>
      </div>
    </div>
        </div>

@endsection
