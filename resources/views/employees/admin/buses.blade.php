@extends('layouts.dashboard')
@section('title')
    <title>Buses</title>
@endsection

@section('content')


<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Busses</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by name or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addBusForm') }}"
          ><i class="fa-solid fa-plus"></i>
          <i class="fa-solid fa-bus-simple"></i>
          Add new bus</a
        >
      </div>
      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Bus No.</th>
              <th scope="col">No of Bus seats</th>

              <th scope="col">Remove?</th>
              <th scope="col">See Maintenance Details</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($allBuses as  $bus)


            <tr>
              <td>{{ $bus->id }}</td>
              <td>{{ $bus->bus_number }}</td>
              <td>{{ $bus->seats }}</td>

              <td>
                    <button class="btn-del toggle-button" type="submit">
                        <i class="fa-solid fa-user-xmark"></i> Pan
                    </button>

              </td>
              <td>
                <form action="{{ route('admin.displayBusMaintenance',$bus->id) }}">
                  <button class="gotoBtn" type="submit">
                    <i class="fa-solid fa-arrow-right"></i> GO NOW
                  </button>
                </form>
              </td>

              <!-- Popup window for deleting a dependent  -->
              <div class="toggle-div popup">
                <p class="fw-bold fs-4">Warrnig!</p>
                <p class="text-dark">
                  Are you sure you want to delete this bus?
                </p>
                <div class="w-100">
                  <button
                    onclick="cancelPopUp()"
                    class="btn btn-primary">
                    Cancel
                  </button>
                  <!--Dellllllllete form-->
                  <form action="{{ route('admin.deleteBus',$bus->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button

                      class="btn btn-danger" type="submit">
                      Delete
                    </button>
                  </form>
                  <!--Dellllllllete form-->
                </div>
              </div>
              <div id="overlay" class="overlay"></div>
            </tr>
            @endforeach
            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
</div>



@endsection


@section('js')
<script src="{{ asset('js/popup.js') }}"></script>

@endsection
