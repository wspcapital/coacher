<p>Dear {{ $user->first_name }}</p>

<p>{{ $user->getTrainer() }} has been assigned as your personal coach and will be contacting you soon to set up your personal virtual coaching session. In the meantime, review their bio and visit your customer portal to find more tips to assist in your growth and development as a communicator.</p>
@if ($user->getTrainerObj()->getBio() != null)
    <p>{{ $user->getTrainerObj()->getBio() }}</p>
@endif
<p>Please review page two of the <a href='https://www.pinper.com/static/Virtual%20Coach%20Portal%20Quick%20Start.pdf'>Pinnacle Virtual Coach Quick Start</a> to find details on what your personal coach will be reviewing.</p>

<p>Regards</p>
<p>Pinnacle Performance Company <br> <a href="mailto:vcoach@pinper.com">vcoach@pinper.com</a></p>