@extends('layouts.app')
@section('title')
<title>Match tickets</title>
@endsection

@section('content')

<!--my match ticket section-->
<div class="container mt-5 mb-5">
    <h2 class="w-90 mx-auto">Matches Tickets</h2>
    @if(session('failed'))
    <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <div class="mtachTickets mx-auto mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <span class="fs-5 fw-bold">My Tickets</span>
                    </button>
                </h2>
                @foreach ($fan_tickets as $ticket )
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <!--ticket-->
                        <div class="ticketContainer mx-auto position-relative text-white">
                            <div class="row">

                                <div
                                    class="ticLeftLogo position-relative col-md-2 col-lg-2 d-none d-sm-none d-md-block ">
                                    <img src="imgs/footer_logo.png" alt="">
                                </div>
                                <div class="ticinfo pb-2 pt-2 col-md-7 col-lg-7">
                                    <p class="compName text-center fs-5 mb-0">
                                        {{ $ticket->match->competition->name }}<br> <span
                                            class="compSeason">{{ $ticket->match->competition->session }}</span></p>
                                    <div class="teamsData position-relative d-flex justify-content-evenly">
                                        @foreach ($ticket->match->teams as $team)
                                        <div class="team1 w-50 text-center">
                                            <img src="{{ asset('imgs/teams/'.$team->logo) }}" alt="team logo">
                                            <p class="team1Name mb-0">{{ $team->name }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="ticketData text-center ">
                                        <div class="stadium pe-2"><i class="fa-solid fa-landmark-flag"></i>
                                            {{ $ticket->match->stadium->name}}</div>
                                        <div class="matchDate pe-2 text-center  d-flex justify-content-evenly ">
                                            <span class="date pe-2"><i class="fa-solid fa-calendar"></i>
                                                {{$ticket->match->match_date}}</span>
                                            <span class="time ps-2"><i class="fa-solid fa-clock"></i>
                                                {{$ticket->match->match_time}}</span>
                                            <span class="department text-center  "><i class="fa-solid fa-chair"></i>
                                                {{ $ticket->department->name }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="rightticket text-center  col-md-3 col-lg-3">
                                    <div class="ownerName">For: <br><span class="">{{ $ticket->user->name }}</span>
                                    </div>
                                    @if(filter_var($ticket->qrcode , FILTER_VALIDATE_URL))
                                    <img class="parcode" style="width: 160px; height: 160px;" src="{{ $ticket->qrcode }}" alt="">
                                    @else

                                    <img class="parcode" style="width: 160px; height: 160px;" src="{{ asset('imgs/qrCodes/'.$ticket->qrcode) }}" alt="">
                                    @endif
                                    <div class="ownerName">Ticket ID: <span>{{ $ticket->id }}</span></div>
                                    <div class="ownerName">Status: <span>{{ $ticket->status }}</span></div>
                                </div>

                            </div>
                            <!-- refund-ticket -->
                            @if ($ticket->status=='Activated')
                            <div class="position-absolute w-25">
                                <button class="refundBtn btn-del toggle-button" type="submit">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Refund
                                </button>
                            </div>
                            <!-- Popup window for deleting a dependent  -->
                            <div class="toggle-div popup">
                                <p class="fw-bold fs-4">Warrnig!</p>
                                <p class="text-dark">Are you sure to refund this ticket you will loss 10% from price of
                                    ticket</p>
                                <div class="w-100">
                                    <button onclick="cancelPopUp()" class="btn btn-primary">Cancel</button>
                                    <!--Dellllllllete form-->
                                    <form action="{{ route('user.refundTicket',$ticket->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger" type="submit">
                                            Sure
                                        </button>
                                    </form>
                                    <!--Dellllllllete form-->
                                </div>
                            </div>
                            <div id="overlay" class="overlay"></div>
                            @endif
                        </div>
                        <!--ticket-->
                    </div>
                </div>
                @endforeach
            </div>





            <!-- edit -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <span class="fs-5 fw-bold">Dependents Tickets</span>
                    </button>
                </h2>
                @foreach ($dependent_tickets as $ticket)

                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <!--ticket-->
                        <div class="ticketContainer mx-auto position-relative text-white">
                            <div class="row">

                                <div
                                    class="ticLeftLogo position-relative col-md-2 col-lg-2 d-none d-sm-none d-md-block ">
                                    <img src="imgs/footer_logo.png" alt="">
                                </div>
                                <div class="ticinfo pb-2 pt-2 col-md-7 col-lg-7">
                                    <p class="compName text-center fs-5 mb-0">
                                        {{ $ticket->match->competition->name }}<br> <span
                                            class="compSeason">{{ $ticket->match->competition->session }}</span></p>
                                    <div class="teamsData position-relative d-flex justify-content-evenly">
                                        @foreach ($ticket->match->teams as $team)
                                        <div class="team1 w-50 text-center">
                                            <img src="{{ asset('imgs/teams/'.$team->logo) }}" alt="team logo">
                                            <p class="team1Name mb-0">{{ $team->name }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="ticketData text-center ">
                                        <div class="stadium pe-2"><i class="fa-solid fa-landmark-flag"></i>
                                            {{ $ticket->match->stadium->name}}</div>
                                        <div class="matchDate pe-2 text-center  d-flex justify-content-evenly ">
                                            <span class="date pe-2"><i class="fa-solid fa-calendar"></i>
                                                {{$ticket->match->match_date}}</span>
                                            <span class="time ps-2"><i class="fa-solid fa-clock"></i>
                                                {{$ticket->match->match_time}}</span>
                                            <span class="department text-center  "><i class="fa-solid fa-chair"></i>
                                                {{ $ticket->department->name }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="rightticket text-center  col-md-3 col-lg-3">
                                    <div class="ownerName">For: <br><span class="">{{ $ticket->dependent->name }}</span>
                                    </div>
                                    <div class="ownerName">Ticket ID: <span>{{ $ticket->id }}</span></div>
                                    <div class="ownerName">Status: <span>{{ $ticket->status }}</span></div>
                                </div>

                            </div>
                            {{-- <!-- refund-ticket -->
                            @if ($ticket->status=='Activated')
                            <div class="position-absolute w-25">
                                <button class="refundBtn btn-del toggle-button" type="submit">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Refund
                                </button>
                            </div>
                            <!-- Popup window for deleting a dependent  -->
                            <div class="toggle-div popup">
                                <p class="fw-bold fs-4">Warrnig!</p>
                                <p class="text-dark">Are you sure to refund this ticket you will loss 10% from price of
                                    ticket</p>
                                <div class="w-100">
                                    <button onclick="cancelPopUp()" class="btn btn-primary">Cancel</button>
                                    <!--Dellllllllete form-->
                                    <form action="{{ route('user.refundTicket',$ticket->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger" type="submit">
                                            Sure
                                        </button>
                                    </form>
                                    <!--Dellllllllete form-->
                                </div>
                            </div>
                            <div id="overlay" class="overlay"></div>
                            @endif --}}
                        </div>
                        <!--ticket-->
                    </div>


                </div>
                @endforeach
            </div>

            <!-- edit -->


        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/popup.js') }}"></script>
@endsection
