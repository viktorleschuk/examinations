@extends('participant.layouts.app')

@section('content')

    <noscript><meta http-equiv="refresh" content="0; url=/no-js" /></noscript>
    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ $exam->getAttribute('name') }}</h4>
                    </div>
                    <div class="panel-body">
                        @include('participant.partials.success')
                        @include('participant.partials.errors')
                        @include('participant.partials.info')
                        <dl class="dl-horizontal">
                            <dt>Description</dt>
                            <dd>{{ $exam->getAttribute('description') }}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Level</dt>
                            <dd><span class="label label-primary">{{ strtoupper($exam->getLevelName()) }}</span></dd>
                        </dl>
                        @if($exam->doesParticipantCompleteExam($participant))
                            <dl class="dl-horizontal">
                                <dt>Status</dt>
                                <dd>
                                    <span class="label label-primary">{{ $participant->getExamStatusName($exam) }}</span>
                                </dd>
                            </dl>
                            @if($participant->getParticipantExam($exam)->getAttribute('status') == \App\Models\ParticipantExam::STATUS_COMPLETED)
                                <dl class="dl-horizontal">
                                    <dt>Score</dt>
                                    <dd>
                                        <span class="label label-info">{{ $participant->getParticipnatExam($exam)->getAttribute('score') }}</span>
                                    </dd>
                                </dl>
                            @endif
                        @else
                            <dl class="dl-horizontal">
                                <dt>Time</dt>
                                <dd>
                                    {{ $exam->getAttribute('time')/60 }} minutes
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Status</dt>
                                <dd>
                                    <span class="label label-primary">Available</span>
                                    <hr>
                                    <a href="#" data-toggle="modal" data-target="#passExamination" class="btn btn-success">Pass this Examination</a>
                                </dd>
                            </dl>
                        @endif
                        <div class="modal fade" id="passExamination">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" onsubmit="this.js_enabled.value=1;return true;" action="{{ route('participant.exam.start', ['exam' => $exam]) }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="js_enabled" value="0">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Pass exam</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="notice notice-danger">
                                                <strong>Attention!</strong> You must have enabled JS! <br />
                                                If you don't have enabled JS, you will not be able to passed exam!
                                            </div>
                                            <p class="list-group-item-text lead">
                                                When you're ready, press button!, timer will be started. <br>
                                                You have {{ $exam->getAttribute('time')/60 }} minutes to pass the exam.
                                            </p> <br>
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label" for="position">Chose desired position:</label>
                                                    <select class="form-control" id="position" name="position">
                                                        @foreach($exam->getAvailablePosition() as $index => $position)
                                                            <option value="{{ $index }}">{{ $position }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </fieldset>
                                            <hr />
                                            <button type="submit" class="btn btn-success">Pass examination</button>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection