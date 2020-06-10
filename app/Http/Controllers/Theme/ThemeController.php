<?php

namespace App\Http\Controllers\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;
use Session;
use App\Mail\ContactUs;
use App\Mail\ContactAgent;
use App\Utilities\Overrider;
use App\Property;
use App\Blog;
use App\BlogCategory;
use App\Agent;
use App\Faq;

class ThemeController extends Controller
{
	private $ACTIVE_THEME = 'reallepageexcellence';

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the website home page.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
				$data = array();
				$data['currency'] = currency();
				$data['sliders'] = Property::where('is_featured',1)->get();
				// $data['properties'] = Property::where('is_featured',1)->get();
				$data['properties'] = DB::table('property')
	            ->join('locations', 'locations.id', '=', 'property.location_id')
	            ->join('property_types', 'property_types.id', '=', 'property.property_type_id')
	            ->select('property.*', 'locations.name as location', 'property_types.type_fr as type_fr', 'property_types.type_en as type_en')
							->where("status","!=","InActive")
							->where('is_featured',1)
							->get();
				$data['recent_blogs'] = Blog::orderBy('id','desc')->limit(3)->get();
				$data['recent_agents'] = Agent::orderBy('id','desc')->limit(3)->get();

				if ($request->input('action') == "send_buyers_guide") {
					$first_name = $request->input("first_name");
					$last_name = $request->input("last_name");
					$email = $request->input("email");

					$message = '<br><br>'._lang('You can download your guide by clicking follwoing link.');
					$message .= '<br><a href="'.url('public/uploads/RLP_acheteur_v2.pdf').'">'._lang('Download guide').'</a>';

					$mail  = new \stdClass();
					$mail->name = $first_name." ".$last_name;
					$mail->email = $email;
					$mail->subject = "Download guide";
					$mail->message = $message;

					Mail::to($email)->send(new ContactUs($mail));
				}

				if ($request->input('action') == "send_sellers_guide") {
					$first_name = $request->input("first_name");
					$last_name = $request->input("last_name");
					$email = $request->input("email");

					$message = '<br><br>'._lang('You can download your guide by clicking follwoing link.');
					$message .= '<br><a href="'.url('public/uploads/RLP_vendeur_v2.pdf').'">'._lang('Download guide').'</a>';

					$mail  = new \stdClass();
					$mail->name = $first_name." ".$last_name;
					$mail->email = $email;
					$mail->subject = "Download guide";
					$mail->message = $message;

					Mail::to($email)->send(new ContactUs($mail));
				}

