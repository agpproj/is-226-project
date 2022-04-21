@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.event') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="eventName" class="col-md-4 col-form-label text-md-end">{{ __('Event Name') }}</label>

                                <div class="col-md-6">
                                    <input id="eventName" type="text" class="form-control" name="eventName" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="eventDescription" class="col-md-4 col-form-label text-md-end">{{ __('Event Description') }}</label>

                                <div class="col-md-6">
                                    <input id="eventDescription" type="text" class="form-control" name="eventDescription" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="eventStartDate" class="col-md-4 col-form-label text-md-end">{{ __('Event Start Date') }}</label>

                                <div class="col-md-6">
                                    <input id="eventStartDate" type="date" class="form-control" name="eventStartDate" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="eventEndDate" class="col-md-4 col-form-label text-md-end">{{ __('Event End Date') }}</label>

                                <div class="col-md-6">
                                    <input id="eventEndDate" type="date" class="form-control" name="eventEndDate" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="eventStartTime" class="col-md-4 col-form-label text-md-end">{{ __('Event Start Time') }}</label>

                                <div class="col-md-6">
                                    <input id="eventStartTime" type="time" class="form-control" name="eventStartTime" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="eventEndTime" class="col-md-4 col-form-label text-md-end">{{ __('Event End Time') }}</label>

                                <div class="col-md-6">
                                    <input id="eventEndTime" type="time" class="form-control" name="eventEndTime" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="allowedCapacity" class="col-md-4 col-form-label text-md-end">{{ __('Allowed Capacity') }}</label>

                                <div class="col-md-6">
                                    <input id="allowedCapacity" type="number" class="form-control" name="allowedCapacity" autofocus>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
