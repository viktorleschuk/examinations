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
                                <h4>Check · "{{ $answer->question->exam->getAttribute('name') }}"</h4>
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.errors')
                                @include('admin.partials.error')

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.check.setScore', ['participantExam' => $participantExam, 'participantExamAnswer' => $answer]) }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="question">Question:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static"><strong>{{ $answer->question->getAttribute('title') }}</strong></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answer">Answer:</label>
                                        <div class="col-md-6">
                                            <textarea rows="5" class="form-control" disabled>{{ $answer->getAttribute('answer_body') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="score">Score</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.1" min="0" max="{{ $answer->question->getAttribute('weight') }}" class="form-control" name="score" id="score" value="{{ old('score', $answer->question->getAttribute('score')) }}" >
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-circle-o"></i> Next
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                            <div class="panel-footer text-center">
                                <nav>
                                    <?php $count = 1 ?>
                                    <ul class="pagination pagination-sm" style="margin: 0;">
                                        @foreach($answers as $answerItem)

                                            <li class="<?php echo ($answerItem->getKey() == $answer->getKey()) ? 'active' : '';?>">
                                                <a href="{{ route('admin.exam.getCheck', ['participantExam' => $participantExam, 'participantExamAnswer' => $answerItem]) }}">{{ $count++ }}</a>
                                            </li>

                                        @endforeach
                                    </ul>
                                </nav>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection