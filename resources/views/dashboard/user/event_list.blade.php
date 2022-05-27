@extends('dashboard.user.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            @foreach($events as $event)
                                <div class="card-body">
                                    @csrf
                                    <h3>{{$event->EventName}}</h3>
                                    <h6>{{$event->EventDescription}}</h6>
                                    <h6>{{$event->EventStartDate}}</h6>
                                    <h6>{{$event->EventEndDate}}</h6>
                                    <h6>{{$event->EventStartTime}}</h6>
                                    <h6>{{$event->EventEndTime}}</h6>
                                    <h6>{{$event->AllowedCapacity}}</h6>
                                    <h6>{{$event->PriceValue }}</h6>
                                    <button type="submit" formaction="{{ route('user.join', ['eventId'=>$event->EventID, 'userId'=>Auth::user()->id]) }}" class="btn btn-primary">
                                        {{ __('Join Event') }}
                                    </button>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
