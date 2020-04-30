@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Add business hours
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.businessHours.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="attraction_id">Attraction</label>
                            <select class="form-control" id="attraction_id" name="attraction_id">
                                <option></option>
                                @foreach ($attractions as $attraction)
                                <option value="{{ $attraction->id }}" {{ (old('attraction_id') == $attraction->id) ? "selected" : "" }}>
                                    {{ $attraction->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="day">Day</label>
                            <select class="form-control" id="day" name="day">
                                <option></option>
                                <option value="1" {{ old('day') == 1 ? 'selected' : '' }}>Sunday</option>
                                <option value="2" {{ old('day') == 2 ? 'selected' : '' }}>Monday</option>
                                <option value="3" {{ old('day') == 3 ? 'selected' : '' }}>Tuesday</option>
                                <option value="4" {{ old('day') == 4 ? 'selected' : '' }}>Wednesday</option>
                                <option value="5" {{ old('day') == 5 ? 'selected' : '' }}>Thursday</option>
                                <option value="6" {{ old('day') == 6 ? 'selected' : '' }}>Friday</option>
                                <option value="7" {{ old('day') == 7 ? 'selected' : '' }}>Saturday</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="open_time">Open Time</label>
                            <input type="time" class="form-control" id="open_time" name="open_time" value="{{ old('open_time') }}" />
                        </div>

                        <div class="form-group">
                            <label for="close_time">Close Time</label>
                            <input type="time" class="form-control" id="close_time" name="close_time" value="{{ old('close_time') }}" />
                        </div>

                        <a href="{{ route('admin.attractions.index') }}" class="btn btn-link">Cancel</a>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
