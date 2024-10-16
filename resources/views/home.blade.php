@extends('layouts.app')
@section('title')
<title>Home</title>
@endsection

@section('content')

<div class="p-2 mybg" >
    <div class="container  mt-5 mb-5">
      <div class="text-center postion-relative">
        <i class="fa-regular fa-futbol fs-1 postion-absolute"></i>
        <h1 class="text-center">Upcoming  Matches</h1>
      </div>
    <div class="matchesTable mb-5">
    @foreach ($sampleOfMatches as $match)
    <div class="match forVs">
        <div class="row gy-3 align-items-center justify-content-between">
          <div class="matchDay col-md-6 col-lg-2">
            <p>{{ substr($match->match_date,5,3) }}</p>
            <p>{{ substr($match->match_date,9,2) }}</p>
            <p>{{ substr($match->match_date,0,4) }}</p>
          </div>

          @foreach ($match->teams as $team )
          <div class="matchTeams col-sm-6  col-md-3 col-lg-1">
            <img src="{{ asset('imgs/teams/'.$team->logo) }}" alt="team logo" />
          </div>
         @endforeach

        <div class="tNamesAndMhInfo ms-3 col-md-12 col-lg-5">

            <p><i class="fa-solid fa-trophy" style="color: #daa520;"></i> {{ $match->competition->name }}</p>
            @foreach ($match->teams as $team )
            <span class="twoTeamsName"> | {{ $team->name }} |</span>
            @endforeach
            <p>
              <i class="fa-solid fa-clock" style="color: #567aa3;"></i> {{ $match->match_time }} <span>-</span>
              <span
                ><i class="fa-solid fa-landmark-flag" style="color: #46c753;"></i> {{ $match->stadium->name }}</span
              >
            </p>
          </div>

        </div>
      </div>
      <!--Match info-->

    @endforeach
    </div>
  </div>
  </div>




@endsection
