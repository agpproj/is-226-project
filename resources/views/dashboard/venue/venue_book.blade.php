<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venue Book Dashboard</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">-->
</head>
<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                        @foreach($venues as $venue)
                            @foreach($venue->eventVenueContracts as $eventVenueContract)
                                @if ($eventVenueContract->ApprovalStatus === 'Pending')
                                    <form method="POST" action="{{ route('venue.approve', $eventVenueContract->ContractID) }}">
                                        <h4>{{$eventVenueContract}}</h4>
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Approve') }}
                                        </button>
                                        <button type="submit" formaction="{{ route('venue.deny', $eventVenueContract->ContractID) }}" class="btn btn-primary">
                                            {{ __('Decline') }}
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        @endforeach

                    {{--@if (!$venues->eventVenueContracts->isEmpty())
                        @foreach($venues->eventVenueContracts as $eventVenueContract)
                            --}}{{--}}{{--<!--                        <form method="POST" action="{{ route('event.create', $venue->VenueID) }}">-->--}}{{--
                            <form action="">
                                <h4>{{$eventVenueContract->BookStartDate}} {{$eventVenueContract->BookEndDate}}</h4>
                                <h6>{{$eventVenueContract->ApprovalStatus}}</h6>
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Approve') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Decline') }}
                                </button>
                            </form>
                        @endforeach
                    @else
                        <form action="">
                            {{ __('No Request') }}
                        </form>
                    @endif--}}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
