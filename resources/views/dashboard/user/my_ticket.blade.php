@extends('dashboard.user.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="">
                    <div>
                        <h2>Registered Ticket</h2>
                    </div>
                    @if ($registeredEvents->count() != 0)
                        @foreach($registeredEvents as $event)
                            <div style="padding: 15px">
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
                                        <button type="submit" formaction="{{ route('user.cancel', $event->EventID) }}" class="btn btn-primary">
                                            {{ __('Cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <label for="EventName" class="col-md-3 col-form-label ">
                            <h6>{{ __('No Ticket Purchased') }}</h6>
                        </label>
                    @endif
                </form><hr/>
                <form method="POST" action="">
                    <div>
                        <h2>Attended Event for feedback</h2>
                    </div>
                    @if($scannedEvents->count() != 0)
                        @foreach($scannedEvents as $event)
                            @if($event->feedback->feedback == null)
                                <div style="padding: 15px">
                                    <div class="card">
                                        <div class="card-body">

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
                                                <div class="row mb-3">
                                                    <label for="feedback" class="col-md-4 col-form-label text-md-end">{{ __('Feedback') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="feedback" type="text" class="form-control" name="feedback" autofocus >
                                                    </div>
                                                </div>
                                                <button type="submit" formaction="{{ route('user.feedback', $event->EventID) }}" class="btn btn-primary">
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <label for="EventName" class="col-md-3 col-form-label ">
                            <h6>{{ __('No more pending feedback request.') }}</h6>
                        </label>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
