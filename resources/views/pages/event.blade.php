@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($events as $event)
                        <h4>{{$event->EventName}}</h4>
                        <h6>{{$event->EventStartDate}}, {{$event->EventStartTime}}</h6>
                        <p>{{$event->EventDescription}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
