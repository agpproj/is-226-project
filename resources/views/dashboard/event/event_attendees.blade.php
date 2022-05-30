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
                                    @if ($event->EventStatus == 'Open')
                                            <button type="submit" formaction="{{ route('event.edit', $event->EventID) }}" class="btn btn-primary">
                                                {{ __('Track ') }}
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
