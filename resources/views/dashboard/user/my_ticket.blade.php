@extends('dashboard.user.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="">
                    <div>
                        <h2>Registered Ticket</h2>
                    </div>
                    @if ($registeredEvents->count() != 0)
                        @foreach($registeredEvents as $event)
                            <div style="padding: 15px">
                                <div class="card">
                                    <div class="card-body">
                                        @csrf
                                        <div>
                                            <label for="EventName" class="col-md-3 col-form-label ">
                                                <h4>{{$event->EventName}}</h4>
                                            </label>
                                        </div>
                                        <div>
                                            <label for="EventDescription" class=" col-form-label ">
                                                <em>{{$event->EventDescription}}</em>
                                            </label>
                                        </div>
                                        <div class="row mb-1 ">
                                            <label for="EventStartDate" class="col-md-3 col-form-label ">{{ __('Start Date') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$event->EventStartDate}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 ">
                                            <label for="EventEndDate" class="col-md-3 col-form-label ">{{ __('End Date') }}</label>

                                            <div class="col-md-3 col-form-label ">
                                                {{$event->EventEndDate}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 ">
                                            <label class="col-md-3 col-form-label ">{{ __('Time') }}</label>
                                            <div class="col-md-3 col-form-label ">
                                                {{ $event->EventStartTime }}{{ __(' - ') }}{{ $event->EventEndTime }}
                                            </div>
                                        </div>
                                        <button type="submit" formaction="{{ route('user.cancel', $event->EventID) }}" class="btn btn-danger">
                                            {{ __('Cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <label for="EventName" class="col-md-3 col-form-label ">
                            <h6>{{ __('No Ticket Purchased') }}</h6>
                        </label>
                    @endif
                </form><hr/>
                <form method="POST" action="">
                    <div>
                        <h2>Attended Event for feedback</h2>
                    </div>
                    @if($scannedEvents->count() != 0)
                        @foreach($scannedEvents as $event)
                            @if($event->feedback == null)
                            <div style="padding: 15px">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="card-body">
                                            @csrf
                                            <div>
                                                <label for="EventName" class="col-md-3 col-form-label ">
                                                    <h4>{{$event->EventName}}</h4>
                                                </label>
                                            </div>
                                            <div>
                                                <label for="EventDescription" class=" col-form-label ">
                                                    <em>{{$event->EventDescription}}</em>
                                                </label>
                                            </div>

                                            <!-- Review store Section -->
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-10 mt-4 ">
                                                        <form class="py-2 px-4"  style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                                                            @csrf
                                                            <input type="hidden" name="post_id" value="{{$event->EventID}}">
                                                            <div class="row justify-content-end mb-1">
                                                                <div class="col-sm-8 float-right">
                                                                    @if(Session::has('flash_msg_success'))
                                                                        <div class="alert alert-success alert-dismissible p-2">
                                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                            <strong>Success!</strong> {!! session('flash_msg_success')!!}.
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <p class="font-weight-bold ">Review</p>

                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="rate">
                                                                        <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                                        <label for="star5" title="text">5 stars</label>
                                                                        <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                                                        <label for="star4" title="text">4 stars</label>
                                                                        <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                                        <label for="star3" title="text">3 stars</label>
                                                                        <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                                        <label for="star2" title="text">2 stars</label>
                                                                        <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                                        <label for="star1" title="text">1 star</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-4">
                                                                <div class="col-sm-12 ">
                                                                    <textarea class="form-control" name="feedback" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding: 15px">
                                                <button type="submit" formaction="{{ route('user.feedback', $event->EventID) }}" class="btn btn-primary">
                                                    {{ __('Submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <label for="EventName" class="col-md-3 col-form-label ">
                            <h6>{{ __('No more pending feedback request.') }}</h6>
                        </label>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
