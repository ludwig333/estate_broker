@extends('theme.reallepageexcellence.layouts.theme')

@section('content')

		<div class="site-blocks-cover inner-page-cover overlay" style="">
			<div class="container">
				<div id="map-search" style="position: absolute;top:0px;left:0px;"></div>
				<div style="position: absolute;top:30px;left:0px;padding:15px;border-top: solid 1px #ccc; background: rgba(0,0,0,.4);height:80px;width:100%;">
					<div class="container">
						<!-- <div class="row"> -->
							<div class="col-md-6">
								<form method="GET" action="{{ url('search') }}" id="search_form" >
								<input type="hidden" name="geocode_long" value="" id="geocode_long">
								<input type="hidden" name="geocode_lat" value="" id="geocode_lat">
								<div class="input-group mb-3">
								  <input type="text" class="form-control" id="query" name="query" value="{{ $query_value }}" placeholder="{{ _lang('placeholder_properties_search') }}" aria-label="{{ _lang('placeholder_properties_search') }}" aria-describedby="basic-addon2">
								  <div class="input-group-append">
										<button class="btn btn-outline-secondary btn-success" onclick="perform_search();" type="button">{{ _lang('Find a property') }}</button>
								  </div>
								</div>
								</form>
							</div>
							<div class="col-md-6">
							</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>

    <div class="site-section site-section-sm bg-light">

      <div class="container">

        <div class="row mb-5">
		  @if(count($properties) == 0)
		    <div class="col-md-12 mb-4">
			   <h3 class="text-center">{{ _lang('No Property Found !') }}</h3>
			</div>
		  @endif

          @foreach($properties as $property)
		  <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
							<div class="img-thumb-container">
              <a href="{{ url('properties/'.$property->id.'/'.$property->name) }}" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type {{ $property->offer_type=='Sale' ? 'bg-danger' : 'bg-success' }}">{{ $property->offer_type }}</span>
                </div>
                <img src="{{ asset('public/uploads/media/'.$property->image) }}" alt="Image" class="img-fluid">
              </a>
							</div>
              <div class="p-4 property-body">
                <h2 class="property-title"><a href="{{ url('properties/'.$property->id.'/'.$property->name) }}">{{ $property->address }}</a></h2>
								@if (!empty($property->location))
								<span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> {{ $property->location }}</span>
								@endif
                <strong class="property-price text-primary mb-3 d-block text-success">{{ $currency.' '.decimalPlace($property->price) }}</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
									@php if (!empty($property->land_sq_ft )) { @endphp
									<li>
										<span class="property-specs">{{ _lang('LAND') }}</span>
										<span class="property-specs-number">{{ $property->land_sq_ft }}</span>

									</li>
									@php } @endphp
									@php if (!empty($property->bed )) { @endphp
                  <li>
                    <span class="property-specs">{{ _lang('Beds') }}</span>
                    <span class="property-specs-number">{{ $property->bed }}</span>

                  </li>
									@php } @endphp
									@php if (!empty($property->bath )) { @endphp
                  <li>
                    <span class="property-specs">{{ _lang('Baths') }}</span>
                    <span class="property-specs-number">{{ $property->bath }}</span>

                  </li>
									@php } @endphp
									@php if (!empty($property->sq_ft )) { @endphp
                  <li>
                    <span class="property-specs">{{ _lang('SQ FT') }}</span>
                    <span class="property-specs-number">{{ $property->sq_ft }}</span>

                  </li>
									@php } @endphp
									@php if (!empty($property->year_built )) { @endphp
                  <li>
                    <span class="property-specs">{{ _lang('Year') }}</span>
                    <span class="property-specs-number">{{ $property->year_built }}</span>

                  </li>
									@php } @endphp
									@if(session("lang") == "fr")
										@php if (!empty($property->type_fr)) { @endphp
	                  <li>
	                    <span class="property-specs">{{ _lang('Type') }}</span>
	                    <span class="property-specs-number">{{ $property->type_fr }}</span>

	                  </li>
										@php } @endphp
									@endif
									@if(session("lang") == "en")
										@php if (!empty($property->type_en)) { @endphp
	                  <li>
	                    <span class="property-specs">{{ _lang('Type') }}</span>
	                    <span class="property-specs-number">{{ $property->type_en }}</span>

	                  </li>
										@php } @endphp
									@endif

                </ul>

              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
			{{ $properties->links('theme.reallepageexcellence.pagination.default') }}
          </div>
        </div>

      </div>
    </div>

@endsection

@section('js-script')




<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ get_option('google_map_api_key') }}&libraries=places"></script>

<script>
$(document).ready(function() {

var countryRestrict = {'country': 'ca'};
var autocomplete = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */ (
		document.getElementById('query')), {
	types: ['(cities)'],
	componentRestrictions: countryRestrict
});
document.getElementById('query').addEventListener(
		'change', perform_search);
// Get the input field

  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
			perform_search();
      return false;
    }
  });


