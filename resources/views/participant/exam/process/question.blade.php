@extends('participant.layouts.app')

@section('content')

    <noscript><meta http-equiv="refresh" content="0; url=/no-js" /></noscript>
    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Question
                    </div>
                    <form onsubmit="this.jquery_enabled.value=checkJQuery();return true;" class="form-horizontal" role="form" method="POST" action="{{ route('participant.exam.handleQuestion', ['exam' => $exam, 'question' => $question]) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="jquery_enabled" value="0">
                        <div class="panel-body">

                            @include('participant.partials.errors')

                            <fieldset>
                            @if($question->getAttribute('type') == \App\Models\Question::TYPE_TEXT)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Question</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $question->getAttribute('title') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answer">Answer</label>
                                        <div class="col-md-6">
                                            <textarea name="answer" id="answer" class="form-control" style="resize: vertical" rows="5">{{ old('answer', $previous != null ? $previous->getAttribute('answer_body') : '') }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Question</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $question->getAttribute('title') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answer">Various</label>
                                        <div class="col-md-6">
                                            @foreach($question->answers as $answer)
                                                <div class="radio">
                                                <label><input type="radio" name="answer" value="{{ $answer->getKey() }}" <?php if ($previous != null) { echo $previous->getAttribute('answer_id') == $answer->getKey() ? 'checked' : ''; }?>>  {{ $answer->getAttribute('title') }}</label><br>
                                                    </div>
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
                                <ul class="pagination pagination-sm" style="margin: 0;">
                                    @foreach($exam->questions as $questionItem)

                                        <li class="<?php echo ($questionItem->getKey() == $question->getKey()) ? 'active' : '';?>">
                                            <a class="jump" href="{{ route('participant.exam.process.question', ['exam' => $exam, 'question' => $questionItem]) }}">{{ $count++ }}</a>
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

@section('scripts')

    <script src="{{ asset('assets/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>

    <script>
        $(function () {
            var time = {{ $time }};
            $('#timer').countdown({until: time, expiryUrl: '{{ route('participant.exam.timeOver', ['exam' => $exam]) }}',
                layout: '{hn}:{mn}:{sn}'});
        });

        function checkJQuery() {
            return (typeof jQuery != 'undefined');
        }

        $("a.jump").click(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('participant.exam.answer.save-time', ['exam' => $exam, 'question' => $question]) }}"
            });

            return true;
        });
    </script>
@endsection

