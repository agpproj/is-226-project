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
                    <div class="card-body">
                        <form method="POST" action="{{ route('event.store.contract', ['venueId'=>$id, 'eventOrgId'=>Auth::user()->eventOrganizerID]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="bookStartDate" class="col-md-4 col-form-label text-md-end">{{ __('Book Start Date') }}</label>

                                <div class="col-md-6">
                                    <input id="bookStartDate" type="date" class="form-control" name="bookStartDate" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bookEndDate " class="col-md-4 col-form-label text-md-end">{{ __('Book End Date') }}</label>

                                <div class="col-md-6">
                                    <input id="bookEndDate " type="date" class="form-control" name="bookEndDate" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bookStartTime  " class="col-md-4 col-form-label text-md-end">{{ __('Book Start Time') }}</label>

                                <div class="col-md-6">
                                    <input id="bookStartTime " type="time" class="form-control" name="bookStartTime" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bookEndTime   " class="col-md-4 col-form-label text-md-end">{{ __('Book End Time') }}</label>

                                <div class="col-md-6">
                                    <input id="bookEndTime " type="time" class="form-control" name="bookEndTime" autofocus>
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

</body>
</html>
