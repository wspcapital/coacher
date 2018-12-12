@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/order.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="app-orders" v-cloak>

        <div class="row">
            <div class="col-xs-10 col-sm-5 col-xs-offset-1">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{trans('intranet/users.input')}}"
                           v-model="query" @keyup.enter="search()" aria-describedby="basic-addon2">
                    <span class="input-group-addon btn-primary" id="basic-addon2"
                          @click.prevent="search()">Search</span>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" v-if="error">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                @{{ error }}
            </div>
        </div>

        <div class="orders-menu">
            <span v-if="stated=='new'">New</span><a v-else @click.prevent="fetchMessages('new',1)"
                                                    href="#">New</a>&nbsp;|&nbsp;
            <span v-if="stated=='open'">Open</span><a v-else @click.prevent="fetchMessages('open',1)" href="#">Open</a>&nbsp;|&nbsp;
            <span v-if="stated=='closed'">Closed</span><a v-else @click.prevent="fetchMessages('closed',1)"
                                                          href="#">Closed</a>&nbsp;|&nbsp;
            <span v-if="stated=='unsubmitted'">Unsubmitted</span><a v-else
                                                                    @click.prevent="fetchMessages('unsubmitted',1)"
                                                                    href="#">Unsubmitted</a>
        </div>

        <nav aria-label="Page navigation" class="custom-pagination">
            <a href="" v-if="pagination.prevPageClass"
               aria-label="Previous"
               @click.prevent="fetchMessages(stated, pagination.prevPage)">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            </a>
            <a class="disabled-pagination" v-else><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>

            <span> @{{ pagination.currentPage }} - @{{ pagination.countPage }}</span>

            <a href="" v-if="pagination.nextPageClass" aria-label="Next"

               @click.prevent="fetchMessages(stated, pagination.nextPage)">
                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
            </a>
            <a class="disabled-pagination" v-else><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
        </nav>

        <table v-show="orders" id="miyazaki">
            <thead>
            <tr>
                <th>@lang('intranet/orders.order')</th>
                <th>@lang('intranet/orders.member')</th>
                <th>@lang('intranet/orders.company')</th>
                <th>@lang('intranet/orders.type')</th>
                <th>@lang('intranet/orders.source')</th>
                <th>@lang('intranet/orders.date')</th>
                <th>@lang('intranet/orders.rm')</th>
                <th>@lang('intranet/orders.trainer')</th>
                <th>@lang('intranet/orders.trainer_former')</th>
                <th>@lang('intranet/orders.status')</th>
                <th>@lang('intranet/orders.delete')</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="order.booking_participant" v-for="order in orders" v-bind:id="'order'+order.id">
                <td>
                    <p><a :href="'order/' + order.id">@{{ order.id }}</a></p>
                </td>
                <td>
                    <p>
                        <a :href="'/intranet/user/'+order.booking_participant.user.id">
                            @{{ order.booking_participant.user.full_name }}
                        </a>
                    </p>
                </td>

                <td>
                    <p>@{{ order.booking_participant.user.company }}</p>
                </td>
                <td>
                    <p>@{{ order.type }}</p>
                </td>
                <td>
                    <p>@{{ order.source }}</p>
                </td>
                <td>
                    <p> @{{ order.created_at | formatDate }}</p>
                </td>
                <td>
                    <p v-if="order.booking_participant.booking.rm_user_id != null">
                        @{{ order.booking_participant.booking.rm.first_name }}
                        &nbsp;@{{ order.booking_participant.booking.rm.last_name }}
                    </p>
                </td>
                <td>
                    <p>
                        <select class="form-control" v-model="order.order_trainer_id" @change="saveTrainer(order)">
                        <option v-for="trainer in trainers" v-bind:value="trainer.id">
                            @{{ trainer.full_name }}
                        </option>
                        </select>
                    </p>
                </td>
                <td>
                    <p v-if="order.beforeTrainer">
                        @{{ order.beforeTrainer.full_name }}
                    </p>
                </td>
                <td>
                    <p>@{{ orderStatus[order.status] }}</p>   {{--orders.js--}}
                </td>
                <td>
                    <p><a href="#" @click.prevent="confirmDelete(order.id)"><i class="fa fa-trash"></i></a></p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
