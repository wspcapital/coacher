<?php

use Illuminate\Database\Seeder,
    App\Models\Lesson;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'title'       => 'First Impressions',
                'subtitle'    => 'Setting the bar for improvement. Video diagnostics and analysis.',
                'description' => 'Through video analysis we establish a baseline and identify areas '
                                    .'where you can make improvement. Instructor will introduce both The Pinnacle '
                                    .'Method and a common vocabulary for training that relates to body language, '
                                    .'vocal dynamics, and projecting a confident presence.',
                'time'        => '90',
                'pdf'    => 'First Impressions 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Active Listening',
                'subtitle'    => 'Listen to comprehend, not to respond.',
                'description' => 'Learn how different types of listening are utilized and how to avoid common '
                                    .'pitfalls. Active listening as a comprehension and retention tool will also '
                                    .'be discussed.',
                'time'        => '30',
                'pdf'    => 'Active Listening 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Overcoming Stage Fright',
                'subtitle'    => 'Mental and physical techniques to overcome nervousness.',
                'description' => 'Break down the causes and symptoms of stage fright and develop individual '
                                    .'strategies—both mental and physical—to combat speech anxiety.',
                'time'        => '30',
                'pdf'    => 'Overcoming Stage Fright 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Projecting a Confident Presence',
                'subtitle'    => 'Project confidence even when nervous or not fully prepared.',
                'description' => 'Project a confident presence, whether communicating one‐on‐one, '
                                    .'facilitating a meeting, or delivering a presentation—even when '
                                    .'you are less than confident.',
                'time'        => '30',
                'pdf'    => 'Projecting A Confident Presence 21-Nov-14 v1.pdf'
            ],

            [
                'title'       => 'Face, Base and Pace',
                'subtitle'    => 'Leveraging your voice, gestures, and body language to influence.',
                'description' => 'Analyze your verbal, vocal, and visual communication channels. Align your body '
                                .'language, gestures, facial expressions, and vocal dynamics to deliver your message '
                                .'more effectively.',
                'time'        => '90',
                'pdf'    => 'Face Base and Pace 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Vocal Dynamics',
                'subtitle'    => 'Using your voice to influence.',
                'description' => 'Use your voice to engage and influence, ensuring your soundscape complements '
                                    .'your message.',
                'time'        => '90',
                'pdf'    => 'Vocal Dynamics 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Gestures and Movement',
                'subtitle'    => 'Ensure your non-verbal message matches your words.',
                'description' => 'Discover how effective gestures and movement reinforce your verbal message and '
                                    .'support your intention.',
                'time'        => '30',
                'pdf'    => 'Gestures and Movement 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Intention and Objective',
                'subtitle'    => 'Influence your audience to react the way you desire. Put purpose and passion '
                                    .'behind your message.',
                'description' => 'Learn how words, attitude, body language, and delivery are perceived by others. '
                                    .'Communicate with a clear intention and objective so your audience understands '
                                    .'why your message is important to them.',
                'time'        => '60',
                'pdf'    => 'Intention and Objective 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Effective Storytelling',
                'subtitle'    => 'Inspire, persuade or entertain: use stories to engage and influence your audience.',
                'description' => 'Discover how to successfully incorporate personal and professional stories into '
                                    .'meetings or presentations so your audience is hooked and engaged.',
                'time'        => '60',
                'pdf'    => 'Effective Storytelling 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Impromptu Speaking',
                'subtitle'    => 'Speak clearly, concisely and confidently without preparation.',
                'description' => 'Be clear, concise, and assertive while thinking on your feet. Show you expect the '
                                    .'unexpected. Delivering an effective positioning statement is featured.',
                'time'        => '60',
                'pdf'    => 'Impromptu Speaking 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Handling Difficult Questions and Audiences',
                'subtitle'    => 'Learn to control difficult audiences and tough questions in order to stay on track.',
                'description' => 'Control challenging audiences and navigate tough questions while maintaining '
                                    .'composure. "Murder Boarding" as a preparation technique will be discussed.',
                'time'        => '90',
                'pdf'    => null
            ],
            [
                'title'       => 'Delivering Effective Feedback',
                'subtitle'    => 'Learn to deliver effective feedback to a group or one-on-one.',
                'description' => 'Learn to effectively deliver feedback to a group or one-on-one, focusing on a '
                                    .'strong intention and a confident, focused delivery.',
                'time'        => '60',
                'pdf'    => 'Delivering Effective Feedback 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Master Presentations',
                'subtitle'    => 'Craft and deliver all aspects of a presentation based on the objective, intention '
                    .'and audience benefit.',
                'description' => 'Structure and deliver a presentation built on understanding your objective and '
                                .'intention. PREWORK: Come to the workshop with 5-7 minutes of work-related material.',
                'time'        => '60',
                'pdf'    => null
            ],
            [
                'title'       => 'Virtual Communication',
                'subtitle'    => 'Keep your audience engaged and involved in conference calls and virtual meetings',
                'description' => 'Overcome the challenges of communicating virtually and learn techniques to engage '
                                    .'audiences in a difficult medium.',
                'time'        => '60',
                'pdf'    => 'Virtual Communication 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Excellence in Customer Service',
                'subtitle'    => 'Master your message and delivery to satisfy the tough customer.',
                'description' => 'Explore customer objectives and identify how to effectively meet their needs, '
                                    .'even when under fire.',
                'time'        => '60',
                'pdf'    => 'Excellence in Customer Service 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Media Communication',
                'subtitle'    => 'Leveraging media to convey an impactful, influential message.',
                'description' => 'Address the media with confidence in press conferences, interviews, and panels, '
                                    .'even when handling challenging questions or delivering difficult news.',
                'time'        => '60',
                'pdf'    => null
            ],
            [
                'title'       => 'Negotiating with Intention',
                'subtitle'    => 'Combining a persuasive delivery with the basics of negotiation.',
                'description' => 'Learn the basics of an effective negotiation, ensuring your communication '
                                    .'maximizes your leverage.',
                'time'        => '60',
                'pdf'    => null
            ],
            [
                'title'       => 'Facilitation - Running Effective Meetings',
                'subtitle'    => 'Pre-meeting preparation, staying on track, conflict management and more.',
                'description' => 'Facilitate discussion, manage conflict, stay on track, and avoid the common '
                                    .'pitfalls that can derail a productive meeting.',
                'time'        => '120',
                'pdf'    => 'Facilitation Running Effective Meetings 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Practical Simulations',
                'subtitle'    => 'Customized, relevant, real-world simulations of your personal '
                                    .'communication scenarios.',
                'description' => 'Put it all together in a final exercise, applying your newly learned skills to a '
                                    .'customized, relevant, real world simulation.',
                'time'        => '120',
                'pdf'    => 'Practical Simulations  21-Nov-14 v1 v1.pdf'
            ],
            [
                'title'       => 'Utilizing Visual Aids',
                'subtitle'    => 'Learn how to use visual aids effectively and to keep the focus on YOU!',
                'description' => 'Analyze examples of good and bad visual aids and learn simple guidelines '
                                    .'for using them effectively.',
                'time'        => '15',
                'pdf'    => 'Utilizing Visual Aids  21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Being Assertive',
                'subtitle'    => 'Passive, aggressive, assertive; where do you fall and how can '
                                    .'you become more assertive?',
                'description' => 'Learn to effectively contribute to meetings and conversations, challenge your '
                                    .'audiences, and deliver feedback to a team or individual.',
                'time'        => '30',
                'pdf'    => 'Being Assertive  21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Communicating Change Effectively',
                'subtitle'    => 'Manage your audience to embrace and support change.',
                'description' => 'Discover how to encourage team members to embrace and support change within '
                                    .'their department or organization.',
                'time'        => '30',
                'pdf'    => 'Communicating Change Effectively 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Building Rapport',
                'subtitle'    => 'Learn how to leverage social communication skills to more effectively drive '
                                    .'business relationships.',
                'description' => 'Leverage your social communications skills to drive business relationships.',
                'time'        => '30',
                'pdf'    => 'Building Rapport Social  21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Stakeholder Analysis',
                'subtitle'    => 'Learn to identify various stakeholders and how your message might vary '
                                    .'to achieve success.',
                'description' => 'Identify the different types of stakeholders in your professional environment '
                                    .'and discover what success would mean to them.',
                'time'        => '30',
                'pdf'    => 'Stakeholder Analysis 21-Nov-14 v1.pdf'
            ],
            [
                'title'       => 'Effective Telephone Communication',
                'subtitle'    => 'Leverage your voice to keep your audience engaged and involved over the phone.',
                'description' => 'Overcome the challenges of communicating over the phone, while keeping your '
                                    .'audience engaged and involved at all times.',
                'time'        => '30',
                'pdf'    => 'Effective Telephone Communication 21-Nov-14 v1.pdf'
            ]
        ];
        foreach ($array as $one) {
            Lesson::create($one);
        }
    }
}
