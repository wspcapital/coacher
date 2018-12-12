@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/need-credits.min.css')}}">
@endsection
<need-credit type={{$type}}></need-credit>


