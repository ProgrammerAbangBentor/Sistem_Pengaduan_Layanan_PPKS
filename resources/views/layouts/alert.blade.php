@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <p>{!! $message !!}</p>
            <br>
            <br>
            <a href="{{ route('login') }}"  style="float: right;">Login</a>
        </div>
    </div>
@endif
