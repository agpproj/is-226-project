@extends('dashboard.venue.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($venues as $venue)
                        <form method="POST" action="{{ route('event.book', $venue->VenueID) }}">
                            <h4>{{$venue->VenueID}} {{$venue->VenueName}}</h4>
                            <h6>{{$venue->MaxCapacity}}</h6>
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Book') }}
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