var perform_search = function() {
	var address = $('#query').val();
	var url = 'https://maps.googleapis.com/maps/api/geocode/json?address='+address+'&key={{ get_option('google_map_api_key') }}';
	$.ajax(url)
	.done(function(data) {
		// console.log(data);
		if (data.status == "ZERO_RESULTS") {
			$('#query').val('');
			return;
		}
		var results = data.results;
		if (results.length) {
			if (results[0].geometry) {
				if (results[0].geometry.location) {
					$('#geocode_lat').val(results[0].geometry.location.lat);
					$('#geocode_long').val(results[0].geometry.location.lng);
				}
			}
		}
		$('#search_form').submit();
	});
}

function initMap() {
	var long = {{ $geolong }};
	var lat = {{ $geolat }};
	// 45.3058° N, 73.2545° W
	var uluru = {lat: lat, lng: long };
	var map = new google.maps.Map(document.getElementById('map-search'), {
	  zoom: 10,
	  center: uluru,
		zoomControl: true,
		fullscreenControl: false,
		mapTypeControl: false,
		styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#181818"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#1b1b1b"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8a8a8a"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#373737"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#3c3c3c"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#4e4e4e"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#3d3d3d"
      }
    ]
  }
]
	});

	var map_pointer = "{{ asset('public/images/map-pointer.png')}}";
	var add_marker = function(position, details) {
		var marker = new google.maps.Marker({
		  position: position,
		  map: map,
			icon: map_pointer
		});
		marker.infowindow = new google.maps.InfoWindow({
			content: details
		});
		marker.addListener('click', function() {
			skip_reload_markers = true;
			// console.log('skip');
			for( var index in markers ) {
				markers[index].infowindow.close();
			}
	    marker.infowindow.open(map, marker);
			marker.open_state = true;
			setTimeout(function() { skip_reload_markers = false; }, 1000);
    });
		return marker;
	}

	google.maps.event.addListener(map, 'idle', function() {
		reload_markers(map.center.lat(), map.center.lng());
	});
	var markerCluster = false;
	var skip_reload_markers = false;
	var markers = [];
	var reload_markers = function(lat, lng) {
		if (skip_reload_markers) {
			console.log('skip');
			return;
		}
		$.ajax({
		  url: "/api/markers/"+lng+"/"+lat,
		})
		.done(function( data ) {
			data = JSON.parse(data);
			// console.log( data );
			// for( var index in markers ) {
			// 	markers[index].setMap(null);
			// }

			markers = [];

			for( var index in data ) {
				inscription = data[index];
				var position = {lat: Number(inscription.map_latitude), lng: Number(inscription.map_longitude) };
				@if(session("lang") == "en")
					var details = " \
					<img src=\"{{ asset('public/uploads/media/') }}/"+inscription.image_thumbnail+"\" \
					style=\"width:200px;\" class=\"img-thumbnail\"><br/> \
					<br/><span style=\"font-size:14px;\"> \
					<a href=\"/properties/"+inscription.id+"/"+inscription.name+"\">"+inscription.name+"</a> \
					</span> <br/> \
					<strong>Type</strong>: "+inscription.type_en+"<br/> \
					<strong>Price</strong>: "+inscription.price+"$<br/> \
					";
					if (inscription.sq_ft) {
						details = details + "<strong>Area</strong>: "+inscription.sq_ft+"<br/>";
					}
					if (inscription.land_sq_ft) {
						details = details + "<strong>Land</strong>: "+inscription.land_sq_ft+"<br/>";
					}
				@endif
				@if(session("lang") == "fr")
					var details = " \
					<img src=\"{{ asset('public/uploads/media/') }}/"+inscription.image_thumbnail+"\" \
					style=\"width:200px;\" class=\"img-thumbnail\"><br/> \
					<br/><span style=\"font-size:14px;\"> \
					<a href=\"/properties/"+inscription.id+"/"+inscription.name+"\">"+inscription.name+"</a> \
					</span> <br/> \
					<strong>Type</strong>: "+inscription.type_fr+"<br/> \
					<strong>Prix</strong>: "+inscription.price+"$<br/> \
					";
					if (inscription.sq_ft) {
						details = details + "<strong>Superficie</strong>: "+inscription.sq_ft+"<br/>";
					}
					if (inscription.land_sq_ft) {
						details = details + "<strong>Terrain</strong>: "+inscription.land_sq_ft+"<br/>";
					}

				@endif
				// console.log(inscription);
				markers.push(add_marker(position, details));
			}
			var clusterStyles = [
				{
					textColor: 'white',
					url: "{{ asset('public/images/m1.png') }}",
					height: 53,
					width: 53
				},
				{
					textColor: 'white',
					url: "{{ asset('public/images/m1.png') }}",
					height: 53,
					width: 53
				},
				{
					textColor: 'white',
					url: "{{ asset('public/images/m3.png') }}",
					height: 66,
					width: 66
				},
				{
					textColor: 'white',
					url: "{{ asset('public/images/m3.png') }}",
					height: 66,
					width: 66
				},
				{
					textColor: 'white',
					url: "{{ asset('public/images/m5.ng') }}",
					height: 90,
					width: 90
				}
			];
			var mcOptions = {
				styles: clusterStyles,
				maxZoom: 12,
				// imagePath: "{{ asset('public/images/m') }}"
			};
			if (markerCluster) {
				markerCluster.clearMarkers();
			}
			markerCluster = new MarkerClusterer(map, markers, mcOptions);
		});

	}
}
initMap();
});
</script>


@endsection
