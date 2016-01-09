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
                                Panel head ...
                            </div>
                        	<div class="panel-body">
                        	   Panel body ...
                        	</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection