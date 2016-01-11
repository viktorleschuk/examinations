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
                                Creating text question
                            </div>
                            <div class="panel-body">
                                @include('admin.partials.errors')

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.exam.question.postCreate', ['exam'  =>  $exam]) }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="title">Title</label>
                                        <div class="col-md-6">
                                            <textarea name="title" id="title" class="form-control" style="resize: vertical" rows="5">{{ old('title') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="weight">Weight</label>
                                        <div class="col-md-6">
                                            <input type="number" min="0" class="form-control" name="weight" id="weight" value="{{ old('weight') }}" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="type">Type</label>
                                        <div class="col-md-6">
                                            <select name="type" id="type" class="form-control">
                                                <option value="text">Text</option>
                                                <option value="various">Various</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-check"></i>Create
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

@endsection