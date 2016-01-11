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
                                Creating answer various
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.errors')

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

                                        @endif
                                    </div>
                                </div>

                                <hr/>

                                <div class="col-md-offset-2">

                                    <form class="form-inline" role="form" method="POST" action="{{ route('admin.exam.question.answer.postCreate', ['exam' => $exam, 'question' => $question]) }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label class="sr-only" for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" >
                                        </div>

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="is_correct"> Correct
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-check"></i>Create various
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
    </div>

@endsection