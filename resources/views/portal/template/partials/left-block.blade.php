<section id="sidebar">
    <h3>{{ $user->full_name }}</h3>
    {{$user->title}} {{$user->company}} {{$user->address1}}
    <hr>
    <h3>Virtual Coach
        <a href="#" class="btn  btn-primary btn-faq" data-toggle="modal" data-target="#explain1-modal">?</a>
    </h3>

    <div>You have
        <strong>{{ $user->getVCoaches() }}</strong> Virtual Coach Video Uploads.
    </div>
    <div>You have <strong>{{ $user->getSessions() }}</strong> Coaching Sessions.</div>
    <hr>
    <h3>Your Coach</h3>
    @if($user->getTrainer()) {{--bio modal--}}
    <div class="modal fade" id="bio-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{$user->getTrainer()}}</h4>
                </div>
                <div class="modal-body">
                     @if(is_string($user->getTrainerObj()->getBio()))
                         {{$user->getTrainerObj()->getBio()}}
                     @endif
                </div>
            </div>
        </div>
    </div>
    {{--end bio modal--}}
    <div class="clearfix">
        @if ($user->getTrainerObj()->getAvatar()))
        <img src="{{ asset($user->getTrainerObj()->getAvatar()) }}" alt="ava">
        @endif
        <span class="pad-left">
				<em><strong>{{$user->getTrainer()}}</strong></em>
				<br><a href="#" data-toggle="modal" data-target="#bio-modal">read bio</a>
				</span>
    </div>
    @else Once your coach has been assigned check back here for their profile and more details.
    @endif
    {{--@if(Auth::user()->data('new_vpr'))
        <a href="/portal/my-videos">New VPR Available</a> @endif
    @if(isset(Auth::user()->data->ddp))
        <h3>Your Reports</h3>
        <a href="{{Auth::user()->data()->ddp->url}}">Diagnostic and Development
            Report--}}{{--Auth::user()->data()->ddp->title--}}{{--</a>
    @endif--}}
    <hr>
    <h3>VPR List</h3>

    <ul>

        @if(count($vprs))
            @foreach($vprs as $vpr)
                <a href="{{ asset($vpr->assets->getMedia()[0]->getUrl()) }}">
                    View VPR ({{ $vpr->created_at->format('m/d/y') }})
                </a>
            @endforeach
        @endif
    </ul>

    <hr>
    <strong>For assistance, contact us at</strong> <a href="mailto:portal@pinper.com">portal@pinper.com</a>
    <hr>
    <a class="btn btn-primary" href="{{asset('assets/static/Virtual Coach Portal Quick Start.pdf')}}">Virtual Coach Quick
        Start</a>
    <a class="btn btn-primary" href="{{ route('howto') }}">Virtual Coach How-to Video</a>

</section>




