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
                            <div class="panel-heading text-center">
                                <h4>Participants</h4>
                            </div>
                            <div class="panel-body">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Skype</th>
                                        <th>CV file</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($participants as $participant)

                                            <tr>
                                                <td>{{ $participant->getKey() }}</td>
                                                <td>{{ $participant->user->getAttribute('first_name') }}</td>
                                                <td>{{ $participant->user->getAttribute('last_name') }}</td>
                                                <td>{{ $participant->country->getAttribute('name') }}</td>
                                                <td>{{ $participant->getAttribute('city') }}</td>
                                                <td>{{ $participant->getAttribute('phone_number') }}</td>
                                                <td>{{ $participant->getAttribute('skype_name') }}</td>
                                                <td>..</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection