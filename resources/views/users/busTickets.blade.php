@extends('layouts.app')
@section('title')
<title>Bus tickets</title>
@endsection

@section('content')


{{-- @if(session('failed'))
<div class="alert alert-success">{{ session('failed') }}</div>
@endif --}}


<!--my match ticket section-->
<div class="container mt-5 mb-5">
    <h2 class="w-90 mx-auto">Bus Tickets</h2>
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
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body py-4">
                        <div class="row align-items-center">
                            @foreach ($fan_tickets as $ticket )
                            <!--ticket-->
                            <div class="ticketContainer bus-ticket position-relative text-white col-md-8 mx-auto">
                                <div class="row">
                                    <div
                                        class="ticLeftLogo position-relative col-md-3 col-lg-3 d-none d-sm-none d-md-block">
                                        <img class="w-100 h-100" src="{{ asset('imgs/bus (2).png') }}" alt="" />
                                    </div>
                                    <div class="ticinfo pb-2 pt-2 col-md-6 col-lg-6">
                                        <p class="compName busTicketTitle bus text-center fs-1 mb-0">
                                            Bus TIcket
                                        </p>

                                        <div class="ticketData d-flex justify-content-between">
                                            <div>
                                                <div class="departure-date">
                                                    <label class="text-capitalize ch-font" for=""><i
                                                            class="fa-solid fa-calendar"></i> departure
                                                        date:</label>
                                                    <p>{{ $ticket->trip_date }}</p>
                                                </div>
                                                <div class="departure-time">
                                                    <label class="text-capitalize ch-font" for=""><i
                                                            class="fa-regular fa-clock"></i> departure
                                                        time:</label>
                                                    <p>{{  $ticket->trip_time }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fan-id">
                                                    <label class="text-capitalize ch-font" for=""></label>
                                                    Fan id:</label>
                                                    <p>{{ $ticket->user->id }}</p>
                                                </div>
                                                <div class="bus-id">
                                                    <label class="text-capitalize ch-font" for="">Bus id:</label>
                                                    <p>{{ $ticket->trip->bus->bus_number}}</p>
                                                </div>
                                            </div>
                                            <div class="v-line position-relative">
                                                <label class="text-capitalize ch-font" for=""><i
                                                        class="fa-solid fa-map-location-dot"></i> route:</label>
                                                <p>{{ $ticket->station }}</p>
                                                <p title="{{ $ticket->match->stadium->name }}">
                                                    {{ $ticket->match->stadium->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rightticket text-center d-flex col-md-3 col-lg-3">
                                        <div>
                                            <div class="ownerName w-100 my-2">
                                                For: <br /><span class="">{{ $ticket->user->name }}</span>
                                            </div>
                                            <p class="my-2">
                                                Ticket NO. <br /><span>{{ $ticket->id }}</span>
                                            </p>
                                            <div class="ownerName my-2">
                                                Status: <br />
                                                <span>{{ $ticket->status }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- refund-ticket -->
                                @if($ticket->status =='Activated')
                                <div class="position-absolute w-25">
                                    <button class="refundBtn btn-del toggle-button" type="submit">
                                        <i class="fa-solid fa-trash-arrow-up"></i> Refund
                                    </button>
                                </div>
                                <!-- refund-ticket -->
                            </div>
                            <!--ticket-->


                            <!-- Popup window for deleting a dependent  -->
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


                        <!-- refund-ticket -->
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <span class="fs-5 fw-bold">My Tickets</span>
                    </button>
                </h2>

            </div>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse ">
                <div class="accordion-body py-4">
                    <div class="row align-items-center">
                        @foreach ($dependent_tickets as $ticket )
                        <!--ticket-->
                        <div class="ticketContainer bus-ticket position-relative text-white col-md-8 mx-auto">
                            <div class="row">
                                <div
                                    class="ticLeftLogo position-relative col-md-3 col-lg-3 d-none d-sm-none d-md-block">
                                    <img class="w-100 h-100" src="{{ asset('imgs/bus (2).png') }}" alt="" />
                                </div>
                                <div class="ticinfo pb-2 pt-2 col-md-6 col-lg-6">
                                    <p class="compName busTicketTitle bus text-center fs-1 mb-0">
                                        Bus TIcket
                                    </p>

                                    <div class="ticketData d-flex justify-content-between">
                                        <div>
                                            <div class="departure-date">
                                                <label class="text-capitalize ch-font" for=""><i
                                                        class="fa-solid fa-calendar"></i> departure
                                                    date:</label>
                                                <p>{{ $ticket->trip_date }}</p>
                                            </div>
                                            <div class="departure-time">
                                                <label class="text-capitalize ch-font" for=""><i
                                                        class="fa-regular fa-clock"></i> departure
                                                    time:</label>
                                                <p>{{  $ticket->trip_time }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fan-id">
                                                <label class="text-capitalize ch-font" for=""></label>
                                                dep id:</label>
                                                <p>{{ $ticket->dependent_id }}</p>
                                            </div>
                                            <div class="bus-id">
                                                <label class="text-capitalize ch-font" for="">Bus id:</label>
                                                <p>{{ $ticket->trip->bus->bus_number}}</p>
                                            </div>
                                        </div>
                                        <div class="v-line position-relative">
                                            <label class="text-capitalize ch-font" for=""><i
                                                    class="fa-solid fa-map-location-dot"></i> route:</label>
                                            <p>{{ $ticket->station }}</p>
                                            <p title="{{ $ticket->match->stadium->name }}">
                                                {{ $ticket->match->stadium->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rightticket text-center d-flex col-md-3 col-lg-3">
                                    <div>
                                        <div class="ownerName w-100 my-2">
                                            For: <br /><span class="">{{ $ticket->dependent->name }}</span>
                                        </div>
                                        <p class="my-2">
                                            Ticket NO. <br /><span>{{ $ticket->id }}</span>
                                        </p>
                                        <div class="ownerName my-2">
                                            Status: <br />
                                            <span>{{ $ticket->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- refund-ticket -->
                            @if($ticket->status =='Activated')



                            <div class="position-absolute w-25">
                                <button class="refundBtn btn-del toggle-button" type="submit">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Refund
                                </button>
                            </div>
                            <!-- refund-ticket -->
                        </div>
                        <!--ticket-->


                        <!-- Popup window for deleting a dependent  -->
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


                    <!-- refund-ticket -->
                    @endforeach

                </div>
            </div>


        </div>
    </div>

</div>

<!--my match ticket section-->



@endsection
@section('js')
<script src="{{ asset('js/popup.js') }}"></script>
@endsection
