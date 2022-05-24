<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Dashboard | Home</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            @foreach($eventOrg->events as $event)
                                @csrf
                                <h3>{{$event->EventName}}</h3>
                                <h6>{{$event->EventDescription}}</h6>
                                <h6>{{$event->EventStartDate}}</h6>
                                <h6>{{$event->EventEndDate}}</h6>
                                <h6>{{$event->EventStartTime}}</h6>
                                <h6>{{$event->EventEndTime}}</h6>
                                <h6>{{$event->AllowedCapacity}}</h6>
                                <h6>{{$event->PriceValue }}</h6>
                                <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary">
                                    {{ __('Edit Event') }}
                                </button>
                                <button type="submit" formaction="{{ route('event.home') }}" class="btn btn-primary">
                                    {{ __('Cancel Event') }}
                                </button>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
