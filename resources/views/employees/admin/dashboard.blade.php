@extends('layouts.dashboard')
@section('title')

<title>Admin dashboard</title>
@endsection

@section('content')
<div class="contandnav">

    <div class="dashboard_content">
        <div class="container">
            <h1 class="col-md-12 col-lg-12">Dashboard</h1>
            <div class="row">
                <div class="dataone col-md-6 col-lg-4">
                    <span>Total Fans:</span>
                    <br>
                    <span>{{ $users }}</span>
                    <i class="fa-solid fa-people-group"></i>

                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Total Employess:</span>
                    <br>
                    <span>{{ $employees }}</span>
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Matches tickets sold:</span>
                    <br>
                    <span>{{ $match_tickets }}</span>
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Bus tickets sold:</span>
                    <br>
                    <span>{{ $bus_tickets }}</span>
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Buses On Service:</span>
                    <br>
                    <span>{{ $buses }}</span>
                    <i class="fa-solid fa-bus"></i>
                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Month income</span>
                    <br>
                    <span>{{ $income }}<span> EGP</span></span>
                    <i class="fa-solid fa-sack-dollar"></i>

                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Month outcome</span>
                    <br>
                    <span>{{ $outcome }} <span> EGP</span></span>
                    <i class="fa-solid fa-sack-dollar"></i>

                </div>
                <div class="dataone col-md-6 col-lg-4">
                    <span>Total profit</span>
                    <br>
                    <span>{{ $income - $outcome }} <span> EGP</span></span>
                    <i class="fa-solid fa-sack-dollar"></i>

                </div>




            </div>

        </div>





    </div>
</div>



</div>

@endsection



