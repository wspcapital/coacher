<?php

namespace App\Http\Controllers\Traits;

use App\Models\Assets,
    App\Models\UserAssets,
    Illuminate\Support\Facades\Config,
    Illuminate\Support\Facades\Auth;
use App\Models\BookingAssets;
use App\Models\DocVideo;

/**
 * Class AssetsTrait
 * @package App\Models\Traits
 */
trait AssetsTrait
{
    /**
     * image extension
     *
     * @var array
     */
    private $imageExtension;

    /**
     * video extension
     *
     * @var array
     */
    private $videoExtension;

    /**
     * other extension
     *
     * @var array
     */
    private $otherExtension;

    /**
     * Title for workshop videos
     * @var array
     */
    public $workshop_titles = [
        'Active Listening (no distractions)',
        'Active Listening (with distractions)',
        'Being Assertive',
        'Breathing for Sound',
        'Bringing Vibrations Forward',
        'Clear Speech and Diction',
        'Co-Facilitation (optional)',
        'Communicating Across Cultures',
        'Consonants',
        'Courtesy Under Fire',
        'Delivering Difficult News',
        'Delivering Feedback',
        'Diagnosis/Intervention',
        'Facilitating a Brainstorming Meeting',
        'Facilitating a Problem-Solving Meeting',
        'Facilitator\'s Challenge',
        'Finding your Core Breath',
        'Finding your Home Base Position',
        'Gaining Commitment from Senior Leaders (optional exercise)',
        'Gaining Commitment from Senior Leadership',
        'Games',
        'Handling Difficult Questions',
        'Initial Meeting',
        'Intention Battle',
        'Jaw',
        'Kicking off a Meeting',
        'Leading your Team through Change',
        'Lips',
        'Luck of the Draw',
        'Master Closing',
        'Master Introduction',
        'Memorization',
        'Out of the Box',
        'Owning Language',
        'Partner Introduction',
        'Personal Introduction',
        'Pitch for Meaning',
        'Positioning Statement',
        'Practical Simulation',
        'Rounding Vowels and Defining Consonants',
        'Simulated Negotiations',
        'Simulated Phone Conversations',
        'Conference Call Exercise',
        'Soft Palate',
        'Spontaneous Gestures',
        'Storytelling',
        'Taking the Stage',
        'The 5 Keys to a Master Introduction',
        'Tongue',
        'Utilizing Pace',
        'Virtual Meetings',
        'Vowel Placement Practice',
        'Warming up Your Instrument',
        'The Pinnacle Method Part 1',
        'The Pinnacle Method Part 2',
        'Effective Facilitation for Trainers',
        'Taking Care of Business',
    ];

    /**
     * Title for learning videos
     * @var array
     */
    public $learning_titles = [
        'The Pinnacle Method Part 1',
        'The Pinnacle Method Part 2',
        'Face, Base and Pace',
        'Handling Difficult Questions',
        'Effective Facilitation for Trainers',
        'Tips when Co-Facilitating',
        'Running Effective Meetings',
        'Active Listening',
        'Effective Storytelling',
        'Gestures and Movement',
        'Intention and Objective',
        'Overcoming Stage fright',
        'Vocal Dynamics',
        'Storytelling for Business',
        'Delivering Feedback Effectively',
        'Successful Negotiating',
        'Impromptu Speaking',
        'Crafting and Structuring your Content',
        'Being Assertive',
        'Communicating Change Effectively',
        'Defining your personal brand',
        'Executive Presence',
        'Leadership Communication',
        'Managing Difficult Conversations',
        'Presenting to Senior Leadership',
    ];

    /**
     * upload admin video (user page)
     *
     * @param $request
     * @param $userId
     * @param $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function uploadAdminVideo($request, $userId, $categoryId)
    {
        $assetId = $this->uploadVideo($request->video, $userId);
        $userAsset = UserAssets::create([
            'asset_id' => $assetId,
            'user_id' => $request->user_id,
            'type' => 'Admin',
            'category_id' => $categoryId,
            'expires' => date("Y-m-d H:i:s")
        ]);

        return $userAsset->where('category_id', $categoryId)->where('user_id', $request->user_id)
            ->with(['asset.media', 'asset.getDocVideos.docAssets.media'])->get();
    }

    /**
     * Upload video
     *
     * @param $video
     * @param $userId (Auth id)
     * @return int id
     */
    public function uploadVideo($video, $userId)
    {
        $asset = Assets::create(['user_id' => $userId, 'type' => 'Video']);
        $asset->addMedia($video)->toCollection('video');
        return $asset->id;
    }

