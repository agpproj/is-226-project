<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venue Organizer Dashboard | Home</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">-->
</head>
<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($venueOrg->venues as $venue)
                        <form method="POST" action="{{ route('venue.edit', $venue->VenueID) }}">
                            <h4>{{$venue->VenueID}} {{$venue->VenueName}}</h4>
                            <h6>{{$venue->MaxCapacity}}</h6>
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('venue.delete', $venue->VenueID) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        {{--@if ($venue->venueOrganizerID === Auth::user()->venueOrganizerID)
                            <form method="POST" action="{{ route('venue.edit', $venue->VenueID) }}">
                                <h4>{{$venue->VenueID}} {{$venue->VenueName}}</h4>
                                <h6>{{$venue->MaxCapacity}}</h6>
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('venue.delete', $venue->VenueID) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
