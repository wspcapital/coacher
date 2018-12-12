@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="app-users" v-cloak>
        <div class="row">
            <div class="col-xs-11 col-sm-5 col-xs-offset-1">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{trans('intranet/users.input')}}"
                           v-model="query" @keyup.enter="search()" aria-describedby="basic-addon2">
                    <span class="input-group-addon btn-primary" id="basic-addon2"
                          @click.prevent="search()">Search</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6" id="create-user">
                <a href="{{route('user/new')}}" class="btn  btn-primary small pull-right">
                    @lang('intranet/users.button.create')
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
                <th>
                        @lang('intranet/users.name')
                </th>
                <th>
                        @lang('intranet/users.email')
                </th>
                <th>
                    @lang('intranet/users.company')
                </th>
                <th>
                    @lang('intranet/users.coach')
                </th>
                <th>
                    @lang('intranet/users.rm')
                </th>
                <th>
                    @lang('intranet/users.type')
                </th>
            <tbody>
            <tr v-for="user in users">
                <td>
                    <p><a :href="'user/' + user.id">@{{ user.full_name }}</a></p>
                </td>
                <td><p> @{{ user.email }}</p></td>
                <td>
                    <p v-if="user.company">@{{ user.company }}</p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="user.trainer">@{{ user.trainer }}</p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p v-if="user.rm"> @{{ user.rm }} </p>
                    <p v-else> - </p>
                </td>
                <td>
                    <p>
                        @{{ user.role }}
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection

@section('scripts')
    @parent
    {{-- <script src="{{asset('assets/dist/libs/resp.js')}}"></script>--}}
@endsection
