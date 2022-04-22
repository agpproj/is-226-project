@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.venue') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="venueName" class="col-md-4 col-form-label text-md-end">{{ __('Venue Name') }}</label>

                                <div class="col-md-6">
                                    <input id="venueName" type="text" class="form-control" name="venueName" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="maxCapacity" class="col-md-4 col-form-label text-md-end">{{ __('Max Capacity') }}</label>

                                <div class="col-md-6">
                                    <input id="maxCapacity" type="number" class="form-control" name="maxCapacity" autofocus>
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
