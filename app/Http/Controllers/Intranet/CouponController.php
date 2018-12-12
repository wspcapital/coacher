<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Requests\CouponRequest,
    App\Models\Coupon,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy,
    Illuminate\Support\Facades\View;

/**
 * Class CouponController
 * @package App\Http\Controllers\Intranet
 */
class CouponController extends Controller
{
    /**
     * @return View
     */
    public function getCoupon()
    {
        return view('intranet.coupon')->with(['coupons' => Coupon::paginate(20)]);
    }

    /**
     * @param CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCoupons(CouponRequest $request)
    {
        switch ($request->type) {
            case 'discount':
                $fields = ['type', 'discount'];
                break;
            case 'free':
                $fields = ['type', 'vcoaches', 'sessions'];
                break;
            default:
                $fields = [];
                break;
        }

        $count = intval($request->quantity);

        with(new Coupon)->generateCoupon($request->only($fields), $count);

        Flashy::message($count . ' was successfully generated.');
        return redirect()->back();
    }
}
