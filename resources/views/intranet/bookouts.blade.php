@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
@endsection

@section('main-content')

    <div class="container-fluid" id="app-users">

        <div class="row">
            <div class="col-xs-2"><a href="{{url('intranet/bookout/new')}}" class="btn  btn-primary small pull-right">
                    Create BookOut
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>User</th>
                <th>Starts</th>
                <th>Ends</th>
                <th>Details</th>
            </tr>
            </thead>
            @foreach($bookouts as $month => $data)
                <tr>
                    <td colspan="6"><h2>{{date('M Y',strtotime('1-'.substr($month,2,2).'-20'.substr($month,0,2)))}}</h2></td>
                </tr>
                @foreach($data as $key => $bookout)
                    <tr>
                        <td><a href="/intranet/user/{{$bookout->booker_user_id}}">{{$bookout->booker->first_name}} {{$bookout->booker->last_name}}</a></td>
                        <td> {{date('m/d/y',strtotime($bookout->start_date))}}</td>
                        <td> {{date('m/d/y',strtotime($bookout->end_date))}}</td>
                        <td>{{$bookout->details}}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>

@endsection
