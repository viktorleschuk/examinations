@extends('admin.layouts.app')

@section('content')

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Question
                    </div>
                    <form onsubmit="this.time.value=getTime();this.jquery_enabled.value=checkJQuery();return true;" class="form-horizontal" role="form" method="POST" action="{{ route('participant.exam.handleQuestion', ['exam' => $exam, 'question' => $question]) }}">
                        {!! csrf_field() !!}
                        <div class="panel-body">

                            @include('participant.partials.errors')

                            <fieldset>
                            @if($question->getAttribute('type') == \App\Models\Question::TYPE_TEXT)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Question</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static lead">{{ $question->getAttribute('title') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answer">Answer</label>
                                        <div class="col-md-6">
                                            <textarea name="answer" id="answer" class="form-control" style="resize: vertical" rows="5">{{ old('answer') }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Question</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static lead">{{ $question->getAttribute('title') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answer">Various</label>
                                        <div class="col-md-6">
                                            @foreach($question->answers as $answer)
                                                <label><input type="radio" name="answer" value="{{ $answer->getKey() }}">  {{ $answer->getAttribute('title') }}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </fieldset>
                            <div class="label label-warning" id="timer" style="font-size: 23px"></div>
                            <button type="submit" class="btn btn-primary pull-right">
                                Next question  <i class="fa fa-btn fa-arrow-right"></i>
                            </button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-footer text-center">
                            <nav>
                                <?php $count = 1 ?>
                                <ul class="pagination pagination-sm">
                                    @foreach($exam->questions as $questionItem)

                                        <li class="<?php echo ($questionItem->getKey() == $question->getKey()) ? 'active' : '';?>">
                                            <a href="{{ route('participant.exam.process.question', ['exam' => $exam, 'question' => $questionItem]) }}">{{ $count++ }}</a>
                                        </li>

                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection


