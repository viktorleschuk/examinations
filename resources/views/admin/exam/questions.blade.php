@extends('admin.layouts.app')

@section('content')

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">

                    <div class="col-lg-3">
                        @include('admin.exam.partials.exam_menu', ['exam' => $exam])
                    </div>

                    <div class="col-lg-9">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Questions
                                <a title="Add new questions" href="{{ route('admin.exam.question.create', ['exam'  => $exam]) }}" class="btn btn-default btn-xs pull-right" style="margin-right: 5px">
                                    + New question
                                </a>
                            </div>
                            <div class="panel-body">

                                @if(count($exam->questions) > 0)

                                    <?php $counter = 1 ?>

                                    @foreach($exam->questions as $question)

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Question {{ $counter++ }}
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
                                                    <dd>{{ App\Models\Question::getTypeNameByIndex($question->getAttribute('type')) }}</dd>
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