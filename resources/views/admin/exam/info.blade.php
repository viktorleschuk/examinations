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
                                Info
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.success')

                                <dl class="dl-horizontal">
                                    <dt>Exam name</dt>
                                    <dd>{{ $exam->getAttribute('name') }}</dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Description</dt>
                                    <dd>{{ $exam->getAttribute('description') }}</dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Status</dt>
                                    <dd>@if($exam->getAttribute('is_public'))
                                            Public
                                        @else
                                            Not publicated
                                        @endif
                                    </dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Time</dt>
                                    <dd>{{ $exam->getAttribute('time') }} minutes</dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Level</dt>
                                    <dd>{{ App\Models\Exam::getLevelNameByIndex($exam->getAttribute('level')) }}</dd>
                                </dl>

                                <dl class="dl-horizontal">
                                    <dt>Question count</dt>
                                    <dd>{{ count($exam->questions) }}</dd>
                                </dl>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection