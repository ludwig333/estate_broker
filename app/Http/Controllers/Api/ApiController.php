<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class ApiController extends Controller
{
	private $API_KEY = 'd8439ac5aabdd14a8fbc3a53af2a6de0';

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
    public function index() {
				header("Location: http://www.royallepageexcellence.com");
		}

		public function markers($geolong = false, $geolat = false) {
			$query = "SELECT property.*, (3959 * acos( cos( radians($geolat) ) * cos( radians(map_latitude) ) *
			cos( radians(map_longitude) - radians($geolong)) + sin(radians($geolat)) *
			sin(radians(map_latitude)) )) as distance,
			locations.name as location,
			property_types.type_fr as type_fr,
			property_types.type_en as type_en
			FROM property
			LEFT JOIN locations ON locations.id = property.location_id
			LEFT JOIN property_types ON property_types.id = property.property_type_id
			HAVING distance < 25";
			$data = DB::select( DB::raw($query) );
			echo json_encode($data);
		}

		public function inscriptions($api_key = false, $centris_agent_id = false) {
			if ($api_key == $this->API_KEY) {
				$results = [];

				$results_agent = DB::select( DB::raw("SELECT * FROM agents WHERE centris_agent_id='$centris_agent_id'") );
				if (count($results_agent)) {
					$results["agent"] = $results_agent[0];
				} else {
					$results["agent"] = false;
				}

				if ($results["agent"]) {
					$agent_id = $results["agent"]["id"];

					$results_inscriptions = DB::select( DB::raw("SELECT * FROM property WHERE agent_id='$agent_id'") );

					$inscriptions = [];
					foreach($results_inscriptions as $insc) {
						$inscription = [];

						$results_inscriptions_photos = DB::select( DB::raw("SELECT * FROM property_gallery WHERE property_id='".$insc["id"]."'") );
						$inscription["photos"] = $results_inscriptions_photos;

						$inscription["benefits"] = [];

						$inscription["details"] = $insc;

						$inscriptions[] = $inscription;
					}

					$results["inscriptions"] = $inscriptions;
				}

				return json_encode($results);
			} else {
				$this->index();
			}
    }

}
