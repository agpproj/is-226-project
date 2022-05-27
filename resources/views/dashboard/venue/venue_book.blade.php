@extends('dashboard.venue.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                        @foreach($venues as $venue)
                            @foreach($venue->eventVenueContracts as $eventVenueContract)
                                @if ($eventVenueContract->ApprovalStatus === 'Pending')
                                    <form method="POST" action="{{ route('venue.approve', $eventVenueContract->ContractID) }}">
                                        <h4>{{$eventVenueContract}}</h4>
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Approve') }}
                                        </button>
                                        <button type="submit" formaction="{{ route('venue.deny', $eventVenueContract->ContractID) }}" class="btn btn-primary">
                                            {{ __('Decline') }}
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
