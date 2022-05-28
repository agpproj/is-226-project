@extends('dashboard.event.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($venues->count() != 0)
                    @foreach($venues as $venue)
                        <div style="padding: 15px">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('event.book', $venue->VenueID) }}">
                                        <div class="row mb-1 ">
                                            <label for="VenueName" class="col-md-3 col-form-label ">{{ __('Venue Name') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$venue->VenueName}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 ">
                                            <label for="MaxCapacity" class="col-md-3 col-form-label ">{{ __('Venue Capacity') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$venue->MaxCapacity}}
                                            </div>
                                        </div>
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Book') }}
                                        </button>
                                    </form>
                                </div>
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
