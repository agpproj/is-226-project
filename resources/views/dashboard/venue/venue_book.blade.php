@extends('dashboard.venue.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($venues as $venue)
                        @foreach($venue->eventVenueContracts as $eventVenueContract)
                            @if ($eventVenueContract->ApprovalStatus === 'Pending')
                                <div style="padding: 15px">
                                    <div class="card">
                                        <form method="POST" action="{{ route('venue.approve', $eventVenueContract->ContractID) }}">
                                            <div class="row mb-1 ">
                                                <label for="BookStartDate" class="col-md-3 col-form-label ">{{ __('Book Start Date') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$eventVenueContract->BookStartDate}}
                                                </div>
                                            </div>
                                            <div class="row mb-1 ">
                                                <label for="BookEndDate" class="col-md-3 col-form-label ">{{ __('Book End Date') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$eventVenueContract->BookEndDate}}
                                                </div>
                                            </div>
                                            <div class="row mb-1 ">
                                                <label for="Time" class="col-md-3 col-form-label ">{{ __('Time') }}</label>

                                                <div class="col-md-3 col-form-label ">
                                                    {{$eventVenueContract->BookStartTime}}{{ __(' - ') }}{{$eventVenueContract->BookEndTime}}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="approvingPerson" class="col-md-3 col-form-label ">{{ __('Approving Person') }}</label>

                                                <div class="col-md-5">
                                                    <input id="approvingPerson" type="text" class="form-control" name="approvingPerson" autofocus >
                                                </div>
                                            </div>
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Approve') }}
                                            </button>
                                            <button type="submit" formaction="{{ route('venue.deny', $eventVenueContract->ContractID) }}" class="btn btn-primary">
                                                {{ __('Decline') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
