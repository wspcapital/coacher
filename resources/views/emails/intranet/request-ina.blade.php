{{ trans('doc/ina.dear_name', ['name' => e($participant->user->full_name)]) }}
<br><br>
{{ trans('doc/ina.request_mail_text_1') }}
<br><br>
{{ trans('doc/ina.request_mail_text_2') }}<br><br>
<br><br>
{{ trans('doc/ina.request_mail_text_3') }}<br><br>
<br><br>
{{ link_to_action('DocController@getIna', null, $participant->share_hash) }}<br><br>
<br><br>
@if ($participant->booking->ina_type == 4)
    <span style="color: white; background: red;"><strong>PRE-WORK Required:</strong>
Please come to the workshop prepared with the first 5-7 minutes of a presentation you might deliver or a meeting you might lead.</span>
    <br><br>
    <br><br>
@endif
Regards,<br>
Pinnacle Relationship Manager<br>
<a href="mailto:portal@pinper.com">
    @if(!empty($participant->booking->rm->full_name))
        {{ $participant->booking->rm->full_name }}
    @endif
</a><br><br>
