<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\VideoParticipantRequest,
    App\Models\User,
    App\Models\UserAssets,
    Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\BookingParticipants;

/**
 * Class SharedVideoController
 * @package App\Http\Controllers\Api
 */
class SharedVideoController extends Controller
{
    /**
     * Return video and participant
     *
     * @param Request $request
     * @return array
     */
    public function getSharedVideo(Request $request)
    {
        $userAssets = UserAssets::with(['asset.media', 'asset.getDocVideos.docAssets.media'])
            ->findOrFail($request->userAssetId);

        return ['video' => $userAssets,
            'participant' => $this->getParticipant($userAssets->asset_id)
        ];
    }

    /**
     * Return participant
     *
     * @param $assetId
     * @return array
     */
    public function getParticipant($assetId)
    {
        $allUserAssets = UserAssets::where('asset_id', $assetId)->get();
        $participants = [];
        foreach ($allUserAssets as $one) {
            foreach ($one->user as $item) {
                $participants[$item->id]['id'] = $item->id;
                $participants[$item->id]['name'] = $item->getFullName();
                $participants[$item->id]['email'] = $item->email;
            }
        }

        return $participants;
    }

    /**
     * Add participant
     *
     * @param VideoParticipantRequest $request
     * @return array
     */
    public function addParticipant(VideoParticipantRequest $request)
    {
        if ($request->type == 'email') {
            $user = User::where('email', $request->email)->first();
            $this->saveParticipant($user->id, $request->assetId);
        } else {
            $bookingParticipants = BookingParticipants::where('booking_id', $request->booking_id)->get();
            foreach ($bookingParticipants as $one) {
                $this->saveParticipant($one->user_id, $request->assetId);
            }
        }

        return $this->getParticipant($request->assetId);
    }

    /**
     * Save Participant
     *
     * @param $userId
     * @param $assetId
     */
    public function saveParticipant($userId, $assetId)
    {
        if ($this->checkParticipant($userId, $assetId)) {
            $userAssets = UserAssets::where('asset_id', $assetId)->first()->toArray();

            $userAssets['user_id'] = $userId;
            $userAssets['expires'] = date("Y-m-d H:i:s");
            $data = collect($userAssets)->except(['id', 'created_at', 'updated_at',]);

            UserAssets::create($data->toArray());
        }
    }

    /**
     * Check participant
     *
     * @param $userId
     * @param $assetId
     * @return bool
     */
    public function checkParticipant($userId, $assetId): bool
    {
        return UserAssets::where('asset_id', $assetId)->where('user_id', $userId)->count() == 0;
    }

    /**
     * Delete participant
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteParticipant(Request $request)
    {
        if (UserAssets::where('asset_id', $request->asset_id)->where('user_id', $request->user_id)->delete()) {
            return response('Ok', 200);
        } else {
            return response('Participant is not removed', 505);
        }
    }
}
