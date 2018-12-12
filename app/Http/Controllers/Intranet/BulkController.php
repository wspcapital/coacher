<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Support\Facades\{
    Auth,
    View
};
use App\Http\Controllers\Traits\CustomFunction,
    App\Http\Requests\StoreBulkPostRequest,
    App\Models\Booking,
    App\Models\Traits\LaratrustCustomTrait,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy;

/**
 * Class BulkController
 * @package App\Http\Controllers\Intranet
 */
class BulkController extends Controller
{
    use LaratrustCustomTrait,
        CustomFunction;

    /**
     * @return\Illuminate\View\View
     */
    public function getAllBulks()
    {
        return view('intranet.bulks');
    }

    public function getNewBulk()
    {
        return view('intranet.new-bulk')->with([
            'rm' => $this->getManagerListArray(),
            'country' => $this->country(),
            'state' => $this->state()
        ]);
    }

    /**
     * @param $id
     * @return View
     */
    public function getOneBulk($id)
    {
        $view = 'intranet.bulk';
        $bulk = Booking::where('id', '=', $id)->where('type', '=', 'Bulk')->first();
        if ($bulk == null) {
            return abort(404);
        }

        return view($view)->with([
            'bulk' => $bulk,
            'rm' => $this->getManagerListArray(),
            'country' => $this->country(),
            'state' => $this->state()
        ]);
    }

    /**
     * Create Bulk
     *
     * @param StoreBulkPostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createBulk(StoreBulkPostRequest $request)
    {
        $data = $request->except('_token');
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = date('Y-m-d');
        $data['booker_user_id'] = Auth::user()->id;
        $data['type'] = 'Bulk';
        //$data['vcoaches'] = 0;
        //$data['sessions'] = 0;
        if ($request->rm_user_id == "") {
            $data['rm_user_id'] = null;
        }

        $bulk = Booking::create($data);

        Flashy::message('Bulk create');
        return redirect()->route('bulk', $bulk->id);
    }

    /**
     * @param StoreBulkPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveBulk(StoreBulkPostRequest $request)
    {
        $data = $request->except('_token', 'bulk_id');
        if ($request->rm_user_id == "") {
            $data['rm_user_id'] = null;
        }
        Booking::where('id', $request->bulk_id)
            ->update($data);
        Flashy::message('Bulk update');

        return redirect()->back();
    }
}
