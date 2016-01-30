@extends('participant.layouts.app')

@section('content')

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Available exams
                    </div>
                    <div class="panel-body">
                        <div class="row"></div>
                        <div class="list-group">
                            @foreach($exams as $exam)
                                <a href="{{ route('participant.exam.view', ['exam' => $exam]) }}" class="list-group-item" style="height: auto; min-height: 150px">
                                    <div class="col-md-7">
                                        <h4 class="list-group-item-heading"> {{ $exam->getAttribute('name') }} </h4>
                                        <p class="list-group-item-text"> {{ $exam->getAttribute('description') }} </p>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        @if($exam->doesParticipantCompleteExam($participant))
                                            <h2>
                                                <span class="label label-primary">
                                                    {{ $participant->getExamStatusName($exam) }}
                                                </span>
                                            </h2>
                                            @if($participant->getParticipantExam($exam)->getAttribute('status') == \App\Models\ParticipantExam::STATUS_COMPLETED)
                                                <h4>
                                                    <span class="label label-info">
                                                        {{ $participant->getParticipantExam($exam)->getAttribute('score') }}
                                                    </span>
                                                </h4>
                                            @endif
                                        @else
                                            <h2><span class="label label-primary">Available</span></h2>
                                            Time: {{ $exam->getAttribute('time')/60 }} minutes <br>
                                            Level: <span class="label label-info"> {{ strtoupper($exam->getLevelName()) }} </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection