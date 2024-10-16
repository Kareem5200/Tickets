@extends('layouts.dashboard')

@section('title')
<title>Deactive stations</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Restoring Stations</h1>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Location or ID " />
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Location</th>
              <th scope="col">Restore?</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            <tr>
            @foreach ($deactiveStations as $station )
              <td>{{ $station->id }}</td>
              <td>{{ $station->location }}</td>
              <td>
                <button

                  class="btn-del bg-success toggle-button">
                  <i
                    class="fa-solid fa-person-walking-arrow-loop-left"></i>
                  Restore
                </button>
              </td>
              <!-- Popup window for deleting a dependent  -->
              <div class="toggle-div popup">
                <p class="fw-bold fs-4">Warrnig!</p>
                <p class="text-dark">
                  Are you sure you want to Restore this Station?
                </p>
                <div class="w-100">
                  <button
                    onclick="cancelPopUp()"
                    class="btn btn-primary">
                    Cancel
                  </button>
                  <!--Dellllllllete form-->
                  <form action="{{ route('admin.returnDeactiveStation',$station->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button

                      class="btn btn-danger">
                      restore
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




