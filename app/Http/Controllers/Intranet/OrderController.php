<?php

namespace App\Http\Controllers\Intranet;

use App\Models\{
    Assets,
    Lesson,
    OrderAssets,
    Order
};
use App\Models\Traits\LaratrustCustomTrait,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy,
    App\Http\Requests\OrderRequest,
    App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Class OrderController
 * @package App\Http\Controllers\Intranet
 */
class OrderController extends Controller
{
    use CustomFunction,
        LaratrustCustomTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllOrders()
    {
        return view('intranet.orders');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewOrder()
    {
        return view('intranet.new-order');
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOneOrder(Order $order)
    {
        if ($order->type == 'Video') {
            $vpr = $order->getVpr();
            $view = "intranet.order-video";
            $orderAssets = $order->getVCoachVideo();
        } else {
            $view = "intranet.order-session";
            $pdf = Lesson::where('title', $order->getIna('functionality'))->first();
        }

        return view($view)
            ->with(['order' => $order,
                'orderAssets' => $orderAssets ?? null,
                'pdf' => $pdf ?? null,
                'vpr' => $vpr ?? null,
                'trainers' => $this->getTrainersList(),
                'timezone' => $this->getTimeZoneList('({p}) {t}')]);
    }

    /**
     * Update Post
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveVideoOrder(OrderRequest $request, Order $order)
    {
        if ($request->vpr) {
            $oldVpr = $order->getVpr();
            if ($oldVpr != null) {
                Assets::deleteFile($oldVpr->assets_id);
            }
            $asset = Assets::create(['user_id' => Auth::user()->id, 'type' => 'pdf']);
            OrderAssets::create([
                'orders_id' => $request->order_id,
                'assets_id' => $asset->id,
                'title' => $request->vpr->getClientOriginalName(),
                'category_id' => 5
            ]);

            $asset->addMedia($request->vpr)->toCollection('vpr');
        }

        $data = $request->except('_token', 'order_id', 'vpr', 'close');

        if ($request->order_trainer_id == 0) {
            $data['order_trainer_id'] = null;
        } else {
            $data['status'] = 2;
        }
        if ($request->close) {
            $data['status'] = 3;
        }

        $order->update($data);
        Flashy::message('Virtual Coach Order saved');

        return redirect()->back();
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSessionOrder(OrderRequest $request, Order $order)
    {
        $data = $request->except('_token', 'order_id', 'close');
        if ($request->order_trainer_id == 0) {
            $data['order_trainer_id'] = null;
        } else {
            $data['status'] = 1;
        }
        if ($request->due_at) {
            $data['due_at'] = Carbon::parse($request->due_at)->format('Y-m-d H:m:s');
            $data['status'] = 2;
        } else {
            $data['due_at'] = null;
        }
        if ($request->close) {
            $data['status'] = 3;
        }
        $order->update($data);
        Flashy::message('Virtual Coach Order saved');

        return redirect()->back();
    }

    /**
     * Create Post
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOrder(OrderRequest $request)
    {
        $order = Order::create($request->all());

        Flashy::message('Virtual Coach Order saved');
        return redirect()->route(['order', $order->id]);
    }
}
