@extends('layouts.dashboard')
@section('title')
    <title>Add Maintenance</title>
@endsection
@section('content')


<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Transportation</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i> Busses
          <i class="fa-solid fa-angle-right"></i>Add New Maintenance
        </h3>
      </div>

      <div class="row">
        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addMaintenance',$bus) }}" method="POST">
            @csrf
            @if(session('errorDate'))
            <div class="alert alert-danger">{{session('errorDate')}}</div>
            @endif

            <label for="">Maintenance Date</label>
            <input type="date" name="maintenance_date" required />
            @error('maintenance_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror



            <label for="">Maintenance Cost:</label>
            <input type="number" name="maintenance_price" value="{{ old('maintenance_price') }}" required />
            @error('maintenance_price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Maintenance Description:</label>
            <textarea
              class="maintenanceDescribe"
              name="maintenance_description"
              id=""
              cols="30"
              rows="10"></textarea>
              @error('maintenance_description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Bus" />
          </form>
        </div>
      </div>
    </div>
        </div>


@endsection
