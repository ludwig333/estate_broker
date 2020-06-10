@extends('theme.reallepageexcellence.layouts.theme')

@section('content')

    <!--Slider Section-->

		<style>
		.slider_bg {
			-webkit-transition: background-image 0.2s ease;
			transition: background-image 0.2s ease;
		}
		.slider_buyers_bg {
			background-image: url({{ asset('public/theme/reallepageexcellence/images/slider_buyers.png') }});
		}
		.slider_sellers_bg {
			background-image: url({{ asset('public/theme/reallepageexcellence/images/slider_sellers.png') }});
		}
		.slider_agents_bg {
			background-image: url({{ asset('public/theme/reallepageexcellence/images/slider_agents.png') }});
		}
		</style>

		<div class="slider_bg slider_buyers_bg site-blocks-cover inner-page-cover overlay" data-stellar-background-ratio="0.5">
			<div class="container" id="slider_buyers_content">
				<div class="row align-items-center justify-content-center">
					<div class="col-md-6 col-sm-12 col-12">
					</div>
					<div class="col-md-6 col-sm-12 col-12">
						<div class="col-md-12">
							<h1>
								{{ _lang('Buyers') }}
							</h1>
						</div>
						<br/>
						<!-- <div class="row"> -->
						<div class="col-md-12 col-sm-12 col-12">
							<form method="post">
								{{ csrf_field() }}
							<input type="hidden" name="action" value="send_buyers_guide">
							<input type="text" name="first_name" class="form-control" placeholder="{{ _lang('placeholder_firstname') }}"><br/>
							<input type="text" name="last_name" class="form-control" placeholder="{{ _lang('placeholder_lastname') }}"><br/>
							<input type="text" name="email" class="form-control" placeholder="{{ _lang('placeholder_email') }}"><br/>
							<button type="submit" class="btn btn-success btn-block">{{ _lang('DOWNLOAD YOUR GUIDE') }}</button>
							</form>
						</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
			<div class="container" id="slider_sellers_content" style="display:none;">
				<div class="row align-items-center justify-content-center">
					<div class="col-md-6 col-sm-12 col-12">
					</div>
					<div class="col-md-6 col-sm-12 col-12">
						<div class="col-md-12">
							<h1>
								{{ _lang('Sellers') }}
							</h1>
						</div>
						<br/>
						<!-- <div class="row"> -->
						<div class="col-md-12">
							<form method="post">
								{{ csrf_field() }}
							<input type="hidden" name="action" value="send_sellers_guide">
							<input type="text" name="first_name" class="form-control" placeholder="{{ _lang('placeholder_firstname') }}"><br/>
							<input type="text" name="last_name" class="form-control" placeholder="{{ _lang('placeholder_lastname') }}"><br/>
							<input type="text" name="email" class="form-control" placeholder="{{ _lang('placeholder_email') }}"><br/>
							<button type="submit" class="btn btn-success btn-block">{{ _lang('DOWNLOAD YOUR E-BOOK') }}</button>
							</form>
						</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
			<div class="container" id="slider_agents_content" style="display:none;">
				<div class="row align-items-center justify-content-center">
					<div class="col-md-6 col-sm-12 col-12">
					</div>
					<div class="col-md-6 col-sm-12 col-12">
						<div class="col-md-12">
							<h1>
								{{ _lang('Agents') }}
							</h1>
						</div>
						<br/>
						<!-- <div class="row"> -->
						<div class="col-md-12">
							<input type="text" class="form-control" placeholder="{{ _lang('placeholder_firstname') }}"><br/>
							<input type="text" class="form-control" placeholder="{{ _lang('placeholder_lastname') }}"><br/>
							<input type="text" class="form-control" placeholder="{{ _lang('placeholder_email') }}"><br/>
							<button class="btn btn-success btn-block">{{ _lang('OBTENEZ UN RENDEZ-VOUS') }}</button>
						</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>


    <div class="site-section site-section-sm bg-light">
      <div class="container">
				<strong>{{ _lang('FEATURED PROPERTIES') }}</strong>
				<p/>
				<div class="owl-carousel owl-theme home-carousel">
					@foreach($properties as $property)
					<div class="item">
            <div class="property-entry h-100">

							<div class="img-thumb-container">
              <a href="{{ url('properties/'.$property->id.'/'.$property->name) }}" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type {{ $property->offer_type=='Sale' ? 'bg-danger' : 'bg-success' }}">{{ $property->offer_type }}</span>
                </div>
                <img src="{{ asset('public/uploads/media/'.$property->image) }}" alt="Image" class="img-fluid">
              </a>
							</div>
              <div class="property-body-red">
								<div class="row">
									<div class="col-md-7">
										<strong>{{ _lang('NEW PROPERTY') }}</strong>
									</div>
									<div class="col-md-5 text-right">
										<strong>No. {{ $property->property_no }}</strong>
									</div>
								</div>
							</div>
              <div class="p-4 property-body">
								<strong class="property-price d-block">{{ $currency.' '.decimalPlace($property->price) }}</strong>
                <h2 class="property-title"><a href="{{ url('properties/'.$property->id.'/'.$property->name) }}">{{ $property->name }}</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> {{ $property->location }}</span>
                <ul class="property-specs-wrap mb-3 mb-lg-0">

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
								<a href="{{ url('properties/'.$property->id.'/'.$property->name) }}" class="property-link"><strong>{{ _lang('See details') }}</strong></a>

              </div>
            </div>
          </div>
          @endforeach
				</div>
      </div>

			<br/><p/>

			<div class="container">
				<div class="row">
					<div class="col-md-8 text-justify" style="padding:20px;">
						<h3>{{ _lang('Optimize your time') }}</h3>
					</div>
					<div class="col-md-4 text-justify" style="padding:20px;">
					</div>
				</div>

				<div class="row">
					<div class="col-md-8 text-justify" style="padding:20px;">
							<p>{{ _lang('main_page_paragraph_1') }}</p>

							<p>{{ _lang('main_page_paragraph_2') }}</p>

							<p>{{ _lang('main_page_paragraph_3') }}</p>
					</div>
					<div class="col-md-4 text-justify" style="padding:20px;">
						<p>{{ _lang('main_page_paragraph_4') }}</p>

							<strong>{{ _lang('main_page_sidebar_line_1') }}<br/>
								{{ _lang('main_page_sidebar_line_2') }}</strong>

						<p/>&nbsp;<br/>
						<a href="{{ url('our_agents') }}" class="btn btn-success btn-block">{{ _lang('Find your agent') }}</a>
					</div>
				</div>
			</div>
    </div>





@endsection
