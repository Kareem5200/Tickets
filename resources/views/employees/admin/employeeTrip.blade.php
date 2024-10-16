@extends('layouts.dashboard')

@section('title')
<title> Employee trips </title>
@endsection

@section("content")


<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Trips
          <i class="fa-solid fa-angle-right"></i> Employee Trips
        </h3>

        <div class="mt-5">
          <form class="d-flex align-items-center" action="{{ route('admin.getEmployeeTrips') }}">

            <div class="me-3">
              <label class="label" for="">search by year:</label>
              <input
                class="searchField search3"
                type="number"
                min="1900"
                max="2099"
                step="1"
                name="year" />
                @error('year')
                <div class="dateErrorMessage alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>



            <div class="me-3">
              <label class="label" for="">search by month:</label>
              <input
                class="searchField search3"
                type="number"
                name="month"
                id="" />
                @error('month')
                <div class="dateErrorMessage alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="me-3">
              <label class="label" for="">search by Driver:</label>
              <select name="driver_id" id="" class="searchField search3">
                <option value="">Choose driver</option>
                @foreach ($drivers as $driver )
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
              </select>
              @error('driver_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <button class="btn btn-rounded-pill searchbtn" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Driver</th>
              <th scope="col">Station</th>
              <th scope="col">Stadium</th>
              <th scope="col">Departure date</th>
              <th scope="col">Departure Time</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @if($trips == null)
            @else
                @if (session('invalidDate'))
                <tr><div class=" alert alert-danger">{{ session('invalidDate') }}</div></tr>
                @else
                   @foreach ($trips as $trip)
                    <tr>
                    <td>{{ $trip->driver->name }}</td>
                    <td>{{ $trip->station->location }}</td>
                    <td>{{ $trip->match->stadium->name }}</td>
                    <td>{{ $trip->trip_date }}</td>
                    <td>{{ $trip->travel_time }}</td>

                    @foreach ($prices_array as $price)

                    @if ($price== null)
                    <td>Null</td>
                    @break
                    @else
                        @if ($trip->station->id ==$price->station_id && $trip->match->stadium->id ==$price->stadium_id)
                        <td>{{$price->trip_price}}</td>
                        @break
                        @endif

                    @endif
                    @endforeach
                    </tr>
                  @endforeach
                @endif

            @endif


            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>


@endsection
