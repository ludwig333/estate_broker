@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('terms_banner_image') !='' ? asset('public/uploads/media/'.get_option('terms_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ get_option('terms_heading') }}</h1>
          </div>
        </div>
      </div>
    </div>
	
	<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
            @php echo clean(get_option('terms_content')) @endphp
          </div>
        </div>
      </div>
    </div>

@endsection