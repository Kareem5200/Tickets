@extends('layouts.app')
@section('title')
<title>Payment</title>
@endsection

@section('content')
<div>
<iframe style="width: 100%;height: 100vh;" src="https://accept.paymob.com/api/acceptance/iframes/794773?payment_token={{ $payment_token }}&match_id=22"></iframe>
</div>


@if(session('success'))
<div class="text-center">
<form action="{{ route('user.createTickets',$match_id,$tickets) }}" method="POST">
    <button type="submit" class="alert alert-success">create tickets</button>
</form>
</div>
@else

@endif


@endsection
