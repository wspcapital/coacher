<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 26.01.17
 * Time: 17:20
 */

namespace App\Helpers\Transfer;

use App\Models\Assets;
use App\Models\User;
use App\Models\UserAssistants;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserTransfer extends Transfer
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function transfer($user, $type = null)
    {
        $trans = new UserTransfer($user);
        if ($type == null) {
            $trans->insertUsers();
        } else {
            $trans->insertAssistant();
        }
    }

    public function insertUsers()
    {
        $data = [
            'id' => $this->user->id,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at,
            'workshop_expires_at' =>
                ($this->user->workshop_expires_at == '0000-00-00 00:00:00') ? null : $this->user->workshop_expires_at,
            'session_at' => ($this->user->session_at == '0000-00-00 00:00:00') ? null : $this->user->session_at,
            'login_at' => ($this->user->login_at == '0000-00-00 00:00:00') ? null : $this->user->login_at,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'passtext' => $this->user->passtext,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'asset_id' => $this->user->asset_id,   /////
            'company' => $this->user->company,
            'title' => $this->user->title,
            'website' => $this->user->website,
            'address1' => $this->user->address1,
            'address2' => $this->user->address2,
            'city' => $this->user->city,
            'state' => $this->user->state,
            'zip' => $this->user->zip,
            'phone' => $this->user->phone,
            'fax' => $this->user->fax,
            'country' => $this->user->country,
            'color' => $this->user->color,
            'blocked' => $this->user->blocked ?? '0'
        ];

        $insertUser = User::create($data);
        //// Roles
        if ($this->user->is_admin) {
            $insertUser->attachRole(1);
        }
        if ($this->user->is_rm) {
            $insertUser->attachRole(2);
        }
        if ($this->user->is_trainer) {
            $insertUser->attachRole(3);
        }
        $insertUser->attachRole(4);

        if ($this->user->asset_id) {
            echo $this->user->id . " - Assets";
            $this->saveAvatar();
        }
    }

    public function insertAssistant()
    {
        $data = [
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at,
            'user_id' => $this->user->id,
            'assistant_user_id' => $this->user->assistant_id
        ];

        UserAssistants::create($data);
    }

    public function saveAvatar()
    {
        $asset = DB::connection('pinnacle')->table('assets')->find($this->user->asset_id);

        $assetNew = Assets::create([
            'id' => $asset->id,
            'user_id' => $this->user->id,
            'type' => 'image'
        ]);

        $url = 'https://pinper.com/assets/images/' . $this->user->id . "/" . $asset->filename;

        $file_headers = @get_headers($url);    /////  file_exist
        if (false !== strpos($file_headers[0], '200 OK')) {
            $uploadPath = 'avatar/trans/' . $assetNew->id . '/' . $asset->filename;
            $this->saveFile($url, $uploadPath, $assetNew, $asset->filename);
            // return view('test');
        }
    }

    public function saveFile($pathFile, $uploadPath, $asset, $filename)
    {
        $contents = file_get_contents($pathFile);
        Storage::put($uploadPath, $contents);

        $file = new UploadedFile(
            storage_path("app/public/upload/avatar/trans/$asset->id/$filename"),
            $filename,
            'image/jpeg',
            Storage::size($uploadPath),
            null,
            true
        );
        $asset->addMedia($file)->toCollection('avatar');
        Storage::deleteDirectory('avatar/trans');
        // dd($file);
    }
}
