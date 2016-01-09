<div class="panel panel-default">
    <div class="panel-heading text-center">Menu</div>
    <div class="list-group">
        <a href="{{ route('admin.exams.index') }}" class="list-group-item">Exams</a>
        <a href="#" class="list-group-item">Pending exams</a>
        <a href="{{ route('admin.participants.list') }}" class="list-group-item<?php if ($active == 'participants') echo ' active' ?>">Participants info</a>
    </div>
</div>