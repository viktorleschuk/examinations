@extends('participant.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    @include('participant.partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('participant.auth.postRegister') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="first_name">First name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="last_name">Last name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password_confirmation">Password confirmation</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="country">Country</label>
                            <div class="col-md-6">
                                <select class="form-control" id="country" name="country_id">
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="city">City</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone-number">Phone number</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="skype_name">Skype name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="skype_name" name="skype_name" value="{{ old('skype_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cv_file">CV file</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="cv_file" name="cv_file" accept="application/pdf" value="{{ old('cv_file') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
