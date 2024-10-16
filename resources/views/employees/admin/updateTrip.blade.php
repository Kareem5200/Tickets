@extends('layouts.dashboard')

@section("title")
<title>Update trip</title>
@endsection

@section("content")

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Trips
          <i class="fa-solid fa-angle-right"></i>Update Trip
        </h3>
      </div>

      <div class="row">
        <div

          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.editTrip',["driver"=>$trip->driver_id,"match"=>$trip->match_id,'time'=>$time]) }}" method="POST" >
            @csrf
            @method('PUT')
            <div>
                @if(session('Error'))
                    <div class="alert alert-danger">{{ session('Error') }}</div>
                @endif

            </div>
            <label for=""> Change Driver:</label>
            <select name="driver_id" id="" required>
                @foreach ($drivers as $driver )
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
              </select>

            {{-- <label for="">Change Stadium:</label>
            <select name="stadium_id" id="" required>
                @foreach ($matches as $match )
                <option value="{{ $match->id }}">{{ $match->stadium->name }} - {{ $match->match_date }} - {{ $match->match_time }} </option>
              @endforeach
            </select> --}}

            {{-- <label for="">Change Station: </label>
            <select name="station_id" id="" required>
                @foreach ($stations as $station )
              <option value="{{ $station->id }}">{{ $station->location }}</option>
              @endforeach
            </select> --}}

            <label for="">Change Bus: </label>
            <select name="bus_id" id="" required>
                @foreach ($buses as $bus )
              <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
              @endforeach
            </select>

            {{-- <label for="">Choose Departure date: </label>
            <input type="date"value={{ $trip_date }} name="trip_date" id="" required/> --}}

            <label for="">Choose Departure Time: </label>
            <input type="time" value={{ $trip->travel_time }} name="travel_time" id="" required/>

            <input type="submit" value="Add The Trip" />
          </form>

        </div>
      </div>
    </div>
        </div>
@endsection
