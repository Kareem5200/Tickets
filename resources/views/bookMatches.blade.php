@extends('layouts.app')
@section('title')
<title> Book match</title>
@endsection

@section('content')

<!-- start of Teams & stadium section -->
<div class="BookPage container mb-5">
    <div class="row justify-content-evenly">
        <div class="TeamsAndStadium col-md-12 col-lg-5 mt-5">
            <div class="match-bookPage">
                <div class="TeamsMatch d-flex justify-content-around">
                    @foreach ($match->teams as $team )
                    <div class="teamOne w-50">
                        <div class="text-center">
                            <img src="{{ asset('imgs/teams/'.$team->logo)}}" alt="team logo" />
                        </div>
                        <p class="mb-0 text-center">{{$team->name}}</p>
                    </div>
                    @endforeach
                </div>

                <div class="matchData d-flex justify-content-evenly mt-2">
                    <span class="m-0 text-black-50">
                        <i class="fa-solid fa-trophy" style="color: #daa520;"></i> {{ $match->competition->name }}
                    </span>
                    <span class="m-0 text-black-50">
                        <i class="fa-regular fa-calendar"></i> {{ $match->match_date }}
                    </span>
                    <span class="m-0 text-black-50"><i class="fa-solid fa-clock" style="color: #567aa3;"></i>
                        {{ $match->match_time }}</span>
                </div>
            </div>
            <div class="stadiumChart justify-content-center">
                <p class="text-center fs-4">{{ $match->stadium->name }}</p>
                <p class="text-center fs-6 fw-light text-black-50">
                    Click to view how its look like to be there
                </p>
                <!--stadium-->
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <img src="{{ asset('imgs/WhatsApp Image 2024-03-20 at 03.39.56_e7a1516f.jpg') }}"
                            usemap="#image-map" class="map" />
                    </div>
                </div>


                <map name="image-map">
                    <area target="" alt="cat-left" title="cat-left" onclick="showDepartment1()"
                        coords="119,234,98,276,57,254,40,227,34,190,34,135,45,99,63,78,99,55,118,98,102,107,90,119,83,135,80,155,81,199,91,222"
                        shape="poly">
                    <area target="" alt="cat-right" title="cat-right" onclick="showDepartment2()"
                        coords="220,97,237,56,279,70,299,89,312,114,318,138,318,167,317,202,309,232,294,253,267,275,241,232,262,215,268,197,266,138,252,113"
                        shape="poly">
                    <area target="" alt="cat-front" title="cat-front" onclick="showDepartment3()"
                        coords="107,56,122,100,164,99,215,100,226,56,171,57" shape="poly">
                    <area target="" alt="cat-back" title="cat-back" onclick="showDepartment4()"
                        coords="106,276,124,237,231,234,252,276,182,284" shape="poly">
                    <area target="" alt="vip" title="vip" onclick="showDepartment5()"
                        coords="127,297,125,318,162,325,222,322,234,317,229,297" shape="poly">
                </map>

                <!--stadium-->
            </div>
        </div>
        <div class="bookSection col-md-12 col-lg-7 mt-5">
            <div class="div1 d-flex justify-content-between p-3">
                <h2 class="p-2">Book your Match ticket:</h2>
                <button id="showDivButton" class="main-btn mt-4 fs-5 addTicetbtn">
                    <i class="fa-solid fa-ticket fa-beat-fade"></i> Add Ticket
                </button>
            </div>


            <div class="selectedTicketSection">
                @if (session('Error'))
                <div class="alert alert-danger">{{ session('Error') }}</div>
                @endif


                {{-- action="{{ route('user.bookTicket',$match->id) }}" --}}
                <form action="{{ route('user.credit',$match->id) }}" method="POST">
                    @csrf
                    <!-- selected Ticket -->
                    <div class="selectedTicket position-relative">
                        <div class="gap-1 d-flex justify-content-between">
                            <div class="col-lg-4">
                                <label class="text-black-50 fw-medium" for="buyer "><i
                                        class="fa-solid fa-user-plus"></i> Ticket To</label>
                                <select class="mb-3 form-select " name="ticket[0][owner_id]" id="">
                                    <option value="">Ticket To?</option>
                                    <option value="{{ Auth::id() }}">{{Auth::user()->name}} (You)</option>
                                    {{-- @foreach ($dependents_has_no_match_ticket as  $dependent)
                    <option value="{{ $dependent['id'] }}">{{ $dependent['name'] }} "Dependent"</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-lg-4" id="hideDepp1">
                                <label class="text-black-50 fw-medium" for="department"><i
                                        class="fa-solid fa-street-view"></i> Department</label>
                                <select class="mb-3 form-select visData" name="ticket[0][department_id]" id="tic1">
                                    <option value="">Choose departmnet</option>
                                    @foreach ($available_departments as $department )
                                    <!-- <option value="{{ $department['id'] }}">{{ $department['name']}} ||  available {{ $department['available'] }} || price {{ $department['price']}}</option> -->
                                    <!-- <option hidden id="sasa" >{{ $department['price']}}</option>            -->
                                    <option value="{{ $department['id'] }}" tic1-price="{{ $department['price'] }}"
                                        tic1-avl="{{ $department['available'] }}">{{ $department['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4" id="hideBusss1">
                                <label class="text-black-50 fw-medium" for="department"><i class="fa-solid fa-bus"></i>
                                    Trip for match</label>
                                <select class="mb-3 form-select visData" name="ticket[0][bus_id]" id="bus1">
                                    <option value="">Choose Trip</option>
                                    @foreach ($available_trips as $trip )
                                    <option value="{{ $trip->bus->id }}" bus1-price="{{ $trip->price }}"
                                        bus1-station="{{ $trip->station->location }}"
                                        bus1-plate="{{ $trip->bus->bus_number }}" bus1-avl="{{  $trip->empty_seats }}">
                                        {{ $trip->station->location }}({{ $trip->bus->bus_number }})
                                    </option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div id="outputOne1" class="output-one">

                        </div>
                        <div id="outputTwo1" class="output-two">

                        </div>

                        <div class="position-absolute overChoise d-flex justify-content-center align-items-center  "
                            id="overChoise1">
                            <div class="selMatch px-4 py-2 me-5" id="selMatchTickk1"><i
                                    class="fa-solid fa-ticket-simple"></i> match</div>
                            <div class="selBus px-4 py-2" id="selBusTickk1"><i class="fa-solid fa-bus"></i> Bus</div>

                        </div>


                    </div>
                    <!-- selected Ticket -->
                    <!-- selected Ticket -->
                    <div class="selTickH" id="hideTicket2">
                        <div class="selectedTicket position-relative">
                            <div class="gap-1 d-flex justify-content-between">
                                <div class="col-lg-4">
                                    <label class="text-black-50 fw-medium" for="buyer"><i
                                            class="fa-solid fa-user-plus"></i> Ticket To</label>
                                    <select class="kiko mb-3 form-select" name="ticket[1][owner_id]" id="buyer2"
                                        onchange="checkOptions()">
                                        <option value="">Ticket To?</option>
                                        <option value="{{ Auth::id() }}">{{Auth::user()->name}} (You)</option>
                                        @foreach ($dependents_has_no_match_ticket as $dependent)
                                        <option value="{{ $dependent['id'] }}" ticketdata="{{ $dependent['name'] }}">
                                            {{ $dependent['name'] }} "Dependent"</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideDepp2">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-street-view"></i>Department</label>
                                    <select class="mb-3 visData form-select" name="ticket[1][department_id]" id="tic2">
                                        <option value="">Choose departmnet</option>
                                        @foreach ($available_departments as $department )
                                        <option value="{{ $department['id'] }}" tic2-price="{{ $department['price'] }}"
                                            tic2-avl="{{ $department['available'] }}">{{ $department['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideBusss2">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-bus"></i>Trip for match</label>
                                    <select class="mb-3 visData form-select" name="ticket[1][bus_id]" id="bus2">
                                        <option value="">Choose Trip</option>
                                        @foreach ($available_trips as $trip )
                                        <option value="{{ $trip->bus->id }}" bus2-price="{{ $trip->price }}"
                                            bus2-station="{{ $trip->station->location }}"
                                            bus2-plate="{{ $trip->bus->bus_number }}"
                                            bus2-avl="{{  $trip->empty_seats }}">
                                            {{ $trip->station->location }}({{ $trip->bus->bus_number }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div id="outputOne2" class="output-one">

                            </div>
                            <div id="outputTwo2" class="output-two">

                            </div>
                            <div class="position-absolute overChoise d-flex justify-content-center align-items-center  "
                                id="overChoise2">
                                <div class="selMatch px-4 py-2 me-5" id="selMatchTickk2"><i
                                        class="fa-solid fa-ticket-simple"></i> match</div>
                                <div class="selBus px-4 py-2" id="selBusTickk2"><i class="fa-solid fa-bus"></i> Bus
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- selected Ticket -->
                    <!-- selected Ticket -->
                    <div class="selTickH" id="hideTicket3">
                        <div class="selectedTicket position-relative ">
                            <div class="gap-1 d-flex justify-content-between">
                                <div class="col-lg-4">
                                    <label class="text-black-50 fw-medium" for="buyer"><i
                                            class="fa-solid fa-user-plus"></i> Ticket To</label>
                                    <select class="kiko mb-3 form-select" name="ticket[2][owner_id]" id="buyer3"
                                        onchange="checkOptions()">
                                        <option value="">Ticket To?</option>
                                        {{-- <option value="{{ Auth::id() }}">{{Auth::user()->name}} (You)</option> --}}
                                        @foreach ($dependents_has_no_match_ticket as $dependent)
                                        <option value="{{ $dependent['id'] }}">{{ $dependent['name'] }} "Dependent"
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideDepp3">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-street-view"></i>Department</label>
                                    <select class="mb-3 visData form-select" name="ticket[2][department_id]" id="tic3">
                                        <option value="">Choose departmnet</option>
                                        @foreach ($available_departments as $department )
                                        <option value="{{ $department['id'] }}" tic3-price="{{ $department['price'] }}"
                                            tic3-avl="{{ $department['available'] }}">{{ $department['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideBusss3">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-bus"></i>Trip for match</label>
                                    <select class="mb-3 visData form-select" name="ticket[2][bus_id]" id="bus3">
                                        <option value="">Choose Trip</option>
                                        @foreach ($available_trips as $trip )
                                        <option value="{{ $trip->bus->id }}" bus3-price="{{ $trip->price }}"
                                            bus3-station="{{ $trip->station->location }}"
                                            bus3-plate="{{ $trip->bus->bus_number }}"
                                            bus3-avl="{{  $trip->empty_seats }}">
                                            {{ $trip->station->location }}({{ $trip->bus->bus_number }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="outputOne3" class="output-one">

                            </div>
                            <div id="outputTwo3" class="output-two">

                            </div>
                            <div class="position-absolute overChoise d-flex justify-content-center align-items-center  "
                                id="overChoise3">
                                <div class="selMatch px-4 py-2 me-5" id="selMatchTickk3"><i
                                        class="fa-solid fa-ticket-simple"></i> match</div>
                                <div class="selBus px-4 py-2" id="selBusTickk3"><i class="fa-solid fa-bus"></i> Bus
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- selected Ticket -->
                    <!-- selected Ticket -->
                    <div class="selTickH" id="hideTicket4">
                        <div class="selectedTicket position-relative ">
                            <div class="gap-1 d-flex justify-content-between">
                                <div class="col-lg-4">
                                    <label class="text-black-50 fw-medium" for="buyer"><i
                                            class="fa-solid fa-user-plus"></i> Ticket To</label>
                                    <select class="kiko mb-3 form-select" name="ticket[3][owner_id]" id="buyer4"
                                        onchange="checkOptions()">
                                        <option value="">Ticket To?</option>
                                        {{-- <option value="{{ Auth::id() }}">{{Auth::user()->name}} (You)</option> --}}
                                        @foreach ($dependents_has_no_match_ticket as $dependent)
                                        <option value="{{ $dependent['id'] }}">{{ $dependent['name'] }} "Dependent"
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideDepp4">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-street-view"></i>Department</label>
                                    <select class="mb-3 visData form-select" name="ticket[3][department_id]" id="tic4">
                                        <option value="">Choose departmnet</option>
                                        @foreach ($available_departments as $department )
                                        <option value="{{ $department['id'] }}" tic4-price="{{ $department['price'] }}"
                                            tic4-avl="{{ $department['available'] }}">{{ $department['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4" id="hideBusss4">
                                    <label class="text-black-50 fw-medium" for="department"><i
                                            class="fa-solid fa-bus"></i>Trip for match</label>
                                    <select class="mb-3 visData form-select" name="ticket[3][bus_id]" id="bus4">
                                        <option value="">Choose Trip</option>
                                        @foreach ($available_trips as $trip )
                                        <option value="{{ $trip->bus->id }}" bus4-price="{{ $trip->price }}"
                                            bus4-station="{{ $trip->station->location }}"
                                            bus4-plate="{{ $trip->bus->bus_number }}"
                                            bus4-avl="{{  $trip->empty_seats }}">
                                            {{ $trip->station->location }}({{ $trip->bus->bus_number }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="outputOne4" class="output-one">

                            </div>
                            <div id="outputTwo4" class="output-two">

                            </div>
                            <div class="position-absolute overChoise d-flex justify-content-center align-items-center  "
                                id="overChoise4">
                                <div class="selMatch px-4 py-2 me-5" id="selMatchTickk4"><i
                                        class="fa-solid fa-ticket-simple"></i> match</div>
                                <div class="selBus px-4 py-2" id="selBusTickk4"><i class="fa-solid fa-bus"></i> Bus
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- selected Ticket -->

                    <!-- el total bta3 el tickets -->
                    <div class="total-money d-flex justify-content-between align-items-center rounded-pill px-3 py-2">
                        <p class="m-0 fw-bold">Total Tickts Value:</p>
                        <div class="fw-bold" id="containers"></div>

                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- el total bta3 el tickets -->
                        <input type="hidden" name="totalPrice" id="totalMoney">
                        <button id="submitButton" class="btn btn-success mb-3" type="submit">Procced To Payment</button>
                    </div>
            </div>



            </form>


            <div id="popupDepartment1" class="popDep">
                <h2 class="text-center">CAT3-L</h2>
                <p class="text-center">This is the view from CAT3-Left</p>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1716071372138!6m8!1m7!1sCAoSLEFGMVFpcE9XTHFhbE53MnlvczgxWXdEalo0a3FraTFwSHU1QjdwUy12TzVf!2m2!1d48.2195285236798!2d11.62442062050104!3f16.232812624973008!4f1.8681418879312446!5f0.7820865974627469"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <br />
                <div class="d-flex justify-content-center">
                    <button onclick="cancelDepartment1()" class="btn btn-danger">
                        Close
                    </button>
                </div>
            </div>
            <div id="popupDepartment2" class="popDep">
                <h2 class="text-center">CAT3-L</h2>
                <p class="text-center">This is the view from CAT3-Left</p>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1716071797822!6m8!1m7!1sckIfKO3WbX8AAAQrBntOqA!2m2!1d48.21824191555147!2d11.62507928432069!3f357.94663946991386!4f-15.143228240881967!5f0.7820865974627469"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <br />
                <div class="d-flex justify-content-center">
                    <button onclick="cancelDepartment2()" class="btn btn-danger">
                        Close
                    </button>
                </div>
            </div>
            <div id="popupDepartment3" class="popDep">
                <h2 class="text-center">CAT3-L</h2>
                <p class="text-center">This is the view from CAT3-Left</p>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1716071957831!6m8!1m7!1sE1uFI0PrRnMAAAQrBntOrQ!2m2!1d48.21864847557482!2d11.62552420383441!3f253.7675615917472!4f-12.197747066238463!5f0.7820865974627469"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <br />
                <div class="d-flex justify-content-center">
                    <button onclick="cancelDepartment3()" class="btn btn-danger">
                        Close
                    </button>
                </div>
            </div>
            <div id="popupDepartment4" class="popDep">
                <h2 class="text-center">CAT3-L</h2>
                <p class="text-center">This is the view from CAT3-Left</p>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1716072061303!6m8!1m7!1sCAoSLEFGMVFpcE0yanozOE0wN3pGN3g1bEZVWlB2bjlMRUR5V0RjS2EtbnJsT0pM!2m2!1d48.2187874!2d11.6255886!3f266.0197066668794!4f-14.107752206596274!5f0.7820865974627469"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <br />
                <div class="d-flex justify-content-center">
                    <button onclick="cancelDepartment4()" class="btn btn-danger">
                        Close
                    </button>
                </div>
            </div>
            <div id="popupDepartment5" class="popDep">
                <h2 class="text-center">CAT3-L</h2>
                <p class="text-center">This is the view from CAT3-Left</p>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1716072237007!6m8!1m7!1sCAoSLEFGMVFpcE91dDVqUTUwT3BHMzVLNG5vX0N4RmZqWGlSM2F5TkNpT0czRUxu!2m2!1d48.21861240448062!2d11.62377621978521!3f180.43657788718744!4f-16.54521002699701!5f0.7820865974627469"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <br />
                <div class="d-flex justify-content-center">
                    <button onclick="cancelDepartment5()" class="btn btn-danger">
                        Close
                    </button>
                </div>
            </div>
            <div id="overlay" class="overlay"></div>
            <!--CAT3-L-->

            <!-- start of Teams & stadium section -->




            <script>
            //   function resetSelects() {
            //   document.getElementById("buyer2").selectedIndex = 0;
            //   document.getElementById("tic2").selectedIndex = 0;
            //   document.getElementById("bus2").selectedIndex = 0;
            //   document.getElementById("buyer3").selectedIndex = 0;
            //   document.getElementById("tic3").selectedIndex = 0;
            //   document.getElementById("bus3").selectedIndex = 0;
            //   document.getElementById("buyer4").selectedIndex = 0;
            //   document.getElementById("tic4").selectedIndex = 0;
            //   document.getElementById("bus4").selectedIndex = 0;
            // }





            var container = document.getElementById("containers");
            var ticaValue1 = 0;
            var busValue1 = 0;
            var ticaValue2 = 0;
            var busValue2 = 0;
            var ticaValue3 = 0;
            var busValue3 = 0;
            var ticaValue4 = 0;
            var busValue4 = 0;

            var ticket1 = document.getElementById('tic1');
            var trans1 = document.getElementById('bus1');

            var ticket2 = document.getElementById('tic2');
            var trans2 = document.getElementById('bus2');

            var ticket3 = document.getElementById('tic3');
            var trans3 = document.getElementById('bus3');

            var ticket4 = document.getElementById('tic4');
            var trans4 = document.getElementById('bus4');

            // Define a separate function to handle the change event
            function handleTicketChange() {
                var selectedOption1 = ticket1.options[ticket1.selectedIndex];
                var selectedOption2 = trans1.options[trans1.selectedIndex];

                var selectedOption3 = ticket2.options[ticket2.selectedIndex];
                var selectedOption4 = trans2.options[trans2.selectedIndex];

                var selectedOption5 = ticket3.options[ticket3.selectedIndex];
                var selectedOption6 = trans3.options[trans3.selectedIndex];

                var selectedOption7 = ticket4.options[ticket4.selectedIndex];
                var selectedOption8 = trans4.options[trans4.selectedIndex];

                //awel select
                if (selectedOption1.hasAttribute('tic1-price')) {
                    ticaValue1 = parseInt(selectedOption1.getAttribute('tic1-price')); // Assign value to ticaValue
                } else {
                    ticaValue1 = 0;
                }

                if (selectedOption2.hasAttribute('bus1-price')) {
                    busValue1 = parseInt(selectedOption2.getAttribute('bus1-price')); // Assign value to ticaValue
                } else {
                    busValue1 = 0;
                }
                //tany select
                if (selectedOption3.hasAttribute('tic2-price')) {
                    ticaValue2 = parseInt(selectedOption3.getAttribute('tic2-price')); // Assign value to ticaValue
                } else {
                    ticaValue2 = 0;
                }

                if (selectedOption4.hasAttribute('bus2-price')) {
                    busValue2 = parseInt(selectedOption4.getAttribute('bus2-price')); // Assign value to ticaValue
                } else {
                    busValue2 = 0;
                }
                //3rd select
                if (selectedOption5.hasAttribute('tic3-price')) {
                    ticaValue3 = parseInt(selectedOption5.getAttribute('tic3-price')); // Assign value to ticaValue
                } else {
                    ticaValue3 = 0;
                }

                if (selectedOption6.hasAttribute('bus3-price')) {
                    busValue3 = parseInt(selectedOption6.getAttribute('bus3-price')); // Assign value to ticaValue
                } else {
                    busValue3 = 0;
                }
                //4th select
                if (selectedOption7.hasAttribute('tic4-price')) {
                    ticaValue4 = parseInt(selectedOption7.getAttribute('tic4-price')); // Assign value to ticaValue
                } else {
                    ticaValue4 = 0;
                }

                if (selectedOption8.hasAttribute('bus4-price')) {
                    busValue4 = parseInt(selectedOption8.getAttribute('bus4-price')); // Assign value to ticaValue
                } else {
                    busValue4 = 0;
                }

                var totalTicketsValue = ticaValue1 + busValue1 + ticaValue2 + busValue2 + ticaValue3 + busValue3 +
                    ticaValue4 + busValue4;


                container.textContent = (totalTicketsValue) + " EGP";

                document.getElementById("totalMoney").value = totalTicketsValue;



            }

            // Call the function to handle initial state
            handleTicketChange();

            // Add event listener directly to the element without an event listener function
            ticket1.addEventListener('change', handleTicketChange);
            trans1.addEventListener('change', handleTicketChange);

            ticket2.addEventListener('change', handleTicketChange);
            trans2.addEventListener('change', handleTicketChange);

            ticket3.addEventListener('change', handleTicketChange);
            trans3.addEventListener('change', handleTicketChange);

            ticket4.addEventListener('change', handleTicketChange);
            trans4.addEventListener('change', handleTicketChange);

            //disavel options if the fan chooses one of them




            //hide and show tickets
            const showDivButton = document.getElementById('showDivButton');
            const hideButtons = document.querySelectorAll('.hideButton');
            const divs = [
                document.getElementById('hideTicket2'),
                document.getElementById('hideTicket3'),
                document.getElementById('hideTicket4')
            ];






            showDivButton.addEventListener('click', function() {
                for (let i = 0; i < divs.length; i++) {
                    if (divs[i].classList.contains('selTickH')) {
                        divs[i].classList.remove('selTickH');
                        break;
                    }
                }
                this.innerText = 'Add Another Ticket';
            });

            hideButtons.forEach((button, index) => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    divs[index].classList.add('selTickH');


                });
            });





            //***********************************5/18**************** */

            // Function to handle the selection change for match tickets
            function ticketMatchSelect(event, index) {
                const selectedOption = event.target.selectedOptions[0];
                const ticAvl = selectedOption.getAttribute(`tic${index}-avl`);
                const ticPrice = selectedOption.getAttribute(`tic${index}-price`);
                if (ticAvl === null) {
                    document.getElementById(`outputOne${index}`).innerHTML = ``;
                } else {
                    document.getElementById(`outputOne${index}`).innerHTML =
                        `
            <span class=""><i class="fa-solid fa-circle"></i> Dep Tickets Avl: ${ticAvl}</span>
            <span><i class="fa-regular fa-credit-card"></i> Match ticket price: ${ticPrice}</span>
        `;
                }
            }

            // Function to handle the selection change for bus tickets
            function ticketBusSelect(event, index) {
                const selectedOption = event.target.selectedOptions[0];
                const busAvl = selectedOption.getAttribute(`bus${index}-avl`);
                const busPrice = selectedOption.getAttribute(`bus${index}-price`);
                const busStation = selectedOption.getAttribute(`bus${index}-station`);
                const busPlate = selectedOption.getAttribute(`bus${index}-plate`);
                if (busAvl === null) {
                    document.getElementById(`outputTwo${index}`).innerHTML = ``;
                } else {
                    document.getElementById(`outputTwo${index}`).innerHTML =
                        `
            <span class=""><i class="fa-solid fa-circle"></i> Bus Tickets Avl: ${busAvl}</span>
            <span><i class="fa-solid fa-map-location-dot"></i> station: ${busStation}</span>
            <span><i class="fa-solid fa-bus"></i> Bus plate: ${busPlate}</span>
            <span><i class="fa-regular fa-credit-card"></i> Bus ticket price: ${busPrice}</span>
        `;
                }
            }

            // Function to initialize event listeners
            function initializeEventListeners() {
                for (let i = 1; i <= 4; i++) {
                    document.getElementById(`tic${i}`).addEventListener('change', (event) => ticketMatchSelect(event,
                        i));
                    document.getElementById(`bus${i}`).addEventListener('change', (event) => ticketBusSelect(event, i));
                }
            }

            // Initialize event listeners on DOMContentLoaded
            document.addEventListener('DOMContentLoaded', initializeEventListeners);



            //***********************************5/18**************** */
            </script>

            <script>
            var repetitions = 4;

            for (var i = 1; i <= repetitions; i++) {
                (function(i) {
                    var overChoise = document.getElementById('overChoise' + i);
                    var selMatchTickk = document.getElementById('selMatchTickk' + i);
                    var selBusTickk = document.getElementById('selBusTickk' + i);
                    var tickittt = document.getElementById('hideDepp' + i);
                    var bussss = document.getElementById('hideBusss' + i);

                    selMatchTickk.addEventListener('click', function() {
                        overChoise.classList.add('d-none');
                        bussss.classList.add('d-none');
                    });
                    selBusTickk.addEventListener('click', function() {
                        overChoise.classList.add('d-none');
                        tickittt.classList.add('d-none');
                    });
                })(i);
            }
            </script>






            <!-- script files -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>
            <script type="text/javascript">
            $(function() {
                $(".map").maphilight();
            });

            function showDepartment1() {
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popupDepartment1").style.display = "block";
            }

            function cancelDepartment1() {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("popupDepartment1").style.display = "none";
            }

            function showDepartment2() {
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popupDepartment2").style.display = "block";
            }

            function cancelDepartment2() {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("popupDepartment2").style.display = "none";
            }

            function showDepartment3() {
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popupDepartment3").style.display = "block";
            }

            function cancelDepartment3() {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("popupDepartment3").style.display = "none";
            }

            function showDepartment4() {
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popupDepartment4").style.display = "block";
            }

            function cancelDepartment4() {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("popupDepartment4").style.display = "none";
            }

            function showDepartment5() {
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popupDepartment5").style.display = "block";
            }

            function cancelDepartment5() {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("popupDepartment5").style.display = "none";
            }
            </script>



            @endsection
