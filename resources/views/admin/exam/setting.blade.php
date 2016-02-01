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
                                Setting
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.success')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="POST" action="{{ route('admin.exam.update', ['exam' => $exam]) }}">
                                            <fieldset>
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <label class="control-label" for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $exam['name']) }}" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control">{{ old('description', $exam['description']) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('admin.partials.errors')

                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                Publish
                            </div>
                            <div class="panel-body">
                                @if($exam->getAttribute('is_public'))
                                    This exam is published.

                                    <hr />

                                    <a href="{{ route('admin.exam.publishCancel', ['exam' => $exam]) }}" class="btn btn-warning">Cancel</a>
                                @else
                                    This exam not published.

                                    <hr />

                                    <a href="{{ route('admin.exam.publish', ['exam' => $exam]) }}" class="btn btn-warning">Publish</a>
                                @endif
                            </div>
                        </div>

                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                Delete exam
                            </div>
                            <div class="panel-body">
                                You may delete this exam. All of data of it would be deleted too. There is not way to restore any kind of related data.
                                <hr />

                                <a href="{{ route('admin.exam.delete', ['exam' => $exam]) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection