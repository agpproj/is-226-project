@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in now!') }}
                        <form method="POST" action="{{ route('createEvent') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Event') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('events') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('All Events') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('venues') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('All Venues') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('create.venue') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Venues') }}
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
