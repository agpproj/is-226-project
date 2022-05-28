@extends('dashboard.venue.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 45px">
            <h4>Venue Organizer Dashboard</h4><hr>
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
