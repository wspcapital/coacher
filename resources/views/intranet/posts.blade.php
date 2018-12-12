@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
@endsection

@section('main-content')

    <div class="container-fluid" id="app-posts" v-cloak>

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
                <a href="{{route('post/new')}}" class="btn  btn-primary small pull-right">
                    @lang('intranet/posts.button.create')
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

        <table v-show="posts" id="miyazaki">
            <thead>
            <tr>
                <th>@lang('intranet/posts.alias')</th>
                <th>@lang('intranet/posts.title')</th>
                <th>@lang('intranet/posts.subtitle')</th>
                <th>@lang('intranet/posts.category')</th>
                <th>@lang('intranet/posts.visible')</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts">
                <td>
                    <p><a :href="'post/' + post.id">@{{ post.alias }}</a></p>
                </td>
                <td>
                    <p>@{{ post.title }} </p>
                </td>
                <td>
                    <p>@{{ post.subtitle }}</p>
                </td>
                <td>
                    <p>@{{ post.category.title }}</p>
                </td>
                <td v-if="post.visible == 1">
                    <p>Yes</p>
                </td>
                <td v-else>
                    <p>No</p>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
    </div>
    </div>

@endsection
