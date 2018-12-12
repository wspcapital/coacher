<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller,
    App\Http\Controllers\Traits\CountryTrait,
    App\Http\Controllers\Traits\CMSTrait;

/**
 * Class HomeController
 * @package App\Http\Controllers\User
 */
class HomeController extends Controller
{
    use CountryTrait;
    use CMSTrait;

    /**
     * Return home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('homepage.index');
    }

    /**
     * Return company page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompany()
    {
        return view('homepage.company')->with(['posts' => $this->getPost('company')]);
    }

    /**
     * Return services page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getServices()
    {
        return view('homepage.services')->with(['posts' => $this->getPost('services')]);
    }

    /**
     * Return how-are-we-different page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDifferent()
    {
        return view('homepage.how-we-are-different')->with(['posts' => $this->getPost('how-are-we-different')]);
    }

    /**
     * Return events page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEvent()
    {
        return view('homepage.event')->with(['posts' => $this->getPost('events')]);
    }

    /**
     * Return contact page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContact()
    {
        return view('homepage.contact')->with([
            'country' => $this->getCountryList(),
            'post'   => $this->getOnePost('contact')
        ]);
    }

    public function postContact()
    {
        echo "Сделать отпарвку писем";
    }
}
