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
                                <h4>Participant</h4>
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.success')

                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <img src="{{ asset('/participant_avatar.png') }}" class="img-rounded img-responsive" />
                                        </div>
                                        <div class="col-sm-6 col-md-8">
                                            <h4>
                                                {{ $participant->user->getFullName() }}</h4>
                                            <small><cite>{{ $participant->getAttribute('city') }}, {{ $participant->country->getAttribute('code') }} <i class="fa fa-map-marker"></i>
                                                </cite></small>
                                            <p>
                                                <i class="fa fa-envelope"></i> <a href="mailto:{{ $participant->user->getAttribute('email') }}">{{ $participant->user->getAttribute('email') }}</a>
                                                <br />
                                                <i class="fa fa-skype"></i>  <a href="skype:{{ $participant->getAttribute('skype_name') }}?chat">{{ $participant->getAttribute('skype_name') }}</a>
                                                <br />
                                                <i class="fa fa-phone"></i>  {{ $participant->getAttribute('phone_number') }}
                                                <br />
                                                <i class="fa fa-calendar"></i>  {{ $participant->getAttribute('created_at')->toDayDateTimeString() }}</p>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Time</th>
                                        <th>Elapsed time</th>
                                        <th>Score</th>
                                        <th>Exam score</th>
                                        <th>Position</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $participant->load('participantExams', 'participantExams.exam'); ?>

                                    @foreach($participant->participantExams as $exam)

                                        <tr>
                                            <td>{{ $exam->exam->getAttribute('name') }}</td>
                                            <td>{{ $exam->getStatusName() }}</td>
                                            <td>{{ $exam->exam->getLevelName() }}</td>
                                            <td>{{ number_format($exam->exam->getAttribute('time' ) / 60, 2) }}</td>
                                            <td>{{ $exam->doesStatusInProcess() ? 'In process' : number_format($exam->getAttribute('elapsed_time') / 60, 2) }}</td>
                                            <td>{{ $exam->exam->getTotalWeight() }}</td>
                                            <td>{{ ($exam->doesStatusInProcess() || $exam->doesStatusPending()) ? $exam->getStatusName() : $exam->getAttribute('score') }}</td>
                                            <td>{{ $exam->getPositionName() }}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection