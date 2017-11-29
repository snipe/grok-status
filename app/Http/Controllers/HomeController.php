<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceGroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->current_account) {
            $servicegroups = ServiceGroup::with('services', 'incidents')->get();
            return view('welcome')->with('servicegroups',$servicegroups);
        }
        return view('welcome');
    }
}
