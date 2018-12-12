<?php

namespace App\Http\Controllers\Portal;

use App\Models\{
    Chat, Lesson, Order
};
use App\Http\Controllers\Traits\{
    OrderTrait,
    CustomFunction
};
use Illuminate\Support\Facades\{
    Mail, Auth, View
};
use App\Http\Controllers\Controller,
    Illuminate\Http\Request,
    MercurySeries\Flashy\Flashy,
    App\Http\Requests\SessionRequest,
    Carbon\Carbon,
    App\Mail\Portal\VCoachSessionRequest;

/**
 * Class VCoachController
 * @package App\Http\Controllers\Portal
 */
class VCoachController extends Controller
{
    use OrderTrait,
        CustomFunction;

    /**
     * @return View
     */
    public function getIndex()
    {
        $statusVideoChat = false;
        $orders = $this->getUserOrder('Session');
        foreach ($orders as $order) {
            if ($order->due_at != null) {
                if (Carbon::parse($order->due_at)->format('Y-m-d') == Carbon::now()->format('Y-m-d')) {
                    $statusVideoChat = true;
                }
            }
        }

        return view('portal.vcoach-bridge')->with([
            'orders' => $orders,
            'timezone' => $this->getTimeZoneList('({p}) {t}'),
            'lessons' => Lesson::select('title')->get(),
            'scheduled' => $this->getScheduled(),
            'chatStatus' => Chat::where('addressee', Auth::user()->id)->count(),
            'statusVideoChat' => $statusVideoChat
        ]);
    }

    /**
     * @param SessionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSession(SessionRequest $request)
    {
        $data = ['ina' => $request->except(['_token', 'timezone'])];
        $order = Order::create([
            'booking_participants_id' => Auth::user()->getParticipantId(),
            'type' => 'Session',
            'source' => 'Portal',
            'timezone' => $request->timezone,
            'data' => json_encode($data)
        ]);

        Auth::user()->useSession();   /// use credit CreditsTrait

        Mail::to(Auth::user())
            ->send(new VCoachSessionRequest($order));

        Flashy::message('Session create');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSession(Request $request)
    {
        $data = ['ina' => $request->except(['_token'])];
        Order::where('id', $request->order_id)->update(['data' => json_encode($data)]);
        Flashy::message('Session update');

        return redirect()->back();
    }
}
