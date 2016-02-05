@if(Session::has('error'))
    <div class="alert alert-danger">
        <strong>Error!</strong>
        <ul>
            <li>
                {{ Session::get('error') }}
            </li>
        </ul>
    </div>
@endif