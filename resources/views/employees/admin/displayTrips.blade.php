@extends('layouts.dashboard')

@section('title')
<title> Our trips </title>
@endsection

@section("content")
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Trips</h3>

        {{-- <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by trip ID " /> --}}

        <div class="d-flex">
          <a class="d-block addNewLink p-2" href="{{ route('admin.addTripForm') }}">
            <i class="fa-solid fa-plus"></i
            ><i class="fa-solid fa-suitcase-rolling"></i> Add new trip</a
          >

          <a class="d-block addNewLink bg-primary p-2" href="{{ route('admin.displayEmployeeTrips') }}">
            <i class="fa-solid fa-user-tie"></i> Get employee trip</a
          >
        </div>

            @if(session('Error'))
            <div class="alert alert-danger">{{ session('Error') }}</div>
             @endif

      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Driver</th>
              <th scope="col">Bus</th>
              <th scope="col">Station</th>
              <th scope="col">Stadium</th>
              <th scope="col">Departure date</th>
              <th scope="col">Departure Time</th>
              <th scope="col">Update?</th>
              {{-- <th scope="col">Delete?</th> --}}
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($tripsOfThisMonth as $trip )


            <tr>
                @if ($trip->driver->status=='active')
                <td>{{$trip->driver->name}}</td>
                @else
                <td>{{$trip->driver->name }} (PANNED)</td>
                @endif


                @if ($trip->bus->status == 'active' )
                <td>{{ $trip->bus->bus_number }}</td>
                @else
                <td>{{ $trip->bus->bus_number }} (out of service)</td>
                @endif


                @if ($trip->station->status == 'active' )
                <td>{{$trip->station->location }}</td>
                @else
                <td>{{$trip->station->location }} (NOT Allowed)</td>
                @endif
                <td>{{$trip->match->stadium->name}}</td>
                <td>{{ $trip->trip_date }}</td>
                <td>{{ $trip->travel_time }}</td>

              <td>
                @if($trip->trip_date>=now())
                <form action="{{ route('admin.updateTripForm',["driver"=>$trip->driver,'match'=>$trip->match,'time'=>$trip->travel_time,'station_id'=>$trip->station->id]) }}">
                    <button class="btn-del bg-success">
                      <i class="fa-solid fa-pen-to-square"></i> Update
                    </button>
                  </form>
                @endif
              </td>
              {{-- <td>
                <button onclick="showConfirmation()" class="btn-del">
                  <i class="fa-regular fa-trash-can"></i> Delete
                </button>
              </td> --}}

              {{-- <!-- Popup window for deleting a dependent  -->
              <div id="popup-del-dependent" class="popup">
                <p class="fw-bold fs-4">Warrnig!</p>
                <p class="text-dark">
                  Are you sure you want to delete this Team?
                </p>
                <div class="w-100">
                  <button
                    onclick="cancelDelDep()"
                    class="btn btn-primary">
                    Cancel
                  </button>
                  <!--Dellllllllete form-->
                  <form action="{{ route('admin.deleteTrip',["driver"=>$trip->driver,"trip_date"=>$trip->trip_date,"travel_time"=>$trip->travel_time]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button
                      onclick="deleteDependent()"
                      class="btn btn-danger">
                      Delete
                    </button>
                  </form>
                  <!--Dellllllllete form-->
                </div>
              </div>
              <div id="overlay" class="overlay"></div> --}}
            </tr>
            @endforeach
            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>













@endsection
