@extends('dashboard.venue.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 45px">
            <h4>Venue Organizer Dashboard</h4><hr>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ Auth::guard('venue')->user()->name }}</td>
                    <td>{{ Auth::guard('venue')->user()->email }}</td>
                    <td>
                        <a href="{{ route('venue.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{ route('venue.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                    </td>
                </tr>
                </tbody>
            </table>
            <form method="POST" action="{{ route('venue.create') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Create Venues') }}
                </button>
            </form>
            <form method="POST" action="{{ route('venue.name.list', Auth::user()->venueOrganizerID) }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('My Venues') }}
                </button>
            </form>
            <form method="POST" action="{{ route('venue.book.request', Auth::user()->venueOrganizerID) }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Booking Request') }}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
