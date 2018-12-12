@extends('vcoach.template.app')
@section('main-content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 infobox">
                    {!! $posts['left-block']->content !!}
            </div>
            <div class="col-xs-12 col-sm-4 infobox">
                <h2>Is Virtual Coach for you?</h2>
                <select id="right-for-me" class="form-control">
                    <option disabled="disabled">i am...</option>
                    <option data-text="Virtual Coaching can help improve your confidence, increase the consistency of your delivery and ensure your audience reacts to your message the way you want.">I am delivering an upcoming presentation or speech I need to work on</option>
                    <option data-text="Virtual Coaching can increase your confidence, credibility and help ensure your students better understand and retain what you are trying to teach them. ">I am an educator, instructor, teacher</option>
                    <option data-text="Virtual Coaching will maximize the effectiveness of your message and ensure your confidence and credibility are commensurate with your position. ">I am a Senior Leader or C-Suite Executive</option>
                    <option data-text="Virtual Coaching will help you better command the attention of a room so team members will focus and be more productive.  With Virtual Coaching you'll be able to demonstrate the confidence and credibility that encourages respect and efficiency.">I am a manager who runs team meetings</option>
                    <option data-text="Virtual Coaching will enable you to deliver both good and bad news in a way that helps employees focus on the positive and clearly understand how, where and why to make improvements. With Virtual Coaching you'll be able to handle questions and complaints in a calm, confident manner.">I am delivering performance reviews</option>
                    <option data-text="Virtual Coaching will help you demonstrate confidence, eliminate anxiety and ensure that prospective employers will focus on your strengths and clarity of your qualifications.">I am interviewing for a new position</option>
                    <option data-text="Virtual Coaching will enable you to calm challenging customers by clarifying your message and empowering your voice and body language.">I am a customer service representative</option>
                    <option data-text="Virtual Coaching will enhance your sales techniques and instill confidence in your prospects by ensuring your body and voice present a consistent, credible and sincere exterior.">I am sales professional</option>
                    <option data-text="Virtual Coaching will help you to communicate your complex knowledge in a clear and compelling way, even to those unfamiliar with the specifics of your subject.">I am a subject matter expert</option>
                    <option data-text="Virtual Coaching will help you to communicate your complex knowledge in a clear and compelling way, even to those unfamiliar with the specifics of your subject.">I am a scientist or medical professional</option>
                    <option data-text="Virtual Coaching will help you appear calm and confident while navigating complex issues, uncomfortable situations and delicate discussions. Virtual Coaching will boost your credibility and persuasiveness so you can better gain cooperation and respect for your counsel.">I am an attorney</option>
                    <option data-text="Virtual Coaching will help you better guide customers to desired purchases while seeming knowledgeable, confident and sincere.">I am in retail</option>
                    <option data-text="Virtual Coaching will empower you to overcome your anxiety and provide you with tools to look and sound more confident and compelling, whether one-on-one or in a larger social group.">I am often in timid in social environments</option>
                </select>

                <div id="iam">
                   {!! $posts['center-block']->content !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 infobox">
                {!! $posts['right-block']->content !!}
            </div>
        </div>
    </div>
@endsection