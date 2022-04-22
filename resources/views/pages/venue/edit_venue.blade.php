@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" action="{{ route('update.venue', $venue->VenueID) }}">
                        <div class="row mb-3">
                            <label for="venueName" class="col-md-4 col-form-label text-md-end">{{ __('Venue Name') }}</label>

                            <div class="col-md-6">
                                <input id="venueName" type="text" class="form-control" name="venueName" autofocus value="{{$venue->VenueName}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="maxCapacity" class="col-md-4 col-form-label text-md-end">{{ __('Max Capacity') }}</label>

                            <div class="col-md-6">
                                <input id="maxCapacity" type="number" class="form-control" name="maxCapacity" autofocus value="{{$venue->MaxCapacity}}">
                            </div>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
