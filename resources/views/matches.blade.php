@extends('layouts.app')
@section('title')
<title>Matches</title>

@endsection

@section('content')


<!-- start of matches section -->
<div class="container mt-5 mb-5">
    <div class="compSelection w-85 mx-auto d-flex justify-content-between align-items-center">
        <h1>Matches</h1>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="egLeague-tab" data-bs-toggle="tab"
                    data-bs-target="#egLeague-tab-pane" type="button" role="tab" aria-controls="egLeague-tab-pane"
                    aria-selected="true">
                    <img src="{{ asset('imgs/egLeague.png') }}" alt="Egy premiar league">
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="copa-tab" data-bs-toggle="tab" data-bs-target="#copa-tab-pane"
                    type="button" role="tab" aria-controls="copa-tab-pane" aria-selected="false">
                    <img src="{{ asset('imgs/copa.png') }}" alt="Egy premiar league">
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="euro-tab" data-bs-toggle="tab" data-bs-target="#euro-tab-pane"
                    type="button" role="tab" aria-controls="euro-tab-pane" aria-selected="false">
                    <img src="{{ asset('imgs/euro.png') }}" alt="Egy premiar league">
                </button>
            </li>
    </div>





    <div class="matchesTable mb-5">
        @if (session('Error'))
        <div class="alert alert-danger text-center">{{ session('Error') }}</div>
        @endif
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="egLeague-tab-pane" role="tabpanel" aria-labelledby="egLeague-tab"
                tabindex="0">
                @foreach ($matches as $match)
                @if($match->competition->country == 'Egypt')
                {{-- @if($match->sold_out != 1 ) --}}
                <div class="match">
                    <div class="row align-items-center justify-content-center">
                        <div class="matchDay col-md-6 col-lg-2">
                            <p>{{ substr($match->match_date,5,3) }}</p>
                            <p>{{ substr($match->match_date,9,2) }}</p>
                            <p>{{ substr($match->match_date,0,4) }}</p>
                        </div>
                        @foreach ($match->teams as $teams )
                        <div class="matchTeams col-sm-6 col-md-3 col-lg-1">
                            <img src="{{ asset('imgs/teams/'.$teams->logo) }}" alt="" />

                        </div>
                        @endforeach

                        <div class="tNamesAndMhInfo ms-3 col-md-12 col-lg-5">
                            <p><i class="fa-solid fa-trophy" style="color: #daa520;"></i>
                                {{ $match->competition->name }}</p>
                            @foreach ($match->teams as $team )
                            <span class="twoTeamsName"> | {{ $team->name }} |</span>
                            @endforeach
                            <p>
                                <i class="fa-solid fa-clock" style="color: #567aa3;"></i> {{ $match->match_time }}
                                <span>-</span>
                                <span><i class="fa-solid fa-landmark-flag"
                                        style="color: #46c753;"></i>{{ $match->stadium->name}}</span>
                            </p>
                        </div>

                        <form class="col-md-12 col-lg-2" action="{{ route('displayBookMatch',$match->id) }}">
                            @guest
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endguest
                            @auth
                            @if (Auth::user()->status== 'panned')
                            <button class="btn main-btn bookbtn p-2" disabled>Book Now</button>
                            @else
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endif

                            @endauth
                        </form>
                    </div>
                </div>


                @endif
                {{-- @endif --}}
                @endforeach
            </div>
            <div class="tab-pane fade" id="copa-tab-pane" role="tabpanel" aria-labelledby="copa-tab" tabindex="0">
                @foreach ($matches as $match)
                @if($match->competition->country == 'intl')
                {{-- @if($match->sold_out != 1 ) --}}
                <div class="match">
                    <div class="row align-items-center justify-content-center">
                        <div class="matchDay col-md-6 col-lg-2">
                            <p>{{ substr($match->match_date,5,3) }}</p>
                            <p>{{ substr($match->match_date,9,2) }}</p>
                            <p>{{ substr($match->match_date,0,4) }}</p>
                        </div>
                        @foreach ($match->teams as $teams )
                        <div class="matchTeams col-sm-6 col-md-3 col-lg-1">
                            <img src="{{ asset('imgs/teams/'.$teams->logo) }}" alt="" />

                        </div>
                        @endforeach

                        <div class="tNamesAndMhInfo ms-3 col-md-12 col-lg-5">
                            <p><i class="fa-solid fa-trophy" style="color: #daa520;"></i>
                                {{ $match->competition->name }}</p>
                            @foreach ($match->teams as $team )
                            <span class="twoTeamsName"> | {{ $team->name }} |</span>
                            @endforeach
                            <p>
                                <i class="fa-solid fa-clock" style="color: #567aa3;"></i> {{ $match->match_time }}
                                <span>-</span>
                                <span><i class="fa-solid fa-landmark-flag"
                                        style="color: #46c753;"></i>{{ $match->stadium->name}}</span>
                            </p>
                        </div>

                        <form class="col-md-12 col-lg-2" action="{{ route('displayBookMatch',$match->id) }}">
                            @guest
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endguest
                            @auth
                            @if (Auth::user()->status== 'panned')
                            <button class="btn main-btn bookbtn p-2" disabled>Book Now</button>
                            @else
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endif

                            @endauth
                        </form>
                    </div>
                </div>


                @endif
                {{-- @endif --}}
                @endforeach


            </div>
            <div class="tab-pane fade" id="euro-tab-pane" role="tabpanel" aria-labelledby="euro-tab" tabindex="0">
                @foreach ($matches as $match)
                @if($match->competition->country == "eurocups")
                {{-- @if($match->sold_out != 1 ) --}}
                <div class="match">
                    <div class="row align-items-center justify-content-center">
                        <div class="matchDay col-md-6 col-lg-2">
                            <p>{{ substr($match->match_date,5,3) }}</p>
                            <p>{{ substr($match->match_date,9,2) }}</p>
                            <p>{{ substr($match->match_date,0,4) }}</p>
                        </div>
                        @foreach ($match->teams as $teams )
                        <div class="matchTeams col-sm-6 col-md-3 col-lg-1">
                            <img src="{{ asset('imgs/teams/'.$teams->logo) }}" alt="" />

                        </div>
                        @endforeach

                        <div class="tNamesAndMhInfo ms-3 col-md-12 col-lg-5">
                            <p><i class="fa-solid fa-trophy" style="color: #daa520;"></i>
                                {{ $match->competition->name }}</p>
                            @foreach ($match->teams as $team )
                            <span class="twoTeamsName"> | {{ $team->name }} |</span>
                            @endforeach
                            <p>
                                <i class="fa-solid fa-clock" style="color: #567aa3;"></i> {{ $match->match_time }}
                                <span>-</span>
                                <span><i class="fa-solid fa-landmark-flag"
                                        style="color: #46c753;"></i>{{ $match->stadium->name}}</span>
                            </p>
                        </div>

                        <form class="col-md-12 col-lg-2" action="{{ route('displayBookMatch',$match->id) }}">
                            @guest
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endguest
                            @auth
                            @if (Auth::user()->status== 'panned')
                            <button class="btn main-btn bookbtn p-2" disabled>Book Now</button>
                            @else
                            <button class="btn main-btn bookbtn p-2" type="submit">Book Now</button>
                            @endif

                            @endauth
                        </form>
                    </div>
                </div>


                @endif
                {{-- @endif --}}
                @endforeach
            </div>

        </div>

        <!--Match info-->
    </div>
</div>

<!-- end of matches section -->






@endsection
