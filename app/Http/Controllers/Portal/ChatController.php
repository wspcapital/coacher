<?php

namespace App\Http\Controllers\Portal;

use App\Events\NewPortalMessageEvent,
    App\Http\Controllers\BaseChatController,
    App\Models\Chat,
    Illuminate\Http\Request,
    Illuminate\Support\Facades\View;

/**
 * Class ChatController
 * @package App\Http\Controllers\Portal
 */
class ChatController extends BaseChatController
{
    /**
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function getPortalChat()
    {
        $lastMessage = Chat::where('addressee', $this->authUserId)->orderBy('created_at', 'desc')->first();
        if (isset($lastMessage->id)) {
            $author = $lastMessage->author;
            $messages = Chat::where('addressee', $author)
                ->where('author', $this->authUserId)
                ->orWhere('addressee', $this->authUserId)
                ->where('author', $author)
                ->with(['userAuthor', 'userAddressee'])
                ->get();
            return view('portal.chat')->with([
                'messages' => $messages,
                'user_id' => $this->authUserId,
                'addressee' => $messages->first()->addressee
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function savePortalMessage(Request $request)
    {
        $message = Chat::create([
            'author' => $request->author,
            'message' => $request->message,
            'addressee' => $request->addressee
        ]);

        event(
            new NewPortalMessageEvent($message)
        );

        return $message;
    }
}
