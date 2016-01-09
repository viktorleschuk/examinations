<div class="panel panel-default">
    <div class="panel-heading text-center">Menu</div>
    <div class="list-group">
        <a href="{{ route('admin.exams.index') }}" class="list-group-item<?php if ($active == 'exams') echo ' active' ?>">All exams</a>
        <a href="{{ route('admin.exam.create') }}" class="list-group-item<?php if ($active == 'create') echo ' active' ?>">Create exams</a>
    </div>
</div>