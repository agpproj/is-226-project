@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <label>Name: </label>
                    <input type="text" value="{{$event->EventName}}">
                </div>
            </div>
        </div>
    </div>

@endsection
