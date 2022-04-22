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
                        <button type="submit" class="btn btn-primary">
                            {{ __('Edit') }}
                        </button>
                        <button type="submit" formaction="{{ route('delete.venue', $venue->VenueID) }}" class="btn btn-primary">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
