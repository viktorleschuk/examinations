@extends('admin.layouts.app')

@section('content')

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
                                Question
                            </div>
                            <div class="panel-body">

                                <dl class="dl-horizontal">
                                    <dt>Question:</dt>
                                    <dd><p>{{ $question->getAttribute('title') }}</p></dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Weight:</dt>
                                    <dd><p>{{ $question->getAttribute('weight') }}</p></dd>
                                </dl>

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        @if($question->getAttribute('type') == App\Models\Question::TYPE_VARIOUS)

                                            @if(count($question->answers) > 0)
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th>Various</th>
                                                        <th>Correct</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($question->answers as $various)

                                                        <tr>
                                                            <td>{{ $various->getAttribute('title') }}</td>
                                                            <td align="center">@if($various->getAttribute('is_correct'))
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
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection