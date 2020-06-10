@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('about_banner_image') !='' ? asset('public/uploads/media/'.get_option('about_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">{{ _lang('Evaluation') }}</h1>
          </div>
        </div>
      </div>
    </div>

	  <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed ligula eros. In mollis aliquet ligula, et tempus magna dapibus nec. Nam ut ante lorem. Donec eros nibh, blandit fermentum risus ac, lobortis congue nunc. Proin ut turpis elit. Nam convallis lorem quis sodales efficitur. Pellentesque ornare, sapien sit amet mollis lobortis, lacus urna aliquam odio, lobortis iaculis est velit ut lectus. Aenean vitae mauris odio. Praesent auctor leo eu odio tempor interdum. Donec pulvinar, ex ut consequat vestibulum, est ligula bibendum sem, sit amet venenatis nunc nulla eget turpis. Nulla lacus tortor, gravida at auctor volutpat, suscipit sit amet turpis. Phasellus quis lorem a libero accumsan varius. Vivamus in arcu ullamcorper, semper nisi ut, tristique nunc. Quisque blandit varius tortor sit amet accumsan. Proin dapibus mollis nulla, ac rhoncus turpis sagittis consectetur. Quisque et viverra enim, et venenatis lectus.</p>

            <p>Nullam vitae imperdiet neque, quis maximus orci. Vestibulum ut aliquet nisi. Duis egestas odio eget tellus condimentum, ut sodales orci bibendum. Donec vestibulum ipsum eget augue egestas interdum. Proin posuere venenatis purus, varius eleifend turpis luctus nec. Nulla sit amet interdum dolor. Sed facilisis feugiat magna, id facilisis orci iaculis non. Pellentesque sit amet elementum nibh. Donec cursus auctor massa, id dapibus purus suscipit nec. Ut tincidunt eu nunc eu scelerisque. Vestibulum in velit id justo porttitor cursus. Vestibulum tincidunt sagittis nisi, sed ornare elit ornare vitae. Donec lobortis sem dolor, vel iaculis quam ullamcorper at. Sed arcu metus, finibus in felis vel, facilisis tempor leo. Nullam dictum nunc et diam fringilla pellentesque. Phasellus tempor nec velit at ultrices.</p>
          </div>
        </div>
      </div>
    </div>

@endsection
