@extends('layouts.dashboard')

@section("title")
<title>Update department</title>
@endsection

@section("content")

<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Games</h1>
        <h3>
          <i class="fa-solid fa-angle-right"></i>Stadiums
          <i class="fa-solid fa-angle-right"></i>Departments
          <i class="fa-solid fa-angle-right"></i>Update Department
        </h3>
      </div>

      <div class="row">

        <div class="addDependentData d-flex justify-content-center mt-3 mb-5">
          <form class="mt-3" action="{{ route('admin.editDeprtments',$department->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('capacityError'))
            <div class="alert alert-danger">{{ session('capacityError')}}</div>
            @endif
            <label for=""> Department Name:</label>
            <input type="text" name="name" value="{{ $department->name }}"  />
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Department Price:</label>
            <input type="number" name="price" value="{{ $department->price }}"  />
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="">Department Capacity </label>
            <input type="number" name="capacity" value="{{ $department->capacity }}"  />
            @error('capacity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <input type="submit" value="Update The Department" />
          </form>
        </div>
      </div>
    </div>
        </div>

@endsection
