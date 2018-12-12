@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/users.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/lib.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="app-libs">
        <div class="row">
            <div class="col-xs-10 col-sm-5 col-xs-offset-1">
                <div class="input-group">
                    <input type="text" id="search-text" class="form-control"
                           placeholder="{{trans('intranet/users.input')}}"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon btn-primary" id="basic-addon2"
                    >Search</span>
                </div>
            </div>

            <div class="col-xs-12 col-sm-5">
                <a href="{{route('libs/category/new')}}" class="btn  btn-primary pull-right add-category">
                    Add new category
                </a>
            </div>
            {{-- Error block --}}
        </div>

        <div id="main-block">
            @foreach($categories as $category)
                <div class="row">
                    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-{{ $category->id }}">
                        <a href="javascript:void(0);" id="a-category-{{ $category->id }}">{{ $category->title }}</a>
                    </h2>
                    <div id="sec-{{$category->id}}" class="collapse">

                        <a href="{{ route('libs/category/new',  $category->id ) }}"
                           style="margin-left: 20px;">Add new
                            <strong> {{ $category->title }} </strong>
                            child category</a>
                        <a href="{{ route('lib/new', $category->id) }}" style="margin-left: 100px;">Add
                            new {{ $category->title }} item</a>

                        @if(count($category->getChildrenCategory()))
                            @foreach($category->getChildrenCategory() as $child_category)
                                <div class="row">
                                    <h2 class="child-category" style="margin-left: 50px;">
                                        <a href="{{ route('libs/category', $child_category->id) }}">{{ $child_category->title }}</a>
                                    </h2>
                                </div>
                            @endforeach
                        @endif

                        @if($category->lib->count() > 0)
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                </tr>
                                <tbody class="sortable">
                                @foreach($category->lib as $library)
                                    <tr>
                                        <td>
                                            <a href="{{route('lib',  $library->id)}}">
                                                {{ $library->title }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($library->asset_id)
                                                <img src="{{asset('assets/dist/img/intranet/library/'.$library->asset->type.'-icon.png')}}"
                                                     alt="icon">
                                                <a href="../{{ $library->asset->getMedia()[0]->getUrl() }}" download>
                                                    {{ $library->title }}
                                                </a> <br>
                                                {{ $library->description }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    </div>
    </div>

@endsection
