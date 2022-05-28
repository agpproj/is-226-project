@extends('dashboard.venue.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($venueOrg->venues as $venue)
                    <div style="padding: 15px">
                        <div class="card">
                            <form method="POST" action="{{ route('venue.edit', $venue->VenueID) }}">
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
                                <button type="submit" class="btn btn-primary" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                @csrf
                                <button type="submit" formaction="{{ route('venue.delete', $venue->VenueID) }}" class="btn btn-primary" class="btn btn-primary">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
