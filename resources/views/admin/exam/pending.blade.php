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
                            <div class="panel-heading">
                                Pending exams
                            </div>
                            <div class="panel-body">
                                @if(count($exams) > 0)

                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam</th>
                                            <th>Participant</th>
                                            <th>Position</th>
                                            <th>CV file</th>
                                            <th>Start check</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($exams as $index => $exam)
                                            <?php $index++ ?>
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $exam->exam->getAttribute('name') }}</td>
                                                <td>{{ $exam->participant->user->getFullName() }}</td>
                                                <td>{{ $exam->getPositionName() }}</td>
                                                <td><a href="{{ route('admin.participants.cv', ['participant' => $exam->participant]) }}" target="_blank">download</a></td>
                                                <td><a href="{{ route('admin.exam.startCheck', ['participantExam' => $exam]) }}"><i class="fa fa-play"></i></a></td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    <div class="alert alert-info">
                                        <strong>Info!</strong> No pending exams
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection