<div class="panel panel-default">
    <div class="panel-heading text-center">Menu</div>
    <div class="list-group">
        <a href="{{ route('admin.exam.info', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'info') echo ' active' ?>">Info</a>
        <a href="{{ route('admin.exam.questions', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'questions') echo ' active' ?>">Questions</a>
        <a href="{{ route('admin.exam.info', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'participants') echo ' active' ?>">Participants</a>
        <a href="{{ route('admin.exam.setting', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'setting') echo ' active' ?>">Settings</a>
    </div>
</div>

{{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading text-center">Menu</div>--}}
    {{--<div class="list-group">--}}
        {{--<a href="{{ route('admin.exam.index') }}" class="list-group-item">Info</a>--}}
        {{--<a href="{{ route('admin.exam.questions') }}" class="list-group-item">Questions</a>--}}
        {{--<a href="{{ route('admin.exam.participants') }}" class="list-group-item">Participants</a>--}}
        {{--<a href="{{ route('admin.exam.settings') }}" class="list-group-item">Settings</a>--}}
    {{--</div>--}}
{{--</div>--}}