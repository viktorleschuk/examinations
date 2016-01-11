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
                                Home
                            </div>
                        	<div class="panel-body">

                                @include('admin.partials.success')

                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a href="#"> <span class="badge pull-right">42</span> Home</a>
                                    </li>
                                    <li>
                                        <a href="#"> <span class="badge pull-right">16</span> More</a>
                                    </li>
                                </ul>
                        	</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection