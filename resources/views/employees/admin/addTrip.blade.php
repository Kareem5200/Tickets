@extends('layouts.dashboard')

@section('title')
    <title>Add trip</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Trips
          <i class="fa-solid fa-angle-right"></i>Add New Trip
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addTrip') }}" method="POST">
            @csrf
            @if (session('duplicated_key'))
            <div class='alert alert-danger text-center'>{{ session('duplicated_key') }}</div>
            @endif
            <label for=""> Choose Driver:</label>
            <select name="driver_id" id="" required>
                @foreach ($drivers as $driver )
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
              </select>


            <label for="">Choose match:</label>

            <select name="match_id" id="" required>
                {{-- @foreach ($stadiums as $stadium )
                <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                @endforeach --}}
                @foreach ($matches as $match )
                <option value="{{ $match->id }}">{{ $match->stadium->name }} - {{ $match->match_date }} - {{ $match->match_time }} </option>

                @endforeach
             </select>


            <label for="">Choose Station: </label>

            <select name="station_id" id="" required>
                @foreach ($stations as $station )
              <option value="{{ $station->id }}">{{ $station->location }}</option>
              @endforeach
            </select>


            <label for="">Choose Bus: </label>

            <select name="bus_id" id="" required>
                @foreach ($buses as $bus )
              <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
              @endforeach
            </select>



            {{-- <label for="">Choose Departure date: </label>
            <input type="date" name="trip_date" id="" required/> --}}

            <label for="">Choose Departure Time: </label>
            <input type="time" name="travel_time" id="" required/>
            @if (session('travelTimeError'))
            <div class="alert alert-danger">{{ session('travelTimeError') }}</div>
            @endif


            <input type="submit" value="Add The Trip" />
          </form>
        </div>
      </div>
    </div>
        </div>





@endsection
