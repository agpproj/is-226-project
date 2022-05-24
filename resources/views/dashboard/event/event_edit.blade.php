<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Dashboard | Home</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" action="{{ route('event.update', $event->EventID) }}">
                        <div class="row mb-3">
                            <label for="eventName" class="col-md-4 col-form-label text-md-end">{{ __('Event Name') }}</label>

                            <div class="col-md-6">
                                <input id="eventName" type="text" class="form-control" name="eventName" autofocus value="{{$event->EventName}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="eventDescription" class="col-md-4 col-form-label text-md-end">{{ __('Event Description') }}</label>

                            <div class="col-md-6">
                                <input id="eventDescription" type="text" class="form-control" name="eventDescription" autofocus value="{{$event->EventDescription}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventStartDate" class="col-md-4 col-form-label text-md-end">{{ __('Event Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="eventStartDate" type="date" class="form-control" name="eventStartDate" autofocus value="{{$event->EventStartDate}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventEndDate" class="col-md-4 col-form-label text-md-end">{{ __('Event End Date') }}</label>

                            <div class="col-md-6">
                                <input id="eventEndDate" type="date" class="form-control" name="eventEndDate" autofocus value="{{$event->EventEndDate}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventStartTime" class="col-md-4 col-form-label text-md-end">{{ __('Event Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="eventStartTime" type="time" class="form-control" name="eventStartTime" autofocus value="{{$event->EventStartTime}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventEndTime" class="col-md-4 col-form-label text-md-end">{{ __('Event End Time') }}</label>

                            <div class="col-md-6">
                                <input id="eventEndTime" type="time" class="form-control" name="eventEndTime" autofocus value="{{$event->EventEndTime}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Ticket Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control" name="price" autofocus value="{{$event->PriceValue}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="allowedCapacity" class="col-md-4 col-form-label text-md-end">{{ __('Allowed Capacity') }}</label>

                            <div class="col-md-6">
                                <input id="allowedCapacity" type="number" class="form-control" name="allowedCapacity" autofocus value="{{$event->AllowedCapacity}}">
                            </div>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        <button type="submit" formaction="{{ route('event.my.events', Auth::user()->eventOrganizerID) }}" class="btn btn-primary">
                            {{ __('Cancel') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
