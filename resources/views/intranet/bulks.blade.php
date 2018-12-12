@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/bulks.min.css')}}">
@endsection

@section('main-content')

    <div class="container-fluid" id="app-bulks" v-cloak>
        <div class="row">
            <div class="col-xs-10 col-sm-5 col-xs-offset-1">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{trans('intranet/users.input')}}"
                           v-model="query" @keyup.enter="search()" aria-describedby="basic-addon2">
                    <span class="input-group-addon btn-primary" id="basic-addon2"
                          @click.prevent="search()">Search</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6" id="create-user">
                <a href="{{route('bulk/new')}}" class="btn  btn-primary small pull-right">
                    New Bulk
                </a>
            </div>
            <div class="alert alert-danger" role="alert" v-if="error">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                @{{ error }}
            </div>
        </div>

        <nav aria-label="Page navigation" class="custom-pagination">

            <a href="" v-if="pagination.prevPageClass"
               aria-label="Previous"
               @click.prevent="fetchMessages(pagination.prevPage)">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            </a>
            <a class="disabled-pagination" v-else><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>

            <span> @{{ pagination.currentPage }} - @{{ pagination.countPage }}</span>

            <a href="" v-if="pagination.nextPageClass" aria-label="Next"

               @click.prevent="fetchMessages(pagination.nextPage)">
                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
            </a>
            <a class="disabled-pagination" v-else><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

        </nav>

        <table id="miyazaki">
            <thead>
            <tr>
                <th>Bulk</th>
                <th>Company</th>
                <th>Contact</th>
                <th>City</th>
                <th>Country</th>
                <th>Phone</th>
                <th>RM</th>
               {{-- <th>Delete</th>--}}
            </tr>
            </thead>
            <tbody>
            <tr v-for="bulk in bulks" v-bind:id="'bulk'+bulk.id">
                <td>
                    <p><a :href="'bulk/' + bulk.id">@{{ bulk.id }}</a></p>
                </td>
                <td>
                    <p v-if="bulk.company">@{{ bulk.company }}</p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="bulk.company_contact">@{{ bulk.company_contact }} </p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="bulk.location_city">@{{ bulk.location_city }}</p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="bulk.location_country">@{{ bulk.location_country }} </p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="bulk.client_phone">@{{ bulk.client_phone }}</p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="bulk.rm"> @{{ bulk.rm.first_name }} @{{ bulk.rm.last_name }}</p>
                    <p v-else> - </p>
                </td>
               {{-- <td>
                    <p><a href="#" @click.prevent="confirmDelete(bulk.id)"><i class="fa fa-trash"></i></a></p>
                </td>--}}
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
