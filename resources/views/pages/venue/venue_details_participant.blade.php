@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" action="{{ route('edit.venue', $venue->VenueID) }}">
                        <h4>{{$venue->VenueName}}</h4>
                        <h6>{{$venue->MaxCapacity}}</h6>
                        @csrf
                        <form method="POST" action="{{ route('createEvent') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Event') }}
                            </button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
