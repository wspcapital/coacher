<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request,
    App\Models\Traits\LaratrustCustomTrait,
    App\Http\Controllers\Traits\CustomFunction,
    App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    use LaratrustCustomTrait,
        CustomFunction;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCalendar()
    {
        /*foreach ($this->getAdminList() as $admin) {
            $users[$admin->id] = $admin->full_name;
        }
        foreach ($this->getManagerList() as $rm) {
            $users[$rm->id] = $rm->full_name;
        }
        foreach ($this->getTrainersList() as $trainer) {
            $users[$trainer->id] = $trainer->full_name ;
        }

        dd($this->getAssistantListArray());*/

        return view('intranet.calendar')->with([
            'users' => $this->getAssistantListArray()
        ]);
    }
}
