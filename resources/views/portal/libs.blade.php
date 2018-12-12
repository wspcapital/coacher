@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/libs.min.css')}}">
@endsection
@section('main-content')
    <div class="start-content" id="library">

        <div class="row">
            <img src="{{ asset('assets/dist/img/portal/library-icon.png') }}">
            <span class="page-title">Library</span>
        </div>

        <div id="main-block">
            @foreach($categories as $category)
                <div class="row">
                    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-{{ $category->id }}">
                        <a href="javascript:void(0);" id="a-category-{{ $category->id }}">{{ $category->title }}</a>
                    </h2>
                    <div id="sec-{{$category->id}}" class="collapse">

                        @if($category->lib->count() > 0)
                            <table class="table">
                                <tbody class="sortable">
                                @foreach($category->lib as $library)
                                    <tr>
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
                                        <td></td>
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
    </div>
@endsection
