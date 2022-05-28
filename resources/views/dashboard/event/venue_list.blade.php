@extends('dashboard.event.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($venues->count() != 0)
                    @foreach($venues as $venue)
                        <div style="padding: 15px">
                            <div class="card">
                                <form method="POST" action="{{ route('event.book', $venue->VenueID) }}">
                                    <h4>{{$venue->VenueID}} {{$venue->VenueName}}</h4>
                                    <h6>{{$venue->MaxCapacity}}</h6>
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Book') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h6>{{ __('No Venue available to book.') }}</h6>
                @endif

            </div>
        </div>
    </div>

@endsection
