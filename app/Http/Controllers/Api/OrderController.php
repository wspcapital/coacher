<?php

namespace App\Http\Controllers\Api;

use App\Models\{
    Assets,
    Order
};
use App\Models\Traits\LaratrustCustomTrait,
    Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    Illuminate\Support\Facades\Input;

/**
 * Class OrderController
 * @package App\Http\Controllers\Api
 */
class OrderController extends Controller
{
    use LaratrustCustomTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getAllOrders(Request $request)
    {
        $orders = Order::with(['bookingParticipant.booking.rm', 'bookingParticipant.user', 'orderTrainer']);
        switch ($request->input('status')) {
            case 'open':
                $orders = $orders->where('status', '>', '0')->where('status', '!=', '3')->paginate(20);
                break;
            case 'closed':
                $orders = $orders->where('status', '=', '3')->paginate(20);
                break;
            case 'unsubmitted':
                $orders = $orders->where('status', '=', '-1')->paginate(20);
                break;
            default:
                $orders = $orders->where('status', '=', '0')->paginate(20);    ////// new orders
                break;
        }

        foreach ($orders as $one) {
            $one->beforeTrainer = $one->beforeTrainer->user ?? null; ///////   ?????
        }

       // dd($orders);
        return [
            'orders' => $orders,
            'trainers' => $this->getTrainersList()
        ];
    }

    /**
     * @param Order $order
     * @return mixed|null
     */
    public function saveTrainer(Order $order)
    {
        $trainerId = Input::get('order_trainer_id');
        if ($order->order_trainer_id != null) {
            $beforeTrainer = $order->saveBeforeOrderTrainer();
            $beforeTrainer = $beforeTrainer->user;
        } else {
            $beforeTrainer = null;
        }
        $data = [
            'order_trainer_id' => $trainerId,
            'status' => 1
        ];
        $order->update($data);

        return $beforeTrainer;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function searchOrder(Request $request)
    {
        $orders = Order::search($request->q)
            ->with(['bookingParticipant.booking.rm', 'bookingParticipant.user', 'orderTrainer'])->paginate(20);

        foreach ($orders as $one) {
            $one->beforeTrainer = $one->beforeTrainer->user ?? null; ///////   ?????
        }
        return [
            'orders' => $orders,
            'trainers' => $this->getTrainersList()
        ];
    }

    /**
     * @param Request $request
     */
    public function deleteOrder(Request $request)
    {
        $order = Order::find($request->orderId);
        foreach ($order->orderAssets as $one) {
            Assets::deleteFile($one->assets_id);
        }
        $order->delete();
    }
}
