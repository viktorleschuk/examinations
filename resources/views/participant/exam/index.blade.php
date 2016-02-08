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

                        @include('participant.partials.successPa')

                        <div class="list-group">
                            @foreach($exams as $exam)
                                <a href="{{ route('participant.exam.view', ['exam' => $exam]) }}" class="list-group-item clearfix" style="height: auto; min-height: 100px">
                                    <div class="col-md-7">
                                        <h4 class="list-group-item-heading"> {{ $exam->getAttribute('name') }} </h4>
                                        <p class="list-group-item-text"> {{ $exam->getAttribute('description') }} </p>
                                    </div>
                                    <br>
                                    <div class="col-md-5 text-center">
                                        @if($exam->doesParticipantCompleteExam($participant))
                                                Status: <span class="label label-primary">
                                                    {{ $participant->getExamStatusName($exam) }}
                                                </span>
                                                <br>
                                            @if($participant->getParticipantExam($exam)->getAttribute('status') == \App\Models\ParticipantExam::STATUS_COMPLETED)
                                                    <span class="label label-info">
                                                       Score: {{ $participant->getParticipantExam($exam)->getAttribute('score') }} / {{ $exam->getTotalWeight() }}
                                                    </span>
                                                    <br>
                                            @endif
                                        @else
                                            Status: <span class="label label-primary">Available</span>
                                            <br>
                                            <span style="top: 5px;">Time: {{ number_format($exam->getAttribute('time')/60 , 2) }} minutes</span>
                                            <br>
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