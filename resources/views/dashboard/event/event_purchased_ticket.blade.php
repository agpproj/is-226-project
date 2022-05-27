@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-4 col-form-label text-md-end">{{ __('Total number of participants') }}</label>

                                <div class="col-md-1 col-form-label text-md-end">
                                    {{$count}}
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-4 col-form-label text-md-end">{{ __('Percentage of registered participants') }}</label>

                                <div class="col-md-1 col-form-label text-md-end">
                                    {{$registeredPercentage}}
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-4 col-form-label text-md-end">{{ __('Percentage of attended participants') }}</label>

                                <div class="col-md-1 col-form-label text-md-end">
                                    {{$scannedPercentage}}
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-4 col-form-label text-md-end">{{ __('Total number of expired tickets') }}</label>

                                <div class="col-md-1 col-form-label text-md-end">
                                    {{$expiredCount}}
                                </div>
                            </div>

                            @foreach($purchases as $purchase)
                                <div style="padding: 20px">
                                <div class="card">
                                    <div class="card-body">
                                        @csrf
                                        <h3>{{$purchase->purchaseID}}</h3>
                                        <h6>{{$purchase->userID}}</h6>
                                        <h6>{{$purchase->TicketID}}</h6>
                                        @if ($purchase->statusID == 'Registered')
                                            <button type="submit" formaction="{{ route('event.attendance', $purchase->purchaseID) }}" class="btn btn-primary">
                                                {{ __('Confirm attendance') }}
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-primary" disabled>
                                                {{ __('Confirm attendance') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
