<?php

namespace App\Http\Controllers\Intranet;

use App\Events\NewIntranetMessageEvent,
    App\Http\Controllers\BaseChatController,
    App\Models\Chat,
    Illuminate\Http\Request;

/**
 * Class ChatController
 * @package App\Http\Controllers\Intranet
 */
class ChatController extends BaseChatController
{

    /**
     * @param $addressee
     * @return $this
     */
    public function getIntranetChat($addressee)
    {
        $messages = Chat::where('addressee', $addressee)
            ->where('author', $this->authUserId)
            ->orWhere('addressee', $this->authUserId)
            ->where('author', $addressee)
            ->with(['userAuthor', 'userAddressee'])
            //->orderBy('created_at', 'desc')
            ->get();

        return view('intranet.chat')->with([
            'messages' => $messages,
            'user_id' => $this->authUserId,
            'addressee' => $addressee
        ]);
    }

    /**
     * @param Request $request
     */
    public function saveIntranetMessage(Request $request)
    {
        $message = Chat::create([
            //'author' => Auth::user()->id,
            'author' => $request->author,
            'message' => $request->message,
            'addressee' => $request->addressee
        ]);

        event(
            new NewIntranetMessageEvent($message)
        );

        dd($message->with(['userAuthor', 'userAddressee'])->get());
    }
}
