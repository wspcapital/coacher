<?php

namespace App\Http\Controllers\Intranet;

use App\Models\Payment,
    App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function getPaymentsList()
    {
        return view('intranet.payments-list')->with([
           'payments' => Payment::paginate(20)
        ]);
    }
}
