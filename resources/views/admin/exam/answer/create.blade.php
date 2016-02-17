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
                                @include('admin.partials.success')

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
                                                        <th style="text-align: center">Correct</th>
                                                    </tr>
                                                    <tr></tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($question->answers as $various)

                                                        <tr>
                                                            <td>{{ $various->getAttribute('title') }}</td>
                                                            <td align="center">@if($various->getAttribute('is_correct'))
                                                                    <i class="fa fa-check text-success"></i>
                                                                @else
                                                                    <i class="fa fa-times text-muted"></i>
                                                                @endif
                                                            </td>
                                                            <td><a href="{{ route('admin.exam.question.answer.delete', ['answer'    => $various]) }}">
                                                                    <i class="fa fa-trash-o text-danger "></i>
                                                                </a>
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

                                    <form class="form-inline" role="form" method="POST" action="{{ route('admin.exam.question.answer.store', ['exam' => $exam, 'question' => $question]) }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Various">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" value="1" name="is_correct">
                                                    Is correct
                                                </span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-check"></i> Create various
                                        </button>


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

{{--<form class="form-horizontal">--}}
    {{--<fieldset>--}}

        {{--<!-- Form Name -->--}}
        {{--<legend>Form Name</legend>--}}

        {{--<!-- Appended checkbox -->--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-4 control-label" for="appendedcheckbox">Appended Checkbox</label>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="input-group">--}}
                    {{--<input id="appendedcheckbox" name="appendedcheckbox" class="form-control" type="text" placeholder="placeholder">--}}
	                {{--<span class="input-group-addon">--}}
                        {{--<input type="checkbox">--}}
                    {{--</span>--}}
                {{--</div>--}}
                {{--<p class="help-block">help</p>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</fieldset>--}}
{{--</form>--}}
