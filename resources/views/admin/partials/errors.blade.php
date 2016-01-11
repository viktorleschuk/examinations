@if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops</strong> There were some problems.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif