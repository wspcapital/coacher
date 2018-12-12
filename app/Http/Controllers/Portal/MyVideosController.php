<?php

namespace App\Http\Controllers\Portal;

use App\Models\{
    Assets,
    Order,
    BookingParticipants,
    UserAssets,
    OrderAssets
};
use Illuminate\Support\Facades\{
    Mail, Auth, View
};
use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy,
    App\Mail\Portal\VideoUploaded,
    App\Http\Controllers\Traits\CMSTrait,
    App\Http\Requests\AssetRequest;

/**
 * Class MyVideosController
 * @package App\Http\Controllers\Portal
 */
class MyVideosController extends Controller
{
    use CMSTrait;

    /**
     * @return View
     */
    public function getIndex()
    {
        $videos = [];
        $videos['virtual-coach'] = null;
        $b = BookingParticipants::where('user_id', Auth::user()->id)->with(['orders' => function ($query) {
            $query->where('type', 'Video')->get();
        }])->get();
        foreach ($b as $one) {
            foreach ($one->orders as $order) {
                if ($order->orderAssets->count() > 0) {
                    $videos['virtual-coach'][] = [
                        'video' => $order->getVCoachVideo(),
                        'vpr' => $order->getVpr()
                    ];
                } else {
                    $videos['virtual-coach'] = null;
                }
            }
        }

        $videos['workshop'] = UserAssets::allWorkshopVideo(Auth::user()->id);
        $videos['learning'] = UserAssets::allLearningVideo(Auth::user()->id);
        $videos['webinar'] = UserAssets::allWebinarVideo(Auth::user()->id);

        return view('portal.my-videos')->with([
            'videos' => $videos,
            'posts' => $this->getPost('faqs')
        ]);
    }

    /**
     * @param AssetRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadVideo(AssetRequest $request)
    {
        $bookingParticipant = BookingParticipants::where('user_id', Auth::user()->id)->latest('created_at')->first();
        if (!$bookingParticipant->id) {
            return response('Error! Booking absent', 502);
        } else {
            $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => 'Video']);
            $asset->addMedia($request->video)->toCollection('video');

            $order = Order::create(['type' => 'Video',
                'booking_participants_id' => $bookingParticipant->id,
                'source' => 'Portal',
                'status' => -1
            ]);

            Auth::user()->useVCoach();  /// use one credit
            Mail::send(new VideoUploaded($order));

            $orderAssets = OrderAssets::create(['category_id' => 1,
                'orders_id' => $order->id,
                'assets_id' => $asset->id
            ]);

            return $orderAssets->id;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $orderAssets = OrderAssets::find($request->orderAssetId);
        $orderAssets->title = $request->title;
        $orderAssets->orders->status = 0;
        $orderAssets->save();
        $data = ['ina' => $request->except(['_token', 'orderAssetId'])];
        $data['ina'] = [
            'title' => trim(str_replace("\r\n", null, $data['ina']['title'])),
            'whoisfor' => trim(str_replace("\r\n", null, $data['ina']['whoisfor'])),
            'challenge' => trim(str_replace("\r\n", null, $data['ina']['challenge'])),
            'takeaway' => trim(str_replace("\r\n", null, $data['ina']['takeaway'])),
            'react' => trim(str_replace("\r\n", null, $data['ina']['react'])),
            'misc' => trim(str_replace("\r\n", null, $data['ina']['misc'])),
        ];

        $data['ina']['workshop'] = $request->workshop ?? '0';
        $orderAssets->orders->data = json_encode($data);
        $orderAssets->orders->save();

        $message = 'Your video and needs analysis form have been submitted for review.
         You will be assigned a Coach, who will review your video and compile a Virtual Performance Report.';
        $request->session()->flash('success', $message);

        Flashy::message('Success!');
        return redirect()->back();
    }
}
