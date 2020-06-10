@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('about_banner_image') !='' ? asset('public/uploads/media/'.get_option('about_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ _lang('Sell your property') }}</h1>
          </div>
        </div>
      </div>
    </div>

	  <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <h3>{{ _lang('Sell your property title') }}</h3>






<section class="textOnly section-container">





		<p>
			<p style="margin: 0px 0px 10px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: 'Segoe UI', Verdana, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;">{{ _lang('Sell your property body 1') }}</p>

<p style="margin: 0px 0px 10px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: 'Segoe UI', Verdana, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;">{{ _lang('Sell your property body 2') }}</p>

<p style="margin: 0px 0px 10px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: 'Segoe UI', Verdana, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;">{{ _lang('Sell your property body 3') }}</p>

<p style="margin: 0px 0px 10px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: 'Segoe UI', Verdana, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;"><strong style="box-sizing: border-box;">{{ _lang('Sell your property body 4') }}</strong></p>


		</p>


</section>


          </div>
        </div>
      </div>
    </div>

@endsection
