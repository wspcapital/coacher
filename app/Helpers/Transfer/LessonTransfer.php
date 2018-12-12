<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 27.01.17
 * Time: 13:48
 */

namespace App\Helpers\Transfer;

use App\Models\Lesson;

class LessonTransfer extends Transfer
{
    public static function transfer($lesson)
    {
        $trans = new LessonTransfer();
        $trans->insertLesson($lesson);
    }

    public function insertLesson($lesson)
    {
        $data = [
            'title' => $lesson->title,
            'subtitle' => ' ', //$lesson->subtitle,
            'description' => '', //$lesson->description,
            'time' => $lesson->time,
            'pdf'=> $lesson->pdf
        ];

        Lesson::create($data);
    }
}
