@extends('admin.layouts.app')

@section('content')

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">

                    <div class="col-lg-3">
                        @include('admin.exam.partials.menu')
                    </div>

                    <div class="col-lg-9">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Exams
                            </div>
                            <div class="panel-body">
                                @if(count($exams) > 0)
                                    <div class="list-group">
                                        @foreach($exams as $exam)

                                            <a href="{{ route('admin.exam.info', ['exam' => $exam]) }}" class="list-group-item">{{ $exam->getAttribute('name') }}</a>

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