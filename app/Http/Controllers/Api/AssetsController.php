<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\{
    VideoFileRequest,
    AssetRequest
};
use App\Notifications\Intranet\{
    LearningReadyNotification,
    WorkshopReadyNotification
};
use App\Models\{
    User,
    UserAssets,
    Assets
};
use Illuminate\Support\Facades\{
    Input,
    Auth
};
use App\Http\Controllers\Controller,
    App\Http\Controllers\Traits\AssetsTrait,
    Carbon\Carbon;


/**
 * Class AssetsController
 * @package App\Http\Controllers\Api
 */
class AssetsController extends Controller
{
    use AssetsTrait;

    /**
     * Return all workshop videos
     *
     * @param $userId
     * @return array
     */
    public function getWorkshopVideo($userId)
    {
        return [
            'videos' => UserAssets::allWorkshopVideo($userId),
            'titles' => $this->getWorkshopTitles()
        ];
    }

    /**
     * Return all learning videos
     *
     * @param $userId
     * @return array
     */
    public function getLearningVideo($userId)
    {
        return [
            'videos' => UserAssets::allLearningVideo($userId),
            'titles' => $this->getLearningTitles()
        ];
    }

    /**
     * Return all webinar videos
     *
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWebinarVideo($userId)
    {
        return UserAssets::allWebinarVideo($userId);
    }

    /**
     * Upload workshop video
     *
     * @param AssetRequest $request
     * @return mixed
     */
    public function uploadWorkshopVideo(AssetRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $when = Carbon::now()->addMinutes(3);
        $user->notify((new WorkshopReadyNotification())->delay($when));

        return response()->success(
            trans('assets-message.video-upload'),
            $this->uploadAdminVideo($request, Auth::user()->id, 2)
        );
    }

    /**
     * Upload workshop video
     *
     * @param AssetRequest $request
     * @return mixed
     */
    public function uploadLearningVideo(AssetRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $when = Carbon::now()->addMinutes(3);
        $user->notify((new LearningReadyNotification())->delay($when));

        return response()->success(
            trans('assets-message.video-upload'),
            $this->uploadAdminVideo($request, Auth::user()->id, 3)
        );
    }

    /**
     * @param VideoFileRequest $request
     * @return mixed
     */
    public function uploadPdfLearningVideo(VideoFileRequest $request)
    {
        $type = $request->pdf ? 'Pdf' : 'Document';

        return response()->success(trans('assets-message.file-upload'), $this->uploadVideoFile($request->all(), $type));
    }

    /**
     * Upload webinar video
     *
     * @param AssetRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function uploadWebinarVideo(AssetRequest $request)
    {
        return response()->success(
            trans('assets-message.video-upload'),
            $this->uploadAdminVideo($request, Auth::user()->id, 4)
        );
    }

    /**
     * Delete video
     *
     * @param id
     * @return void
     */
    public function deleteVideo($id)
    {
        Assets::deleteFile($id);
    }

    /**
     * Save video title
     *
     * @return mixed
     */
    public function saveInfoVideo()
    {
        $videos = json_decode(Input::get('data'));
        foreach ($videos as $video) {
            UserAssets::where('id', $video->id)->update(['title' => $video->title]);
        }

        return response()->success(trans('assets-message.save-title'));
    }
}
