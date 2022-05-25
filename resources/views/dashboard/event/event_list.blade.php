@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @foreach($eventOrg->events as $event)
                                <div style="padding: 20px">
                                <div class="card">
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
                                    @if ($event->EventStatus == 'Open')
                                        <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary">
                                            {{ __('Edit Event') }}
                                        </button>
                                        <button type="submit" formaction="{{ route('event.cancel', $event->EventID) }}" class="btn btn-primary">
                                            {{ __('Cancel Event') }}
                                        </button>
                                    @else
                                        <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary" disabled>
                                            {{ __('Edit Event') }}
                                        </button>
                                        <button type="submit" formaction="{{ route('event.cancel', $event->EventID) }}" class="btn btn-primary" disabled>
                                            {{ __('Cancel Event') }}
                                        </button>

                                    @endif
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
