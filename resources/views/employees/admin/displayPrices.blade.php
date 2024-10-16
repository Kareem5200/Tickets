@extends('layouts.dashboard')
@section('title')
    <title>Trips price</title>
@endsection
@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Prices</h1>
        <h3><i class="fa-solid fa-angle-right"></i>Trip price</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Station or Stadium " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addPricesForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-coins"></i>

          Add new prices</a
        >
      </div>
      @if(session('Error'))

      <div class='alert alert-danger'>{{ session('Error') }}</div>
      @endif
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Station</th>
              <th scope="col">Stadium</th>
              <th scope="col">Trip price for driver</th>
              <th scope="col">Bus Seat Price</th>
              <th scope="col">Update?</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($prices as $price )
            <tr>
                @if ($price->station->status == 'active')
                    <td>{{ $price->station->location}}</td>

                @else
                    <td>{{ $price->station->location}} (NOT Allowed)</td>

                @endif
              <td>{{ $price->stadium->name }}</td>
              <td>{{ $price->trip_price }}</td>
              <td>{{ $price->seat_price }}</td>
              <td>

                @if ($price->station->status == 'active')

                <form action="{{ route('admin.updatePricesForm',['stadium'=>$price->stadium->id,'station'=>$price->station->id]) }}">
                    <button class="btn-del bg-success">
                      <i class="fa-solid fa-pen-to-square"></i> Update
                    </button>
                  </form>
                 @else
                  Not allowed station
                @endif
              </td>
            </tr>
            @endforeach

            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>





@endsection
