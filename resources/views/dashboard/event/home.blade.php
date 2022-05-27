@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="margin-top: 45px">
                <h4>Event Organizer Dashboard</h4><hr>
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
                        <td>{{ Auth::guard('event')->user()->name }}</td>
                        <td>{{ Auth::guard('event')->user()->email }}</td>
                        <td>
                            <a href="{{ route('event.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form action="{{ route('event.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form method="POST" action="{{ route('event.list') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Book Venue') }}
                    </button>
                    <button type="submit" formaction="{{ route('event.contract', Auth::user()->eventOrganizerID) }}" class="btn btn-primary">
                        {{ __('Approved Venue') }}
                    </button>
                    <button type="submit" formaction="{{ route('event.my.events', Auth::user()->eventOrganizerID) }}" class="btn btn-primary">
                        {{ __('My Events') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
