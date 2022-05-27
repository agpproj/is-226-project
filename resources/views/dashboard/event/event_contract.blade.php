@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('event.create') }}">
                            @foreach($events as $event)
                                @if ($event->ApprovalStatus === 'Approved')
                                    @csrf
                                    <h6>{{$event->BookStartDate}}</h6>
                                    <h6>{{$event->ApprovalStatus}}</h6>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create Event') }}
                                    </button>
                                @endif
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
