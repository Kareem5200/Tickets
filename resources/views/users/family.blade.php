@extends('layouts.app')
@section('title')
<title> Manage family</title>
@endsection

@section('content')

<div style="background-color: #EEEEEE;" class="py-5">
    <!-- start of dependants section -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between ">
            <h2>Dependents</h2>
            <div>
                <a class="btn btn-success" href="{{ route('user.addDependent') }}"><i
                        class="fa-solid fa-person-circle-plus" style="color: #ffffff;"></i> Add New Dependent</a>
            </div>
        </div>


        <div class="dependentTable  mt-3">
            <div class="row ">
                @foreach ($dependentsUnder16 as $dependent )
                <div class="col-md-6 col-lg-4">
                    <div class="dependent-card p-2 d-grid">
                        <div class="row">
                            <div class="depPic col-md-12 col-lg-5">
                                <div>
                                    @if(filter_var($dependent->personal_image, FILTER_VALIDATE_URL))
                                    <img class="dependent-photo " src="{{$dependent->personal_image}}"
                                        alt="Profile Photo">
                                    @else
                                    <img class="dependent-photo"
                                        src="{{ asset('imgs/dependents_pictures/'.$dependent->personal_image) }}"
                                        alt="Profile Photo">
                                    @endif
                                </div>
                            </div>


                            <div class="dependent-info ps-1  col-lg-7">
                                <div class="dependent-name"><b class="text-capitalize">{{ $dependent->name }}</b></div>
                                <div class="dependent-id">Dependent ID : <b class="text-capitalize">
                                        {{ $dependent->id }}</b></div>
                                <div class="dependent-gender"> Dependent Gender : <b
                                        class="text-capitalize">{{ $dependent->gender }}</b> </div>
                                {{-- <div class="dependent-relation">Relation: Son</div> --}}
                            </div>
                            <!-- <div class="count col-md-12 col-lg-6 text-center align-self-center mb-2">Dependant #</div> -->
                        </div>
                    </div>


                </div>
                @endforeach

            </div>


        </div>
    </div>
</div>

@endsection
