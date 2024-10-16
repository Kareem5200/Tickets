@extends('layouts.dashboard')
@section('title')
    <title>Passports number regexes</title>
@endsection
@section('content')
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Regexes</h1>
        <h3><i class="fa-solid fa-angle-right"></i>Passports number regexes</h3>

        {{-- <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by ID" /> --}}
        <a class="d-block addNewLink p-2" href="{{ route('admin.addRegexForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-coins"></i>

          Add Regex</a
        >
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>

              <th scope="col">Country</th>
              <th scope="col">Regex</th>

            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->


            @foreach ($regexes as $regex )
            <tr>
                <td>{{ $regex->country }}</td>
                <td>{{ $regex->regex }}</td>
            </tr>
            @endforeach
            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
        </div>





@endsection
