@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('event.create') }}">
                    @if($events->count() != 0)
                        @foreach($events as $event)
                            @if ($event->ApprovalStatus === 'Approved')
                                <div style="padding: 15px">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <div class="row mb-1 ">
                                                <label for="BookStartDate" class="col-md-3 col-form-label ">{{ __('Book Start Date') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$event->BookStartDate}}
                                                </div>
                                            </div>
                                            <div class="row mb-1 ">
                                                <label for="BookEndDate" class="col-md-3 col-form-label ">{{ __('Book End Date') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$event->BookEndDate}}
                                                </div>
                                            </div>
                                            <div class="row mb-1 ">
                                                <label for="AllowedCapacity" class="col-md-3 col-form-label ">{{ __('Capacity') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$event->ApprovalStatus}}
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Create Event') }}
                                            </button>
                                        </div>
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
@endsection
