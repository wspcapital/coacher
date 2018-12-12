<div class="container" id="app">
    <h1>FAQ's</h1>
    @foreach($posts as $post)
        <h4 class="question" data-toggle="collapse" data-target="#question-{{$post->id}}">
            {{$post->title}}
        </h4>
        <div id="question-{{$post->id}}" class="collapse">
            {!! $post->content !!}
        </div>
    @endforeach
</div>