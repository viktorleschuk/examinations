@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success!</strong>
        <ul>
            <li>
                {{ Session::get('success') }}
            </li>
        </ul>
    </div>
@endif