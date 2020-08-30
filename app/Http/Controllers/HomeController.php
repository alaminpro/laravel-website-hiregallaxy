<?php

namespace App\Http\Controllers;

use App\Models\SiteReview;

class HomeController extends Controller
{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()
    {

        return view('home');

    }

    public function Testimonial()
    {
        $reviews = SiteReview::where('is_confirmed', 1)->get();
        return view('frontend.pages.testimonial.index', compact('reviews'));

    }

}
