@extends('dashboard.venue.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row mb-1 ">
                    <label for="EventCount" class="col-md-4 col-form-label ">
                        <h5>{{ __('Number of Events booked') }}</h5>
                    </label>
                    <div class="col-md-3 col-form-label ">
                        <h5><b>{{$count}}</b></h5>
                    </div>
                </div>
                @foreach($eventVenueContracts as $eventVenueContract)
                    <div style="padding: 15px">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="row mb-1 ">
                                        <label for="EventName" class="col-md-3 col-form-label ">{{ __('Event Name') }}</label>

                                        <div class="col-md-3 col-form-label ">
                                            <b>{{$eventVenueContract->EventName}}</b>
                                        </div>
                                    </div>
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
                                        <label for="approvingPerson" class="col-md-3 col-form-label ">{{ __('Approval Status') }}</label>

                                        <div class="col-md-3 col-form-label ">
                                            {{$eventVenueContract->ApprovalStatus}}
                                        </div>
                                    </div>
                                    @if($eventVenueContract->ApprovalStatus == 'Approved')
                                        <div class="row mb-3">
                                            <label for="approvingPerson" class="col-md-3 col-form-label ">{{ __('Approving Person') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$eventVenueContract->ApprovingPerson}}
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
