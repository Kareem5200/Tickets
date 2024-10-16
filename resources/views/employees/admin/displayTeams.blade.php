@extends('layouts.dashboard')

@section('title')
    <title>Teams</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3><i class="fa-solid fa-angle-right"></i> Teams</h3>

        <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by Name or ID " />
        <a class="d-block addNewLink p-2" href="{{ route('admin.addTeamsForm') }}">
          <i class="fa-solid fa-plus"></i
          ><i class="fa-solid fa-shield"></i>

          ADD NEW TEAM</a
        >
      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Team Name</th>
              <th scope="col">Division</th>
              <th scope="col">Team Logo</th>
              <th scope="col">Update</th>

            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($teams as $team )
            <tr>
              <td>{{ $team->id }}</td>
              <td>{{ $team->name }}</td>
              <td>{{ $team->division}}</td>
              <td>
                <img class="teamLogo" src="{{ asset('imgs/teams/'.$team->logo) }}" alt="" />
              </td>
              <td>
                <form action="{{ route('admin.updateTeam',$team->id) }}">
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

