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

                                @include('admin.partials.success')

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
                                        <th></th>
                                        <th></th>
                                        <th></th>
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
                                                <td align="center"><a href="{{ route('admin.participants.cv', ['participant' => $participant]) }}" target="_blank"><i class="fa fa-download"></i></a></td>
                                                <td><a href="{{ route('admin.participant.view', ['participant'  => $participant]) }}"><i class="fa fa-eye"></i></a></td>
                                                <td><a href="{{ route('admin.participant.edit', ['participant'  => $participant]) }}"><i class="fa fa-cog"></i></a></td>
                                                <td><a href="{{ route('admin.participant.delete', ['participant' => $participant]) }}"><i class="fa fa-times"></i></a></td>
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