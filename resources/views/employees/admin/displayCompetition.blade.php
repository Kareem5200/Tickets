@extends('layouts.dashboard')
@section('title')
    <title>Comptitions</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Competetions</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Name or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addComptitionForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-trophy"></i>

          Add new competition</a
        >
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Competition Name</th>
              <th scope="col">Competition Country</th>
              <th scope="col">Season</th>
              {{-- <th scope="col">Price</th> --}}

            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($comps as $comp )
            <tr>
                <td>{{ $comp->id }}</td>
                <td>{{ $comp->name}}</td>
                <td>{{ $comp->country}}</td>
                <td>{{ $comp->session}}</td>
                {{-- <td>{{ $comp->price }}</td> --}}
              </tr>

            @endforeach

            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>

@endsection
