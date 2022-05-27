@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p>Name: {{$user->name}}</p>
                    <p>Email: {{$user->email}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
