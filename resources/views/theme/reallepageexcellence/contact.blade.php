@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('contact_banner_image') !='' ? asset('public/uploads/media/'.get_option('contact_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ _lang('CONTACT US') }}</h1>
          </div>
        </div>
      </div>
    </div>

	<div class="site-section">
      <div class="container">
        <div class="row">

          <div class="col-md-12 col-lg-8 mb-5">
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

            <form action="{{ url('send_message') }}" method="POST" class="p-5 bg-white border">
			  {{ csrf_field() }}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="name">{{ _lang('Full Name') }}</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">{{ _lang('Email') }}</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="subject">{{ _lang('Subject') }}</label>
                  <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter Subject" required>
                </div>
              </div>


              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="message">{{ _lang('Message') }}</label>
                  <textarea name="message" id="message" name="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us" required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="{{ _lang('Send Message') }}" class="btn btn-primary  py-2 px-4 rounded-0">
                </div>
              </div>


            </form>
          </div>

          <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h6 text-black mb-3 text-uppercase">{{ _lang('Contact Info') }}</h3>
              <p class="mb-0 font-weight-bold">{{ _lang('Address') }}</p>
              <p class="mb-4">{{ get_option('address') }}</p>

              <p class="mb-0 font-weight-bold">{{ _lang('Phone') }}</p>
              <p class="mb-4"><a href="#">{{ get_option('phone') }}</a></p>

              <p class="mb-0 font-weight-bold">{{ _lang('Email Address') }}</p>
              <p class="mb-0"><a href="#">{{ get_option('email') }}</a></p>

              <p/>

              <p class="mb-0 font-weight-bold">{{ _lang('Schedule') }}</p>
              <p class="mb-0"><a href="#">
                @if(session("lang") == "fr")
                LUNDI-JEUDI : 9h00 – 19h00<br/>
                VENDREDI : 9h00 – 17h00<br/>
                SAMEDI : 10h00-15h00<br/>
                DIMANCHE : FERMÉ<br/>
                @endif
                @if(session("lang") == "en")
                MON-THU : 9h00 – 19h00<br/>
                FRI : 9h00 – 17h00<br/>
                SAT : 10h00-15h00<br/>
                SUN : CLOSED<br/>
                @endif
</a></p>

            </div>

          </div>
        </div>
      </div>
    </div>

@endsection
