@extends('portal.template.app')
@section('main-content')
   <div class="container" id="app">
       <div class="row">
           @if($page = App\Models\Post::where('alias','=',$alias)->first())
              {{$page->content}}
           @endif
       </div>
   </div>
@endsection