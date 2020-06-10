@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('about_banner_image') !='' ? asset('public/uploads/media/'.get_option('about_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ _lang('About Us') }}</h1>
          </div>
        </div>
      </div>
    </div>

	  <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ get_option('about_us_image') !='' ? asset('public/uploads/media/'.get_option('about_us_image')) : asset('public/theme/reallepageexcellence/images/about.jpg') }}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 text-center"  data-aos="fade-up" data-aos-delay="200">
            <div class="site-section-title">
              <h2>{{ _lang('Our Company') }}</h2>
            </div>
            <p class="lead">
			<h4 id="pageTitle">Administration - Équipe de Gestion </h4></p>
<div class="row">
  <div class="col-md-6">
      Louise Boucher
    </div>
    <div class="col-md-6">
    Adjointe administrative 	<br>
    Télécopieur: 450-347-0199<br>
      </div>
      </div>
      <br/>
      <div class="row">
      <div class="col-md-6">
          Louise Boucher
        </div>
        <div class="col-md-6">
        Adjointe administrative 	<br>
        Télécopieur: 450-347-0199<br>

          </div>
          </div>
          <br/>
          <div class="row">
          <div class="col-md-6">
              Lucie Houle
            </div>
            <div class="col-md-6">
            Secrétaire	<br>
             lucieh@royallepage.ca
              </div>
              </div>
<br/>

              <div class="row">
              <div class="col-md-6">
                  Carmen Labonté
                </div>
                <div class="col-md-6">
                Marketing	<br>
                 clabonte@royallepage.ca
                  </div>
                  </div>

<br/>
                  <div class="row">
                  <div class="col-md-6">
                      Marianne Lévesque
                    </div>
                    <div class="col-md-6">
                    Réceptionniste	<br>
                      mlevesque@royallepage.ca
                      </div>
                      </div>

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
		  <div class="col-md-12">
			<div class="agent-carousel owl-carousel owl-theme">
			  @foreach($agents as $agent)
				<div class="team-member">

				  <img src="{{ asset('public/uploads/media/'.$agent->image) }}" alt="Image" class="img-fluid rounded mb-4">

				  <div class="text">

					<h2 class="mb-2 font-weight-light text-black h4">{{ $agent->name }}</h2>
					<span class="d-block mb-3 text-white-opacity-05">{{ _lang('Real Estate Agent') }}</span>
					<p>{{ $agent->description }}</p>
					<p>
					  <a href="{{ $agent->facebook }}" class="text-black p-2"><span class="icon-facebook"></span></a>
					  <a href="{{ $agent->twitter }}" class="text-black p-2"><span class="icon-twitter"></span></a>
					  <a href="{{ $agent->linkedin }}" class="text-black p-2"><span class="icon-linkedin"></span></a>
					</p>
				  </div>

				</div>
			  @endforeach
		    </div>
		  </div>
        </div>
      </div>
    </div>

    <!-- <div class="site-section">
      <div class="container">

        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <div class="site-section-title">
              <h2>{{ _lang('Frequently Ask Questions') }}</h2>
            </div>
            <p>{{ get_option('faq_heading_content') }}</p>
          </div>
        </div>

        <div class="row justify-content-center" data-aos="fade" data-aos-delay="100">
          <div class="col-md-8">
            <div class="accordion unit-8" id="accordion">

			   @foreach($faqs as $faq)
				<div class="accordion-item">
				  <h3 class="mb-0 heading">
					<a class="btn-block" data-toggle="collapse" href="#collapse-{{ $faq->id }}" role="button" aria-expanded="true" aria-controls="collapse-{{ $faq->id }}">{{ $faq->question }}<span class="icon"></span></a>
				  </h3>
				  <div id="collapse-{{ $faq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="body-text">
					  <p>{{ $faq->answer }}</p>
					</div>
				  </div>
				</div>
                @endforeach

			</div>
          </div>
        </div>

      </div>
    </div> -->

@endsection
