@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"><span>x</span></button>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
