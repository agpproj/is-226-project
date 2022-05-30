@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row mb-1 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Total number of participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$count}}</h5>
                                </div>
                            </div>
                            <div class="row mb-1 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Percentage of registered participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$registeredPercentage}} {{ __('%') }}</h5>
                                </div>
                            </div>
                            <div class="row mb-1 ">
                                <label for="scannedPercentage" class="col-md-5 col-form-label ">{{ __('Percentage of attended participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$scannedPercentage}} {{ __('%') }}</h5>
                                </div>
                            </div>
                            <div class="row mb-1 ">
                                <label for="invalidCount" class="col-md-5 col-form-label ">{{ __('Total number of invalid tickets') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$invalidCount}}</h5>
                                </div>
                            </div>
                            <div class="row mb-1 ">
                                <label for="expiredCount" class="col-md-5 col-form-label ">{{ __('Total number of expired tickets') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$expiredCount}}</h5>
                                </div>
                            </div>

                            @if($purchases->count() != 0)
                                <div style="padding: 20px">
                                    <div class="card">
                                        <div class="card-body">
                                            @csrf
                                            <table class="table table-striped table-inverse table-responsive">
                                                <thead class="thead-inverse">
                                                <tr>
                                                    <th>Purchase ID</th>
                                                    <th>Ticket ID</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($purchases as $purchase)


                                                    <tr>
                                                        <td>{{ $purchase->purchaseID }}</td>
                                                        <td>{{ $purchase->TicketID }}</td>
                                                        <td>
                                                            @if ($purchase->statusID == 'Registered')
                                                                <button type="submit" formaction="{{ route('event.attendance', $purchase->purchaseID) }}" class="btn btn-link">
                                                                    {{ __('Confirm Attendance') }}
                                                                </button>
                                                            @else
                                                                {{ __('Attendance Confirmed') }}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
