<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = array();
		$data['total_property'] = DB::table('property')->count();
		$data['featured_property'] = DB::table('property')->where('is_featured',1)->count();
		$data['sold_property'] = DB::table('property')->where('status','Sold')->count();
		$data['inactive_property'] = DB::table('property')->where('status','InActive')->count();
		$data['recent_properties'] = Property::limit(10)->orderBy('id','desc')->get();
        return view('backend/dashboard', $data);
    }
}
