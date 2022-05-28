@extends('dashboard.event.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Total number of participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$count}}</h5>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Percentage of registered participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$registeredPercentage}} {{ __('%') }}</h5>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Percentage of attended participants') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$scannedPercentage}} {{ __('%') }}</h5>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="count" class="col-md-5 col-form-label ">{{ __('Total number of expired tickets') }}</label>

                                <div class="col-md-2 col-form-label ">
                                    <h5>{{$expiredCount}}</h5>
                                </div>
                            </div>

                            @foreach($purchases as $purchase)
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
                                                <tr>
                                                    <td>{{ $purchase->purchaseID }}</td>
                                                    <td>{{ $purchase->TicketID }}</td>
                                                    <td>
                                                        @if ($purchase->statusID == 'Registered')
<!--                                                            <a href="{{ route('event.attendance', $purchase->purchaseID) }}" onclick="event.preventDefault();document.getElementById('attendance').submit();">Confirm attendance</a>
                                                            <form action="{{ route('event.attendance', $purchase->purchaseID) }}" method="post" class="d-none" id="attendance">@csrf</form>-->
                                                            <button type="submit" formaction="{{ route('event.attendance', $purchase->purchaseID) }}" class="d-none">
                                                                {{ __('Confirm Attendance') }}
                                                            </button>
                                                        @else
                                                            {{ __('Attendance Confirmed') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
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
