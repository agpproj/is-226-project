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
                                    <button type="submit" formaction="{{ route('user.cancel', $event->EventID) }}" class="btn btn-primary">
                                        {{ __('Cancel') }}
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
