@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/lib.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="app-libs">
        @if(count($category->getParentCategory()) > 0)
            <div class="row">
                <div class="col-xs-10 col-sm-5 col-xs-offset-1">
                    @if($category->getParentCategory()->parent_id == null)
                        <a href="{{route('libs')}}"
                           class="btn btn-primary">
                            Back {{ $category->getParentCategory()->title }}
                        </a>
                    @else
                        <a href="{{route('libs/category', $category->getParentCategory()->id)}}"
                           class="btn btn-primary">
                            Back {{ $category->getParentCategory()->title }}
                        </a>
                    @endif
                </div>
                {{-- Error block --}}
            </div>
        @endif
        <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-{{ $category->id }}">
            <a href="javascript:void(0);" id="a-category-{{ $category->id }}">{{ $category->title }}</a>
        </h2>
        <div id="sec-{{$category->id}}" class="collapse">
            <div class="col-xs-12 col-sm-6 new-item">
                <a href="{{ route('libs/category/new', $category->id ) }}">
                    Add new
                    <strong> {{ $category->title }} </strong>
                    child category</a>
            </div>
            <div class="col-xs-12 col-sm-6 new-item">
                <a href="{{ route('lib/new',  $category->id) }}">
                    Add new {{ $category->title }} item</a>
            </div>

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
                <table id="miyazaki">
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
    </div>
    </div>

@endsection
