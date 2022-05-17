<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venue Organizer Dashboard | Home</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">-->
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('venue.store', Auth::user()->venueOrganizerID) }}">
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
</body>
</html>
