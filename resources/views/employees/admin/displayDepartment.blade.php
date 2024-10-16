@extends('layouts.dashboard')
@section('title')
    <title>Departments</title>
@endsection

@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Stadiums
          <i class="fa-solid fa-angle-right"></i> Departments
        </h3>


        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Name or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addDeprtmentsForm',$stadium) }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-chair"></i>
          Add new department</a
        >
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Dep Type</th>
              <th scope="col">Dep Capacity</th>
              <th scope="col">Dep price</th>
              <th scope="col">Update?</th>
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($departments as $department )
            <tr>
              <td>{{ $department->id}}</td>
              <td>{{ $department->name  }}</td>
              <td>{{ $department->capacity }}</td>
              <td>{{ $department->price  }}</td>

              <td>
                <form action="{{ route('admin.updateDeprtmentsForm',$department->id) }}" >
                  <button class="btn-del bg-success" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i> Update
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
