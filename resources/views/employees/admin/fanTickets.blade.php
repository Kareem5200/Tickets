@extends('layouts.dashboard')
@section('title')
    <title>Fan tickets</title>
@endsection

@section('content')


@extends('layouts.dashboard')

@section('title')
<title> Our trips </title>
@endsection

@section("content")
<div class="dashboard_content">
    <div class="container">
      <div class="col-md-12 col-lg-12">
        <h1>Manage Fan</h1>
        <h3><i class="fa-solid fa-angle-right"></i>Tickets</h3>

        <input
        class="searchField"
        type="text"
        id="searchInput"
        placeholder=" Search by name or ID or Ticket ID" />

        {{-- <input
          class="searchField"
          type="text"
          id="searchInput"
          placeholder=" Search by trip ID " /> --}}

      </div>
      <div class="row">
        <table id="dataTable" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">User ID</th>
              <th scope="col">Name</th>
              <th scope="col">Ticket ID</th>
              <th scope="col">Ticket status</th>
              <th scope="col">Ticket Price</th>
              <th scope="col">Refund date</th>
              <th scope="col">Refund Price</th>
               {{-- <th scope="col">Delete?</th> --}}
            </tr>
          </thead>
          <tbody>
            <!--this is emp row-->
            @foreach ($allTickets as $ticket )
            <tr>
                @if($ticket->dependent_id == null)
                <td>{{ $ticket->user_id }}</td>
                <td>{{ $ticket->user->name }}</td>
                @else
                <td>{{ $ticket->dependent_id }}</td>
                <td>{{ $ticket->dependent->name }}</td>
                @endif

                <td>{{ $ticket->id}}</td>
                <td>{{ $ticket->status }}</td>
                @if($ticket->type=='match')
                <td>{{ $ticket->department->price }}</td>
                @else
                    <td>{{ $ticket->price }}</td>
                @endif
                <td>{{ $ticket->refund_date }}</td>


                @if($ticket->refund_date != null &&$ticket->type=='match')
                <td>{{ $ticket->department->price * 0.9 }}</td>
                @elseif($ticket->refund_date != null &&$ticket->type=='bus')
                <td>{{ $ticket->price * 0.9 }}</td>
                @else
                <td></td>
                 @endif






            </tr>
            @endforeach
            <!--this is emp row-->
          </tbody>
        </table>
      </div>
    </div>
</div>













@endsection


@endsection