        return view('theme/'.$this->ACTIVE_THEME.'/index',$data);
		}

	public function property($id = '', $title = '')
    {
		$data = array();
		$lat = '45.3058';
		$long = '-73.2545';
		$data['geolat'] = $lat;
		$data['geolong'] = $long;
		$data["query_value"] = "";
		$data['currency'] = currency();
		if($id == '' && $title == ''){
			$data['properties'] = DB::table('property')
            ->join('locations', 'locations.id', '=', 'property.location_id')
            ->join('property_types', 'property_types.id', '=', 'property.property_type_id')
            ->select('property.*', 'locations.name as location', 'property_types.type_fr as type_fr', 'property_types.type_en as type_en')
						->where("status","!=","InActive")->paginate(6);

			// $query = "SELECT
			//   *, (6371 * acos( cos( radians($lat) ) * cos( radians(map_latitude) ) *
      //   cos( radians(map_longitude) - radians($long)) + sin(radians($lat)) *
      //   sin(radians(map_latitude)) )) as distance
			// FROM property
			// HAVING distance < 200000
			// ORDER BY distance
			// ";

			// $query = "SELECT * FROM property";
			// $map_properties = DB::select( DB::raw($query) );
			// // print_r($map_properties);die();
			// $data["map_properties"] = $map_properties;
			return view('theme/'.$this->ACTIVE_THEME.'/properties',$data);
		}else{

			$data['property'] = Property::where('id',$id)->where("status","!=","InActive")->first();
			if (!isset($data['benefits_aggr'])) {
				$data['benefits_aggr'] = array(
					"en"=>[],
					"fr"=>[]
				);
			}
			foreach($data['property']->benefits as &$benefit) {

				if (empty($data['benefits_aggr']["fr"][$benefit->name_fr])) {
					$data['benefits_aggr']["fr"][$benefit->name_fr] = $benefit->info_fr;
				} else {
					$data['benefits_aggr']["fr"][$benefit->name_fr] .= ", ".$benefit->info_fr;
				}


				if (empty($data['benefits_aggr']["en"][$benefit->name_en])) {
					$data['benefits_aggr']["en"][$benefit->name_en] = $benefit->info_en;
				} else {
					$data['benefits_aggr']["en"][$benefit->name_en] .= ", ".$benefit->info_en;
				}

			}
			$geocode_lat = $data['property']->map_latitude;
			$geocode_long = $data['property']->map_longitude;
			$query = "SELECT property.*, (3959 * acos( cos( radians($geocode_lat) ) * cos( radians(map_latitude) ) *
			cos( radians(map_longitude) - radians($geocode_long)) + sin(radians($geocode_lat)) *
			sin(radians(map_latitude)) )) as distance,
			locations.name as location,
			property_types.type_fr as type_fr,
			property_types.type_en as type_en
			FROM property
			LEFT JOIN locations ON locations.id = property.location_id
			LEFT JOIN property_types ON property_types.id = property.property_type_id
			WHERE property.id != '".$data['property']->id."'
			ORDER BY distance ASC
			LIMIT 3
			";
			$data['related_property'] = DB::select( DB::raw($query) );
			// $data['related_property'] = DB::table('property')
			// 						            ->join('locations', 'locations.id', '=', 'property.location_id')
			// 						            ->join('property_types', 'property_types.id', '=', 'property.property_type_id')
			// 						            ->select('property.*', 'locations.name as location', 'property_types.type_fr as type_fr', 'property_types.type_en as type_en')
			// 												->where("property.id","!=",$id)
			// 												->where("property.status","!=","InActive")
			// 												->limit(3)
			// 												->get();

			return view('theme/'.$this->ACTIVE_THEME.'/single-property',$data);
		}
    }

	public function search(Request $request) {
		$data = array();
		$data['currency'] = currency();

		$lat = '45.3058';
		$long = '-73.2545';
		$data['geolat'] = $lat;
		$data['geolong'] = $long;

		$query = $request->get('query');
		$data["query_value"] = $query;
		$geocode_lat = $request->get('geocode_lat');
		$geocode_long = $request->get('geocode_long');
		// print_r($geocode_lat);die();
		if (!empty($geocode_lat) && !empty($geocode_long)) {
			$data['geolat'] = $geocode_lat;
			$data['geolong'] = $geocode_long;
		}
		$sorting_name = 'id';
		$sorting_action = 'desc';

		/*

		use geocoding api results ->
		street_address -> look for location
		municipality,province, etc

		count requests?

		*/
		$data['properties'] = DB::table('property')
					->join('locations', 'locations.id', '=', 'property.location_id')
					->join('property_types', 'property_types.id', '=', 'property.property_type_id')
					->select('property.*', 'locations.name as location', 'property_types.type_fr as type_fr', 'property_types.type_en as type_en')
					->where('property_no', 'like', "%$query%")
					->where("status","!=","InActive")
					->orderBy($sorting_name,$sorting_action)
					->paginate(6)
					->appends(request()->query())
					;
// print_r(count($data['properties']));die();
		if (count($data['properties']) == 0) {
			// $query = "SELECT
			//   *, (6371 * acos( cos( radians($geocode_lat) ) * cos( radians(map_latitude) ) *
      //   cos( radians(map_longitude) - radians($geocode_long)) + sin(radians($geocode_lat)) *
      //   sin(radians(map_latitude)) )) as distance
			// FROM property
			// HAVING distance < 200
			// ORDER BY distance
			// ";

			$query = "SELECT property.*, (3959 * acos( cos( radians($geocode_lat) ) * cos( radians(map_latitude) ) *
			cos( radians(map_longitude) - radians($geocode_long)) + sin(radians($geocode_lat)) *
			sin(radians(map_latitude)) )) as distance,
			locations.name as location,
			property_types.type_fr as type_fr,
			property_types.type_en as type_en
			FROM property
			LEFT JOIN locations ON locations.id = property.location_id
			LEFT JOIN property_types ON property_types.id = property.property_type_id
			HAVING distance < 25
			ORDER BY distance ASC
			";
			// print_r($query);die();
			$data['properties'] = DB::select( DB::raw($query) );
			// $data['properties'] = DB::table('property')
      //                ->selectRaw("*, (6371 * acos( cos( radians($geocode_lat) ) * cos( radians(map_latitude) ) *
			// 			         cos( radians(map_longitude) - radians($geocode_long)) + sin(radians($geocode_lat)) *
			// 			         sin(radians(map_latitude)) )) as distance")
      //                ->havingRaw('distance < 1000')
      //                ->paginate(6);
			// $data['properties'] = Property::where("property_type_id",$property_type)
			// ->where("offer_type",$offer_type)
			// ->where("city_id",$city_id)
			// ->where("status","!=","InActive")
			// ->orderBy($sorting_name,$sorting_action)
			// ->paginate(6);
			// Get current page form url e.x. &page=1
	    $currentPage = LengthAwarePaginator::resolveCurrentPage();

	    // Create a new Laravel collection from the array data
	    $itemCollection = collect($data['properties']);

	    // Define how many items we want to be visible in each page
	    $perPage = 6;

	    // Slice the collection to get the items to display in current page
	    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

	    // Create our paginator and pass it to the view
	    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

	    // set url path for generted links
			$paginatedItems->appends(request()->query());
	    $paginatedItems->setPath($request->url());

			$data['properties'] = $paginatedItems;
		}

		return view('theme/'.$this->ACTIVE_THEME.'/properties',$data);
	}

	public function filter(Request $request)
    {
		$data = array();
		$data['currency'] = currency();

		$property_type =  $request->get('property_type');
		$offer_type =  $request->get('offer_type');
		$city_id =  $request->get('city');
		//$sorting =  $request->get('sorting');

		$sorting_name = 'id';
		$sorting_action = 'desc';

		/*if($sorting == 'price_asc'){
			$sorting_name = 'price';
			$sorting_action = 'asc';
		}else if($sorting == 'price_desc'){
			$sorting_name = 'price';
			$sorting_action = 'desc';
		}*/

		$data['properties'] = Property::where("property_type_id",$property_type)
									  ->where("offer_type",$offer_type)
									  ->where("city_id",$city_id)
									  ->where("status","!=","InActive")
									  ->orderBy($sorting_name,$sorting_action)
									  ->paginate(6);
		return view('theme/'.$this->ACTIVE_THEME.'/properties',$data);

    }


	public function en(Request $request) {
		session(["lang" => "en"]);
		$path = $request->input('path');
		return redirect($path);
	}

	public function fr(Request $request) {
		session(["lang" => "fr"]);
		$path = $request->input('path');
		return redirect($path);
	}

	public function buy()
    {
		$data = array();
		$data['currency'] = currency();
		$data['sliders'] = Property::where('is_featured',1)
		                           ->where("status","!=","InActive")
								   ->where('offer_type','Sale')->get();
		$data['properties'] = Property::where("offer_type","Sale")
		                              ->where("status","!=","InActive")
									  ->orderBy('id','desc')
									  ->paginate(9);
        return view('theme/'.$this->ACTIVE_THEME.'/properties',$data);
    }

	public function rent()
    {
		$data = array();
		$data['currency'] = currency();
		$data['sliders'] = Property::where('is_featured',1)
		                           ->where("status","!=","InActive")
								   ->where('offer_type','Rent')->get();
		$data['properties'] = Property::where("offer_type","Rent")
		                              ->where("status","!=","InActive")
									  ->orderBy('id','desc')
									  ->paginate(9);
        return view('theme/'.$this->ACTIVE_THEME.'/properties',$data);
    }

	public function blog($id='', $title='')
    {
		$data = array();
		if($id == '' && $title == ''){
			$data['posts'] = Blog::orderBy('id','desc')
								 ->where("status","published")->paginate(9);
			return view('theme/'.$this->ACTIVE_THEME.'/blog',$data);
		}else{
			$data['blog_categories'] = BlogCategory::all();
			$data['recent_posts'] = Blog::orderBy('id','desc')->limit(5)->get();
			$data['post'] = Blog::where('id',$id)
								->where("status","published")->first();
			return view('theme/'.$this->ACTIVE_THEME.'/single-blog',$data);
		}

    }

	public function blog_category($cat_id='', $category='')
    {
		$data = array();
		$data['posts'] = Blog::where("cat_id",$cat_id)
							 ->where("status","published")
							 ->orderBy('id','desc')->paginate(9);
		return view('theme/'.$this->ACTIVE_THEME.'/blog',$data);

    }
		public function our_agents()
    {
		$data = array();
		$data['agents'] = Agent::all();
		return view('theme/'.$this->ACTIVE_THEME.'/agents',$data);
    }

		public function resources()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/resources',$data);
		}

		public function resources_buyers()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/resources_buyers',$data);
		}

		public function resources_sellers()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/resources_sellers',$data);
		}

		public function careers()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/careers',$data);
		}

		public function sell_property()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/sell_property',$data);
		}

		public function our_region()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/our_region',$data);
		}

		public function evaluation()
		{
			$data = array();
			return view('theme/'.$this->ACTIVE_THEME.'/evaluation',$data);
		}

	public function about()
    {
		$data = array();
		$data['agents'] = Agent::all();
		$data['faqs'] = Faq::all();
		return view('theme/'.$this->ACTIVE_THEME.'/about',$data);
    }

	public function contact()
    {
        return view('theme/'.$this->ACTIVE_THEME.'/contact');
    }


    public function send_message(Request $request){
	   @ini_set('max_execution_time', 0);
	   @set_time_limit(0);
	   Overrider::load("Settings");

	   $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'subject' => 'required',
			'message' => 'required',
	   ]);

		//Send Email
		$name = $request->input("name");
		$email = $request->input("email");
		$subject = $request->input("subject");
		$message = $request->input("message");

		$mail  = new \stdClass();
		$mail->name = $name;
		$mail->email = $email;
		$mail->subject = $subject;
		$mail->message = $message;

		Mail::to(get_option('email'))->send(new ContactUs($mail));

		if(! $request->ajax()){
		   return back()->with('success', _lang('Thanks for contacting us.'));
		}else{
		   echo _lang('Thanks for contacting us.');
		}

    }

	public function contact_agent(Request $request, $property_id){
	   @ini_set('max_execution_time', 0);
	   @set_time_limit(0);
	   Overrider::load("Settings");

	   $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			'message' => 'required',
	   ]);

		$property = Property::find($property_id);

	    //Send Email
		$name = $request->input("name");
		$email = $request->input("email");
		$phone = $request->input("phone");
		$subject = _lang('Property enquiry message');
		$message = $request->input("message");

		$message .= '<br><br>'._lang('You can see the property details by clicking follwoing link.');
		$message .= '<br><a href="'.url('properties/'.$property_id.'/'.$property->name).'">'._lang('See Details').'</a>';

		$mail  = new \stdClass();
		$mail->name = $name;
		$mail->email = $email;
		$mail->phone = $phone;
		$mail->subject = $subject;
		$mail->message = $message;

		if (isset($property->agent)){
			Mail::to($property->agent->email)->send(new ContactAgent($mail));
			if(! $request->ajax()){
			   return back()->with('success', _lang('Thanks for contacting us.'));
			}else{
			   echo _lang('Thanks for contacting us.');
			}
		}else{
			if(! $request->ajax()){
			   return back()->with('error', _lang('Sorry, No agent found !'));
			}else{
			   echo _lang('Sorry, No agent found !');
			}
		}

	}

	public function terms()
    {
        return view('theme/'.$this->ACTIVE_THEME.'/terms');
    }

	public function privacy()
	{
        return view('theme/'.$this->ACTIVE_THEME.'/privacy');
    }
}
