@extends('layouts.app')

@section('title')
<title> Add dependent</title>
@endsection

@section('content')
<!-- start of ADD  dependants section -->
<div  style="background-color: #EEEEEE;" class="py-1">
<div class="container  addDependentSection mt-5 mb-5 ">

    <h1 class="text-center text-success "><i class="fa-solid fa-person-circle-plus"></i> <br> Add New Dependant </h1>
    <p class="fs-6 text-center">Please make sure that you are adding a new dependent between 3 and 16 years
        old.
    </p>
    {{-- @dd(session()->all()); --}}
    <div class="addDependentData d-flex justify-content-center mt-3 mb-5">

        <form class="mt-3" method="POST" action="{{ route('user.store',['user_id'=>Auth::id()]) }}" enctype="multipart/form-data">
            @csrf
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif


            <label for="dependent_name">Dependent Name:</label>
            <input type="text" id="dependent_name" name="name"  value="{{ old('name') }}" required>

            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="ssn">SSN:</label>
            <input type="number" id="ssn" name="ssn"  value="{{ old('ssn') }}"  required>
            @error('ssn')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session('ageError'))
            <div class="alert alert-danger">
                {{ session('ageError') }}
            </div>
             @endif

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>




            <label for="photo">Upload Dependent Photo:</label>
            <input type="file"  name="personal_image"    required accept="image/*">
            @error('personal_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="birth_certificate">Upload Birth Certificate:</label>
            <input type="file" id="birth_certificate" name="birth_certificate"   required accept="image/*">
            @error('birth_certificate')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add The Dependent">
        </form>
    </div>
</div>
</div>





@endsection
