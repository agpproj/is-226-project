@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @if($eventOrg->events->count() != 0)
                                @foreach($eventOrg->events as $event)
                                    <div style="padding: 20px">
                                        <div class="card">
                                            <div class="card-body">
                                                @csrf
                                                <div>
                                                    <label for="EventName" class="col-md-3 col-form-label ">
                                                        <h4>{{$event->EventName}}</h4>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label for="EventDescription" class=" col-form-label ">
                                                        <em>{{$event->EventDescription}}</em>
                                                    </label>
                                                </div>
                                                <div class="row mb-1 ">
                                                    <label for="EventStartDate" class="col-md-3 col-form-label ">{{ __('Start Date') }}</label>

                                                    <div class="col-md-3 col-form-label ">
                                                        {{$event->EventStartDate}}
                                                    </div>
                                                </div>
                                                <div class="row mb-1 ">
                                                    <label for="EventEndDate" class="col-md-3 col-form-label ">{{ __('End Date') }}</label>

                                                    <div class="col-md-3 col-form-label ">
                                                        {{$event->EventEndDate}}
                                                    </div>
                                                </div>
                                                <div class="row mb-1 ">
                                                    <label class="col-md-3 col-form-label ">{{ __('Time') }}</label>
                                                    <div class="col-md-3 col-form-label ">
                                                        {{ $event->EventStartTime }}{{ __(' - ') }}{{ $event->EventEndTime }}
                                                    </div>
                                                </div>
                                                <div class="row mb-1 ">
                                                    <label for="AllowedCapacity" class="col-md-3 col-form-label ">{{ __('Capacity') }}</label>

                                                    <div class="col-md-3 col-form-label ">
                                                        {{$event->AllowedCapacity}}
                                                    </div>
                                                </div>
                                                <div class="row mb-1 ">
                                                    <label for="PriceValue" class="col-md-3 col-form-label ">{{ __('Ticket Price') }}</label>

                                                    <div class="col-md-3 col-form-label ">
                                                        {{$event->ticket->PriceValue}}
                                                    </div>
                                                </div>
                                                @if ($event->EventStatus == 'Open')
                                                    <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary">
                                                        {{ __('Edit Event') }}
                                                    </button>
                                                    <button type="submit" formaction="{{ route('event.cancel', $event->EventID) }}" class="btn btn-primary">
                                                        {{ __('Cancel Event') }}
                                                    </button>
                                                    <button type="submit" formaction="{{ route('event.registered', $event->EventID) }}" class="btn btn-primary">
                                                        {{ __('Attendees') }}
                                                    </button>
                                                @else
                                                    <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary" disabled>
                                                        {{ __('Edit Event') }}
                                                    </button>
                                                    <button type="submit" formaction="{{ route('event.cancel', $event->EventID) }}" class="btn btn-primary" disabled>
                                                        {{ __('Cancel Event') }}
                                                    </button>
                                                    <button type="submit" formaction="{{ route('event.registered', $event->EventID) }}" class="btn btn-primary" disabled>
                                                        {{ __('Attendees') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h6>{{ __('No ticket purchased.') }}</h6>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
