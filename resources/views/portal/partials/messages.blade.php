@if(Session::get('error'))
    <div class="alert alert-danger alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if(is_array(Session::get('errors')))
            @foreach(Session::get('errors') as $message)
                <p><i class="fa-fw fa fa-times"></i> {{ $message }}</p>
            @endforeach
        @else
            <p><i class="fa-fw fa fa-times"></i> {{ Session::get('error') }}</p>
        @endif
    </div>
@endif
@if(Session::get('success'))
    <div class="alert alert-success alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if(is_array(Session::get('success')))
            @foreach(Session::get('success') as $message)
                <p><i class="fa-fw fa fa-times"></i> {{ $message }}</p>
            @endforeach
        @else
            <p><i class="fa-fw fa fa-check"></i> {{ Session::get('success') }}</p>
        @endif
    </div>
@endif
