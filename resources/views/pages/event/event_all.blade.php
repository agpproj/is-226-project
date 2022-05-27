@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($events as $event)
                        <form method="POST" action="{{ route('show.event', $event->EventID) }}">
                            <h4>{{$event->EventName}}</h4>
                            <h6>{{$event->EventStartDate}}, {{$event->EventStartTime}}</h6>
                            <p>{{$event->EventDescription}}</p>
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('View') }}
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
