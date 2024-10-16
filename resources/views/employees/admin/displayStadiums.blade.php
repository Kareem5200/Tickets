@extends('layouts.dashboard')

@section('title')
<title>Stadiums</title>
@endsection


@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Stadiums</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Name or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addStadiumForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-landmark-flag"></i>

          Add new stadium</a
        >
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Name</th>
              <th scope="col">Capacity</th>
              <th scope="col">Location</th>
              <th scope="col">Update?</th>
              <th scope="col">View its Departments</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($stadiums as $stadium )
            <tr>
              <td>{{ $stadium->id  }}</td>
              <td>{{ $stadium->name  }}</td>
              <td>{{ $stadium->capacity }}</td>
              <td>{{ $stadium->location  }}</td>

              <td>
                <form action="{{ route('admin.updateStadium',$stadium->id) }}">


                  <button class="btn-del bg-success" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i> Update
                  </button>
                </form>
              </td>

              <td>
                <form action="{{ route('admin.displayDeprtments',$stadium->id) }}" >
                  <button class="gotoBtn">
                    <i class="fa-solid fa-arrow-right"></i> GO NOW
                  </button>
                </form>
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
