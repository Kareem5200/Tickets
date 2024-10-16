@extends('layouts.dashboard')

@section('title')
<title>Control fan status</title>
@endsection


@section("content")


<div class="dashboard_content">
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <h1>Manage Fans</h1>
            @if (session('bannedUntilDateError'))
            <div class="alert alert-danger">
                {{session('bannedUntilDateError') }}
            </div>

            @endif

            <input class="searchField" type="text" id="searchInput" placeholder=" Search by name or ID " />
        </div>
        <div class="row">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Change Status Here</th>
                        <th scope="col">Tickets of fan</th>
                        <th scope="col">Fan Information</th>
                    </tr>
                </thead>
                <tbody>
                    <!--this is fan row-->
                    @foreach ($allUsers as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <form action="{{ route('admin.changeFanStatus',$user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select class="statusSelect" name="status" required>
                                    <option value="">Change Status</option>
                                    <option value="allowed">Allowed</option>
                                    <option value="panned">Banned</option>
                                </select>
                                <input class="satusDate" type="date" name="panned_until" id="" />
                                <button class="SaveStatusBtn" type="submit">
                                    Save
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.getTickets',$user->id) }}">
                                <button class="SaveStatusBtn" type="submit">
                                    Tickets
                                </button>
                            </form>
                        </td>
                        <td> <a class=" btn text-primary" href="{{ route('admin.fanProfile',$user->id) }}">Go to Profile <i
                                    class="fa-solid fa-arrow-right"></i></a> </td>
                    </tr>
                    @endforeach
                    <!--this is fan row-->
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>



@endsection
