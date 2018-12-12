@foreach($videos as $video)
    {{--<a href="{{asset($one->asset->getMedia()[0]->getUrl())}}"
       @click.prevent="playVideo('{{asset($one->asset->getMedia()[0]->getUrl())}}')">
        {{$one->asset->getMedia()[0]->file_name}}
    </a> <br>--}}
    <div class="row one-video">
        <div class="video clearfix col-xs-12 col-sm-3">
            <a href="#"
               @click.prevent="playVideo('{{asset($video->asset->getMedia()[0]->getUrl())}}')">
                <img src="{{asset($video->asset->getMedia()[0]->getUrl('preview'))}}"
                     alt="preview" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-12 col-sm-9">
            <h2>{{$video->title}}</h2>
            <p>Uploaded: {{ $video->created_at->format('m/d/y') }}</p>
            @if($vit == 'workshop')
                <a href="{{asset($video->asset->getMedia()[0]->getUrl())}}?fdl=1" download>download this video</a>
            @else
                <a href="#" @click.prevent="playVideo('{{asset($video->asset->getMedia()[0]->getUrl())}}')">watch this
                    video</a>
            @endif
        </div>
    </div>
@endforeach