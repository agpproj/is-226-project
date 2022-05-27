@extends('dashboard.user.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div>
                                <h2>Registered Ticket</h2>
                            </div>
                            @foreach($registeredEvents as $event)
                                <div class="card-body">
                                    @csrf
                                    <h3>{{$event->EventName}}</h3>
                                    <button type="submit" formaction="{{ route('user.cancel', $event->EventID) }}" class="btn btn-primary">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            @endforeach
                        </form>
                        <form method="POST" action="">
                            <div>
                                <h2>Attended Event for feedback</h2>
                            </div>
                            @foreach($scannedEvents as $event)
                                <div class="card-body">
                                    @csrf
                                    <h3>{{$event->EventName}}</h3>
                                    <div class="row mb-3">
                                        <label for="feedback" class="col-md-4 col-form-label text-md-end">{{ __('Feedback') }}</label>

                                        <div class="col-md-6">
                                            <input id="feedback" type="text" class="form-control" name="feedback" autofocus >
                                        </div>
                                    </div>
                                    <button type="submit" formaction="{{ route('user.feedback', $event->EventID) }}" class="btn btn-primary">
                                        {{ __('Feedback') }}
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
