@extends('admin.layouts.app')

@section('content')

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">

                    <div class="col-lg-3">
                        @include('admin.partials.menu')
                    </div>

                    <div class="col-lg-9">

                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <h4>Participant · edit</h4>
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.errors')

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.participant.update', ['participant' => $participant]) }}" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="first_name">First name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $participant->user->getAttribute('first_name')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="last_name">Last name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $participant->user->getAttribute('last_name')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="email">Email</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $participant->user->getAttribute('email')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="country">Country</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="country" name="country_id">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->getKey() }}" {{ old('country_id', $participant->country->getKey() == $country['id']) ? 'selected' : '' }}> {{ $country->getAttribute('name') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="city">City</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $participant->getAttribute('city')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="phone-number">Phone number</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $participant->getAttribute('phone_number')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="skype_name">Skype name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="skype_name" name="skype_name" value="{{ old('skype_name', $participant->getAttribute('skype_name')) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-user"></i>Update
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection