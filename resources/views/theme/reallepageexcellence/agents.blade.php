@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('about_banner_image') !='' ? asset('public/uploads/media/'.get_option('about_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ _lang('OUR AGENTS') }}</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container" data-aos="fade">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7">
            <div class="site-section-title text-center">
              <h2>{{ _lang('Our Agents') }}</h2>
              <p>{{ get_option('our_agent') }}</p>
            </div>
          </div>
        </div>
        <div class="row">


			  @foreach($agents as $agent)
        <div class="col-md-4">


				  <img style="width:100%;" src="{{ asset('public/uploads/media/'.$agent->image) }}" alt="Image" class="img-fluid rounded mb-4">

				  <div class="text">

					<h2 class="mb-2 font-weight-light text-black h4">{{ $agent->name }}</h2>
					<span class="d-block mb-3 text-white-opacity-05">{{ _lang('Real Estate Agent') }}</span>
					<p>{{ $agent->description }}</p>
					<p>
            @if (!empty($agent->phone))
              @php
              $from = $agent->phone;
              $to = sprintf("%s-%s-%s",
              substr($from, 0, 3),
              substr($from, 3, 3),
              substr($from, 6));
              echo _lang("Phone").": ".$to;
              @endphp
              <br/>
            @endif
            @if (!empty($agent->email))
              {{ _lang("Email") }}: <a href="mailto:{{$agent->email}}">{{$agent->email}}</a><br/>
            @endif
            @if (!empty($agent->website))
              <a href="{{$agent->website}}">{{$agent->website}}</a><br/>
            @endif
					</p>
				  </div>

				</div>
			  @endforeach

        </div>
      </div>
    </div>


@endsection
