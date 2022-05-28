@extends('dashboard.user.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <form method="POST" action="">
                        @foreach($events as $event)
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
                                        <div class="row mb-1 ">
                                            <label for="PriceValue" class="col-md-3 col-form-label ">{{ __('Ticket Price') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$event->ticket->PriceValue}}
                                            </div>
                                        </div>
                                        <button type="submit" formaction="{{ route('user.join', ['eventId'=>$event->EventID, 'userId'=>Auth::user()->id]) }}" class="btn btn-primary">
                                            {{ __('Join Event') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
