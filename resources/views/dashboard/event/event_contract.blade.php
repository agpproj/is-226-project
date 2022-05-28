@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ route('event.create') }}">
                    @if($events->count() != 0)
                        @foreach($events as $event)
                            @if ($event->ApprovalStatus === 'Approved')
                                <div class="card">
                                    <div class="card-body">
                                        @csrf
                                        <h6>{{$event->BookStartDate}}</h6>
                                        <h6>{{$event->ApprovalStatus}}</h6>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create Event') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <h6>{{ __('No Venue requested.') }}</h6>
                    @endif
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
