@extends('admin.layouts.app')

@section('content')

    <noscript><meta http-equiv="refresh" content="0; url=/no-js" /></noscript>

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">

                    <div class="col-lg-3">
                        @include('admin.exam.partials.exam-menu', ['exam' => $exam])
                    </div>

                    <div class="col-lg-9">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Questions
                                @if(!$exam->getAttribute('is_public'))
                                    <a title="Add new questions" href="{{ route('admin.exam.question.create', ['exam'  => $exam]) }}" class="btn btn-default btn-xs pull-right" style="margin-right: 5px">
                                        + New question
                                    </a>
                                @endif
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.success')

                                @if(count($exam->questions) > 0)


                                    @foreach($exam->questions as $index => $question)

                                        <?php $index++ ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <a href="{{ route('admin.exam.question.view', ['exam' => $exam, 'question' => $question]) }}">Question {{ $index }}</a>
                                                    <a class="pull-right" href="{{ route('admin.exam.question.delete', ['exam' => $exam, 'question' => $question]) }}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <a class="pull-right" style="margin-right: 5px" href="{{ route('admin.exam.question.edit', ['exam' => $exam, 'question' => $question]) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                <dl class="dl-horizontal">
                                                    <dt>Question:</dt>
                                                    <dd>{{ $question->getAttribute('title') }}</dd>
                                                </dl>

                                                <dl class="dl-horizontal">
                                                    <dt>Weight:</dt>
                                                    <dd>{{ $question->getAttribute('weight') }}</dd>
                                                </dl>

                                                <dl class="dl-horizontal">
                                                    <dt>Type:</dt>
                                                    <dd>{{ App\Models\Question::getTypeNameByIndex($question->getAttribute('type')) }}


                                                    @if($question->getAttribute('type') == App\Models\Question::TYPE_VARIOUS)

                                                            <hr />

                                                            @if(count($question->answers) > 0)
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Various</th>
                                                                            <th width="15%" align="center">Correct</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        @foreach($question->answers as $various)

                                                                            <tr>
                                                                                <td>{{ $various->getAttribute('title') }}</td>
                                                                                <td align="center">
                                                                                    @if($various->getAttribute('is_correct'))
                                                                                        <i class="fa fa-check"></i>
                                                                                    @else
                                                                                        <i class="fa fa-times"></i>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>

                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @else
                                                                <br><br><strong>Info!</strong> In the question, there are no various answer
                                                            @endif

                                                                <a title="Add new various answer" href="{{ route('admin.exam.question.answer.create', ['exam'  => $exam, 'question' => $question]) }}" class="btn btn-default btn-xs pull-right" style="margin-right: 5px">
                                                                    + New answer various
                                                                </a>

                                                        @endif
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>


                                    @endforeach

                                @else
                                    <div class="alert alert-info">
                                        <strong>Info!</strong> In the exam, there are no questions
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