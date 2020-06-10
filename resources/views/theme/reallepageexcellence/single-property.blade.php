@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ asset('public/uploads/media/'.$property->image) }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">{{ _lang('Property Details of') }}</span>
            <h1 class="mb-2">{{ $property->address }}</h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{ $currency.' '.decimalPlace($property->price) }}</strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="bg-white property-body border-bottom border-left border-right">
              <div class="row mb-5">
                <div class="col-md-6">
                  <strong class="text-success h1 mb-3">{{ $currency.' '.decimalPlace($property->price) }}</strong>
                </div>
                <div class="col-md-6">
                  <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
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
                    @php if (!empty($property->land_sq_ft )) { @endphp
                    <li>
                      <span class="property-specs">{{ _lang('LAND') }}</span>
                      <span class="property-specs-number">{{ $property->land_sq_ft }}</span>

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
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Property Type') }}</span>
                  <strong class="d-block">{{ isset($property->property_type) ? $property->property_type->type_fr : _lang('N/A') }}</strong>
                </div>
                  <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                    @php if (!empty($property->year_built )) { @endphp
                    <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Year Built') }}</span>
                    <strong class="d-block">{{ $property->year_built }}</strong>
                    @php } @endphp
                  </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Inscription #') }}</span>
                  <strong class="d-block">{{ $property->property_no }}</strong>
                </div>
              </div>
              <p/>

			  <!--Benefits-->
			  <div class="row mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3">{{ _lang('Benefits') }}</h2>
                </div>
                @if(session("lang") == "fr")
					@foreach($benefits_aggr["fr"] as $idx=>$benefit)
          <div class="col-md-6">
          <p><i class="flaticon-Checked text-success"></i> <strong>{{ $idx }}</strong></p>
          </div>
          <div class="col-md-6">
          <p><i class="flaticon-Checked text-success"></i> {{ $benefit }}</p>
          </div>
					@endforeach
          @endif
          @if(session("lang") == "en")
          @foreach($benefits_aggr["en"] as $idx=>$benefit)
          <div class="col-md-6">
          <p><i class="flaticon-Checked text-success"></i> <strong>{{ $idx }}</strong></p>
          </div>
          <div class="col-md-6">
          <p><i class="flaticon-Checked text-success"></i> {{ $benefit }}</p>
          </div>
					@endforeach
          @endif

              </div>

              @if(count($property->gallery) > 0)
				  <div class="row mt-5">
					@foreach($property->gallery as $gallery)
						<div class="col-sm-6 col-md-4 col-lg-3">
						  <a href="{{ asset('public/uploads/media/'.$gallery->image) }}" class="image-popup gal-item"><img src="{{ asset('public/uploads/media/'.$gallery->image) }}" alt="Image" class="img-fluid"></a>
              <p/>
						</div>
					@endforeach
				  </div>
			  @endif

			  <!--Google Map-->
			  <div class="row mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3">{{ _lang('View Location On Map') }}</h2>
                </div>
				<div id="map"></div>
              </div>

            </div>
          </div>
          <div class="col-lg-4">
		    @if ($errors->any())
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					@foreach ($errors->all() as $error)
						<div>&times; {{ $error }}</div>
					@endforeach
				</div>
			@endif

			@if (\Session::has('success'))
			  <div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<div>{{ \Session::get('success') }}</div>
			  </div>
			  <br />
			@endif

            <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">{{ _lang('Contact Agent') }}</h3>
              <form action="{{ url('contact_agent/'.$property->id) }}" method="POST" class="form-contact-agent">
				{{ csrf_field() }}
				<div class="form-group">
                  <label for="name">{{ _lang('Name') }}</label>
                  <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">{{ _lang('Email') }}</label>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">{{ _lang('Phone') }}</label>
                  <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

				<div class="form-group">
                  <label for="message">{{ _lang('Message') }}</label>
                  <textarea id="message" rows="5" name="message" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="{{ _lang('Send Message') }}">
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>
    </div>


    <div class="site-section site-section-sm bg-light">
      <div class="container">

        <div class="row">
          <div class="col-12">
            <div class="site-section-title mb-5">
              <h2>{{ _lang('Related Properties') }}</h2>
            </div>
          </div>
        </div>

        <div class="row mb-5">
		 @if(count($related_property) == 0)
			<div class="col-12">
				<p>{{ _lang('No related property found !') }}</p>
		    </div>
		@endif

         @foreach($related_property as $rp)
		  <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <div class="img-thumb-container">
              <a href="{{ url('properties/'.$rp->id.'/'.$rp->name) }}" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type {{ $rp->offer_type=='Sale' ? 'bg-danger' : 'bg-success' }}">{{ $rp->offer_type }}</span>
                </div>
                <img src="{{ asset('public/uploads/media/'.$rp->image) }}" alt="Image" class="img-fluid">
              </a>
            </div>
              <div class="p-4 property-body">

                <h2 class="property-title"><a href="{{ url('properties/'.$rp->id.'/'.$property->name) }}">{{ $rp->name }}</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> {{ $rp->location }}</span>
                <strong class="property-price text-primary mb-3 d-block text-success">{{ $currency.' '.decimalPlace($rp->price) }}</strong>
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
    </div>
</div>

@endsection

@section('js-script')
<script>
function initMap() {
	var uluru = {lat: {{ $property->map_latitude }}, lng: {{ $property->map_longitude }}};
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 10,
	  center: uluru,
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
	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ get_option('google_map_api_key') }}&callback=initMap"></script>
@endsection
