@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p>Name: {{$eventOrg->name}}</p>
                    <p>Email: {{$eventOrg->email}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