    public function uploadVideoFile($data, $type)
    {
        $oldFile = Assets::find($data['asset_id']);
        if ($oldFile->getDocVideos != null) {
            Assets::deleteFile($oldFile->getDocVideos->doc_id);
        }
        $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => $type]);
        if ($type == 'Pdf') {
            $asset->addMedia($data['pdf'])->toCollection('videoDoc');
        } else {
            $asset->addMedia($data['doc'])->toCollection('videoDoc');
        }

        $doc = DocVideo::create([
            'file_id' => $data['asset_id'],
            'doc_id' => $asset->id,
            'user_id' => 1
        ]);
        return $doc->docAssets->media;
    }

    /**
     * Upload file from library
     *
     * @param UploadedFile $file
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadLibraryFile($file, $assetId)
    {
        if ($file != "undefined") {
            $type = $this->getAssetType($file);
            if (!$type) {
                return response('Error extension file', 503);
            }
            if ($assetId) {
                return $this->updateLibraryFile($file, $assetId, $type);
            } else {
                return $this->createLibraryFile($file, $assetId, $type);
            }
        } else {
            return "no file";
        }
    }

    /**
     * Update file from library
     *
     * @param UploadedFile $file
     * @param integer $assetId
     * @param string $type
     * @return array
     */
    public function updateLibraryFile($file, $assetId, $type): array
    {
        $asset = Assets::find($assetId);
        $mediaItems = $asset->getMedia();
        $mediaItems[0]->delete();
        $asset->addMedia($file)->toCollection('Library');
        $asset->update(['user_id' => Auth::user()->id, 'type' => $type]);
        $newAsset = Assets::find($assetId);
        $mediaItem = $newAsset->getMedia();
        return ['assets_id' => $assetId,
            'fileName' => $mediaItem[0]->file_name];
    }

    /**
     * Create file from library
     *
     * @param UploadedFile $file
     * @param integer $assetId
     * @param string $type
     * @return array
     */
    public function createLibraryFile($file, $assetId, $type): array
    {
        $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => $type]);
        $asset->addMedia($file)->toCollection('Library');
        $mediaItem = $asset->getMedia();
        return ['assets_id' => $asset->id,
            'fileName' => $mediaItem[0]->file_name];
    }

    /**
     * Return extension file or false
     *
     * @param UploadedFile $file
     * @return string|bool
     */
    public function getAssetType($file)
    {
        $extension = $file->getClientOriginalExtension();
        $this->getConfigExtension();
        if (in_array($extension, $this->imageExtension['extension'])) {
            return $this->imageExtension['type'];
        } elseif (in_array($extension, $this->videoExtension['extension'])) {
            return $this->videoExtension['type'];
        } elseif (in_array($extension, $this->otherExtension['extension'])) {
            return $this->otherExtension['type'][$extension];
        } else {
            return false;
        }
    }

    /**
     * Get all extension file from config
     *
     * @Return void
     */
    public function getConfigExtension()
    {
        $this->imageExtension = $this->getArrayImageExtension();
        $this->videoExtension = $this->getArrayVideoExtension();
        $this->otherExtension = $this->getArrayOtherExtension();
    }

    /**
     * Return extension image from config/library.php
     * @return array
     */
    public function getArrayImageExtension(): array
    {
        return Config::get('library.image');
    }

    /**
     * Return extension video from config/library.php
     * @return array
     */
    public function getArrayVideoExtension(): array
    {
        return Config::get('library.video');
    }

    /**
     * Return extension other from config/library.php
     * @return array
     */
    public function getArrayOtherExtension(): array
    {
        return Config::get('library.other');
    }

    public function uploadBookingFile($data)
    {
        // $assetId = $this->uploadVideo($data['file'], $userId);
        $asset = $this->saveBookingFile($data);
        if (is_array($asset)) {
            $bookingAsset = BookingAssets::create([
                'asset_id' => $asset['asset_id'],
                'booking_id' => $data['booking_id'],
            ]);

            return $bookingAsset->with('assets.media')->latest('created_at')->first();
        } else {
            return $asset;
        }
    }

    public function saveBookingFile($data)
    {
        if ($data['file'] != "undefined") {
            $type = $this->getAssetType($data['file']);
            //dd($type);
            if (!$type) {
                return response('Error extension file', 503);
            } else {
                $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => $type]);
                $asset->addMedia($data['file'])->toCollection('booking');
                $mediaItem = $asset->getMedia();
                return ['asset_id' => $asset->id,
                    'fileName' => $mediaItem[0]->file_name];
            }
        } else {
            return "no file";
        }
    }

    public function saveDdpFile($data)
    {
        if ($data['file'] != "undefined") {
            $type = $this->getAssetType($data['file']);
            //dd($type);
            if (!$type) {
                return response('Error extension file', 503);
            } else {
                $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => $type]);
                $asset->addMedia($data['file'])->toCollection('ddp');
                $mediaItem = $asset->getMedia();
                return ['asset_id' => $asset->id,
                    'fileName' => $mediaItem[0]->file_name];
            }
        } else {
            return "no file";
        }
    }

    /**
     * Save user avatar
     *
     * @param object $file
     * @param object $user
     */
    public function saveUserAvatar($file, $user)
    {
        $asset = Assets::create(['user_id' => $user->id, 'type' => 'image']);
        $user->asset_id = $asset->id;
        $user->save();
        $asset->addMedia($file)->toCollection('avatar');
    }

    public function getWorkshopTitles(): array
    {
        return $this->workshop_titles;
    }

    public function getLearningTitles(): array
    {
        return $this->learning_titles;
    }
}
