@if(Session::has('info'))
    <div class="alert alert-info">
        <strong>Success!</strong>
        <ul>
            <li>
                {{ Session::get('info') }}
            </li>
        </ul>
    </div>
@endif