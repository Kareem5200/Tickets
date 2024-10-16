@extends('layouts.dashboard')
@section('title')
    <title>Add department</title>
@endsection

@section('content')

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Stadiums
          <i class="fa-solid fa-angle-right"></i>Departments
          <i class="fa-solid fa-angle-right"></i>Add new Department
        </h3>
      </div>

      <div class="row">

        <div
          class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.addDeprtment',$stadium) }}" method="POST">
            @csrf
            @if (session('capacityError'))
            <div class="alert alert-danger">{{ session('capacityError')}}</div>
            @endif
            <label for=""> Department Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required />
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Department Price:</label>
            <input type="number" name="price"value="{{ old('price') }}"  required />
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Department Capacity </label>
            <input type="number" name="capacity" value="{{ old('capacity') }}" required />
            @error('capacity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror



            <input type="submit" value="Add The Department" />
          </form>
        </div>
      </div>
    </div>
        </div>
@endsection
