@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/payments.min.css')}}">
@endsection
@section('main-content')

    <div id="coupons">
        <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#myModal">
            Generate Coupons
        </button>
        @include('intranet.partials.coupons-modal')
    </div>
    <div class="clearfix">
        {{ $coupons->links() }}
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table id="miyazaki">
        <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Code</th>
            <th>Discount</th>
            <th>Vcoaches</th>
            <th>Sessions</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($coupons as $coupon)
            <tr>
                <td>
                    <p>{{ $coupon->id }}</p>
                </td>
                <td>
                    <p><span class="label label-{{$coupon->getTypeClass()}}">{{ $coupon->type }}</span></p>
                </td>
                <td>
                    <p>
                        <small><code>{{ $coupon->code }}</code></small>
                    </p>
                </td>
                <td>
                    <p>
                        @if(!is_null($coupon->discount))
                            {{ $coupon->discount }}%
                            @else
                            &minus;
                        @endif
                    </p>
                </td>
                <td>
                    <p>
                        @if(!is_null($coupon->vcoaches))
                        {{ $coupon->vcoaches }}
                        @else
                        &minus;
                        @endif
                    </p>
                </td>
                <td>
                    <p>
                        @if(!is_null($coupon->sessions))
                        {{ $coupon->sessions }}
                        @else
                        &minus;
                        @endif
                    </p>
                </td>
                <td>
                    <p>{{ $coupon->created_at->format('m/d/Y H:i:s') }}</td>
                </p>
                <td>
                    <p>{{ $coupon->updated_at->format('m/d/Y H:i:s') }}</td>
                </p>
                <td>
                    <p>
                        @if($coupon->is_active)
                            <span class="label label-success">Unused</span>
                        @else
                            <span class="label label-danger">Used</span>
                        @endif
                    </p>
                </td>
            </tr>
        @empty
            <tr class="warning">
                <td colspan="9" class="text-center text-warning">No coupons</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
