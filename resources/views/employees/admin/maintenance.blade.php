@extends('layouts.dashboard')
@section('title')
    <title>Bus Maintenance</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12 mb-5">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Busses
          <i class="fa-solid fa-angle-right"></i>Maintenance Details
        </h3>

        {{-- <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Bus NO. " /> --}}

        <a class="d-block addNewLink p-2" href="{{ route('admin.addMaintenanceForm',$bus) }}"
          ><i class="fa-solid fa-file-circle-plus"></i>
          Add new Maintenance</a>

      </div>
      <div class="row ">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
                <th scope="col">Maintenance Date</th>
                <th scope="col">Maintenance Cost</th>
                <th scope="col">Maintenance description</th>
              </tr>



          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($maintenances as $maintenance)
            <tr>
              <td>{{$maintenance->maintenance_date}}</td>
              <td>{{$maintenance->maintenance_price}}</td>
              <td>{{$maintenance->maintenance_descrption}}</td>
            </tr>
            @endforeach
            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>


@endsection
