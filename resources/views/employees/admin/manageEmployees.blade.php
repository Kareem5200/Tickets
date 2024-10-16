@extends('layouts.dashboard')

@section("title")
<title>Manage Employees</title>
@endsection

@section("content")

    <div class="dashboard_content">
      <div class="container">
        <div class="col-md-12 col-lg-12">
          <h1>Manage Employees</h1>

          <input
            class="searchField"
            type="text"
            id="searchInput"
            placeholder=" Search by name or ID " />
        </div>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
          <table id="dataTable" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">SSN</th>
                <th scope="col">Type</th>
                <th scope="col">Pan</th>
              </tr>
            </thead>
            <tbody>
              <!--this is emp row-->
              @foreach ($allEmployees as $employee)

                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->ssn }}</td>
                    <td>{{ $employee->type }}</td>
                    <td>
                         <div>
                            <button class="btn-del toggle-button" type="submit">
                                <i class="fa-solid fa-user-xmark"></i> Pan
                            </button>
                        </div>
                    </td>

                        <!-- Popup window for deleting a dependent  -->
                    <div  class="toggle-div popup">
                        <p class="fw-bold fs-4">Warrnig!</p>
                        <p class="text-dark">Are you sure you want to pan this Employee?</p>
                        <div class="w-100">
                        <button onclick="cancelPopUp()" class="btn btn-primary">Cancel</button>
                        <!--Dellllllllete form-->
                        <form action="{{ route('admin.panEmployee',$employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button  class="btn btn-danger" type="submit">
                            Sure
                            </button>
                        </form>
                        <!--Dellllllllete form-->
                        </div>
                    </div>
                    <div id="overlay" class="overlay"></div>

                    </td>
                </tr>
                @endforeach

              <!--this is emp row-->
            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>
@endsection


@section('js')
<script src="{{ asset('js/popup.js') }}"></script>
@endsection




