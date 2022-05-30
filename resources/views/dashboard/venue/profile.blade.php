@extends('dashboard.venue.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p>Name: {{$venueOrg->name}}</p>
                    <p>Email: {{$venueOrg->email}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
