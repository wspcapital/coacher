@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/prices.min.css')}}">
@endsection
@section('main-content')
    <div class="container" id="app">
        <div class="row">
            <h1>PRICES</h1>
            <form action="/vcoach/prices" method="post">
                {{ csrf_field() }}
                <table class="prices table">
                    <thead>
                    <tr>
                        <td><h1>Products</h1></td>
                        <td><h1>Price</h1></td>
                        <td width="140"><h1>Number</h1></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h1>Virtual Coach Package</h1>
                            Video upload with custom written analysis and action plan and
                            45 minutes of private online coaching.
                        </td>
                        <td>@{{ getPrice(packages.price[currencyType]) }}</td>
                        <td>
                            <input v-model="countPackage" name="items[0][qty]" class="form-control input-lg" type="number"
                                   min="0" required>
                            <input value="items[0].type" name="items[0][type]" type="hidden">
                        </td>
                    </tr>
                    <tr>
                        <td><h1>Online Personal Coaching Packages</h1>
                            Video upload with custom written analysis and action plan and
                            45 minutes of private online coaching.
                        </td>
                        <td>@{{ getPrice(session.price[currencyType]) }}</td>
                        <td>
                            <input v-model="countSession" name="countSession" class="form-control input-lg" type="number"
                                   min="0" required>
                            <input value="items[1].type" name="items[1][type]" type="hidden">
                        </td>
                    </tr>
                    <tr>
                        <td><h1>Corporate</h1></td>
                        <td><a href="mailto:admin@pinper.com" class="btn">inquire</a></td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><h1>Total</h1></td>
                        <td colspan="2">@{{ getTotal() }}</td>
                    </tr>
                    </tfoot>
                </table>
                <button type="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
            </form>

        </div>
    </div>

@endsection