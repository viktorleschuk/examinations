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
                                Creating exam
                            </div>
                            <div class="panel-body">

                                @include('admin.partials.errors')

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.exam.store') }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">Description</label>
                                        <div class="col-md-6">
                                            <textarea name="description" id="description" style="resize: none" class="form-control" rows="5">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="time">Time (minutes)</label>
                                        <div class="col-md-6">
                                            <input type="number" step="any" min="0" class="form-control" name="time" id="time" value="{{ old('time') }}" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="level">Level</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="level" id="level">
                                                @foreach(\App\Models\Exam::getAvailableLevels() as $value => $level)
                                                    <option value="{{ $value }}" {{ old('level', 1) == $value ? ' selected' : '' }}>{{ $level }}</option>
                                                @endforeach
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