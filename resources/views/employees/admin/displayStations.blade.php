@extends('layouts.dashboard')
@section('title')
<title>Bus stations</title>
@endsection


@section('content')


<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Stations</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Location or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addStationForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-warehouse"></i>

          Add new station</a
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
              <th scope="col">Location</th>

              <th scope="col">Remove?</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($stations as $station )
            <tr>
              <td>{{ $station->id }}</td>
              <td>{{ $station->location }}</td>

              <td>
                <div>
                   <button class="btn-del toggle-button" type="submit">
                       <i class="fa-solid fa-user-xmark"></i> Disallowed
                   </button>
               </div>
           </td>

              <!-- Popup window for deleting a dependent  -->
              <div class="toggle-div popup">
                <p class="fw-bold fs-4">Warrnig!</p>
                <p class="text-dark">
                  Are you sure you want to delete this Station?
                </p>
                <div class="w-100">
                  <button
                    onclick="cancelPopUp()"
                    class="btn btn-primary">
                    Cancel
                  </button>
                  <!--Dellllllllete form-->
                  <form action="{{route('admin.deleteStation',$station->id)  }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button

                      class="btn btn-danger">
                      Disallow
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
