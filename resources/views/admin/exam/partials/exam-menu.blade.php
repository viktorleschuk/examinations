<div class="panel panel-default">
    <div class="panel-heading text-center">Menu</div>
    <div class="list-group">
        <a href="{{ route('admin.exam.view', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'information') echo ' active' ?>">Information</a>
        <a href="{{ route('admin.exam.questions', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'questions') echo ' active' ?>">Questions</a>
        <a href="{{ route('admin.exam.participants', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'participants') echo ' active' ?>">Participants</a>
        <a href="{{ route('admin.exam.setting', ['exam' => $exam]) }}" class="list-group-item<?php if ($active == 'setting') echo ' active' ?>">Settings</a>
    </div>
</div>