<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Traits\CMSTrait,
    App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class VCoachController
 * @package App\Http\Controllers\User
 */
class VCoachController extends Controller
{
    use CMSTrait;

    /**
     *  Return index vcoach page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('vcoach.index')->with(['posts' => $this->getArrayPost('vcoach')]);
    }

    /**
     * Return about page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAbout()
    {
        return view('vcoach.about')->with([
            'title' => 'about us',
            'posts' => $this->getArrayPost('about')
        ]);
    }


    /**
     * Return features page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeatures()
    {
        return view('vcoach.features')->with([
            'title' => 'features',
            'post'  => $this->getOnePost('features')
        ]);
    }

    /**
     * Return prices page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPrices()
    {
        return view('vcoach.prices')->with(['title' => 'prices']);
    }

    public function postPrices(Request $request)
    {
        $validator = Validator::make(Input::all(), ['items' => 'required|array']);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::to('/vcoach/sign-up')->with('items', Input::get('items'));
    }

    /**
     * Return how-it-works page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHowItWorks()
    {
        return view('vcoach.how-it-works')->with([
                    'title' => 'how it works',
                    'posts' => $this->getPost('how-it-works')
        ]);
    }

    /**
     * Return faqs page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFaqs()
    {
        return view('vcoach.faqs')->with([
                        'title' => 'faqs',
                        'posts' => $this->getPost('faqs')
        ]);
    }

    /**
     * Return terms page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTerms()
    {
        return view('vcoach.terms')->with([
                        'title' => 'Terms',
                        'post' => $this->getOnePost('vcoach/terms')
        ]);
    }

    /**
     * Return contact page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContact()
    {
        return view('vcoach.contact')->with([
                        'title' => 'contact',
                        'post'  => $this->getOnePost('vcoach/contact')
        ]);
    }

    public function getSignUp()
    {
        return view('vcoach.sign-up')->with([
                        'title' => 'registration'
        ]);
    }
}
