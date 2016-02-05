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
                                Exams
                                <a title="Create new exam" href="{{ route('admin.exam.create') }}" class="btn btn-default btn-xs pull-right" style="margin-right: 5px">
                                    + New exam
                                </a>
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.errors')
                                @include('admin.partials.success')

                                @if(count($exams) > 0)
                                    <div class="list-group">
                                        @foreach($exams as $exam)

                                            <a href="{{ route('admin.exam.view', ['exam' => $exam]) }}" class="list-group-item">{{ $exam->getAttribute('name') }} <span class="pull-right">{{ $exam->getAttribute('is_public') ? 'Published' : 'Not published' }}</span></a>

                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <strong>Info!</strong> No exams
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