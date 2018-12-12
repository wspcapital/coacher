<?php

namespace App\Models\Traits;

use App\Http\Controllers\Traits\AssetsTrait;
use App\Models\{
    Assets,
    User
};

trait UserTrait
{
    use AssetsTrait;

    public function generatePassword($length = 8)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public function createUser(array $data)
    {
        $password = $this->generatePassword(8);
        $data['password'] = bcrypt($password);
        $data['passtext'] = $password;
        return User::create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rm()
    {
        return $this->belongsTo(User::class, 'rm_id');
    }

    public function getTrainer()
    {
        if ($this->getTrainerObj() != null) {
            return $this->getTrainerObj()->full_name;
        } else {
            return '';
        }
    }

    public function getTrainerObj()
    {
        if (!$this->bookingParticipant->isEmpty()) {
            if (!$this->bookingParticipant->first()->bookingTrainer == null) {
                return $this->bookingParticipant->first()->bookingTrainer->user;
            }
        }
    }

    public function getRm()
    {
        if (!$this->bookingParticipant->isEmpty()) {
            if ($this->bookingParticipant->first()->booking != null) {
                if ($this->bookingParticipant->first()->booking->rm_user_id != null) {
                    if ($this->bookingParticipant->first()->booking->rm != null) {
                        return $this->bookingParticipant->first()->booking->rm->full_name;
                    }
                }
            }
        }
    }

    public function getParticipantId()
    {
        if ($this->bookingParticipant->count() > 0) {
            return $this->bookingParticipant()->latest('created_at')->first()->id;
        } else {
            return false;
        }
    }

    public function saveAvatar($file)
    {
        if ($this->asset_id != null) {
            Assets::deleteFile($this->asset_id);
        }
        $this->saveUserAvatar($file, $this);
    }

    public function getAvatar()
    {
        if ($this->asset_id != null) {
            return $this->assets->getMedia()[0]->getUrl();
        } else {
            return null;
        }
    }

    public function getBio()
    {
        return $this->data->bio ?? null;
    }
}
