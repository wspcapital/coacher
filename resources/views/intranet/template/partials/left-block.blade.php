<section id="sidebar" class="container-fluid">
    <div class="text-center">

        <div class="img-circle img-upload">
            @if ($user->asset_id != null)
                <img src="{{asset($user->getAvatar())}}" alt="ava">
            @endif
        </div>
        <h4>{{ $user->full_name }}</h4>
        <a href="{{route('profile')}}">profile</a>
    </div>
    <h3>Workshops</h3>
    @if($workshopCount)
        <a href="{{route('calendar')}}">Workshops</a> <span class="badge">{{$workshopCount}}</span><br>
    @endif

    @if($user->hasRole('trainer') and $coachingCount)
        <a href="{{ route('orders') }}">Coaching Assignments</a> <span class="badge">{{$coachingCount}}</span>
    @endif
    <hr>

    <h3>Your Account</h3>
    <strong>Last Login:</strong> {{$user->login_at}}
    <h3 class="pad-bottom">Internet Actions</h3>
    @if($user->hasRole('manager') || $user->hasRole('admin'))
        <a href="{{ route('booking', 'new') }}" class="btn small btn-fixed btn-primary">Book a Workshop</a>
    @endif
    <a href="//outlook.office365.com" class="btn small btn-fixed btn-primary">Web Email</a>
    @if($user->hasRole('manager'))
        <a href="{{ url('https://www.pipelinedeals.com/login') }}" class="btn small btn-fixed btn-primary">Pipeline
            Deals</a>
    @endif
    <a href="{{ url ('https://portal.atlastravel.com/app_atp/apf/init/login?COUNTRY_SITE=UKI&SITE=2AVJ2AVJ&LANGUAGE=US#APFHM=6') }}"
       class="btn small btn-fixed btn-primary">Travel Reservation</a>
    @if($user->hasRole('admin'))
        <a href="{{ route('bookouts') }}" class="btn small btn-fixed btn-primary">Book Outs</a>
    @else
        <a href="{{ route('bookout', 'new') }}" class="btn small btn-fixed btn-primary">Book Out</a>
    @endif
</section>
