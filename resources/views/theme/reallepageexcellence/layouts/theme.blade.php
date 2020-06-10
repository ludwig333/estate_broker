<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ get_option('site_title','WEBSITE') }}</title>
    <link rel="shortcut icon" href="{{ get_favicon() }}" />

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="{{ get_option('meta_description') }}">
    <meta name="keywords" content="{{ get_option('meta_keywords') }}">
    <meta name="author" content="{{ get_option('meta_author') }}">
    @if( Request::segment(1) == "blog" and Request::segment(2) != "" )
      <meta property="og:title" content="{{ $post->title }}">
      <meta property="og:description" content="{{ get_option('meta_og_description') }}">
      <meta property="og:image" content="{{ $post->featured_image != '' ? asset('public/uploads/media/'.$post->featured_image) : asset('public/theme/reallepageexcellence/images/no_blog_image.jpg') }}">
      <meta property="og:url" content="{{ get_option('meta_og_url') }}">

      <meta name="twitter:title" content="{{ $post->title }}">
      <meta name="twitter:description" content="{{ get_option('meta_twitter_description') }}">
      <meta name="twitter:image" content="{{ $post->featured_image != '' ? asset('public/uploads/media/'.$post->featured_image) : asset('public/theme/reallepageexcellence/images/no_blog_image.jpg') }}">
      <meta name="twitter:card" content="{{ get_option('meta_twitter_card') }}">
    @endif

    @if( Request::segment(2) != "blog" and Request::segment(2) == "" )
      <meta property="og:title" content="{{ get_option('meta_og_title') }}">
      <meta property="og:description" content="{{ get_option('meta_og_description') }}">
      <meta property="og:image" content="{{ get_option('meta_og_image') }}">
      <meta property="og:url" content="{{ get_option('meta_og_url') }}">

      <meta name="twitter:title" content="{{ get_option('meta_twitter_title') }}">
      <meta name="twitter:description" content="{{ get_option('meta_twitter_description') }}">
      <meta name="twitter:image" content="{{ get_option('meta_twitter_image') }}">
      <meta name="twitter:card" content="{{ get_option('meta_twitter_card') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/bootstrap.reallepageexcellence.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/mediaelementplayer.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/fl-bigmug-line.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/select2.css') }}">


    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('public/theme/reallepageexcellence/css/style.css') }}">

    <link rel="prefetch" href="{{ asset('public/theme/reallepageexcellence/images/slider_buyers.png') }}">
    <link rel="prefetch" href="{{ asset('public/theme/reallepageexcellence/images/slider_sellers.png') }}">
    <link rel="prefetch" href="{{ asset('public/theme/reallepageexcellence/images/slider_agents.png') }}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  </head>
  <body>

  <div class="site-loader"></div>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

    <div class="site-navbar-first">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-3">
              <!-- <h1 class="mb-0"></h1> -->
              <div class="site-logo-box">
                <a href="{{ url('/') }}" class="text-white h2 mb-0"><img class="site-logo" src="{{ get_logo() }}"></a>
              </div>
              <div class="slogan-text">
                <p>{{ _lang('Logo Slogan Top Line') }}<br/>
                {{ _lang('Logo Slogan Bottom Line') }}</p>
              </div>
            </div>
            <div class="col-4 col-md-4 col-lg-9">
              <nav class="site-navigation text-right text-md-right" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                <ul class="site-menu site-top-menu js-clone-nav d-none d-lg-block hide_if_mobile">
                  <li class="menu_buyers active hide_if_mobile">
                    <a href="#">{{ _lang('BUYERS') }}</a>
                  </li>
                  <li class="menu_sellers hide_if_mobile"><a href="#">{{ _lang('SELLERS') }}</a></li>
                  <li class="menu_agents hide_if_mobile"><a href="#">{{ _lang('AGENTS') }}</a></li>
				        </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="site-navbar">
          <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-12 col-md-12 col-lg-12">
              <nav class="site-navigation text-right text-md-right" role="navigation">

                <!-- <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div> -->
                <style>
                .site-menu-hidden {
                  display: none !important;
                }
                </style>
                <ul class="site-menu site-menu-buyers js-clone-nav d-none d-lg-block">
                  <li
                  @if( Request::segment(1) == "filter" or Request::segment(1) == "properties")
                    class="active"
                  @endif
                  ><a href="{{ url('properties') }}">{{ _lang('FIND A PROPERTY') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li
                  @if( Request::segment(1) == "our_agents")
                    class="active"
                  @endif
                  ><a href="{{ url('our_agents') }}" class="hide_if_mobile">{{ _lang('OUR AGENTS') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li
                  @if( Request::segment(1) == "blog")
                    class="active"
                  @endif
                  ><a href="{{ url('blog') }}">{{ _lang('OUR BLOG') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li class="hide_if_mobile"><a href="tel:+14503477766"><img src="/public/images/icone-tel.png"> &nbsp; 450-347-7766</a></li>
                </ul>

                <ul class="site-menu site-menu-sellers site-menu-hidden js-clone-nav d-none d-lg-block">
                  <li
                  @if( Request::segment(1) == "sell_property")
                    class="active"
                  @endif
                  ><a href="{{ url('sell_property') }}">{{ _lang('Sell your property') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li
                  @if( Request::segment(1) == "our_agents")
                    class="active"
                  @endif
                  ><a href="{{ url('our_agents') }}">{{ _lang('OUR AGENTS') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li
                  @if( Request::segment(1) == "resources" or Request::segment(1) == "resources_buyers" or Request::segment(1) == "resources_sellers")
                    class="active"
                  @endif
                  ><a href="{{ url('resources_buyers') }}">{{ _lang('RESOURCES') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile" class="hide_if_mobile">|</li>
                  <li class="hide_if_mobile"><a href="tel:+14503477766"><img src="/public/images/icone-tel.png"> &nbsp; 450-347-7766</a></li>
                </ul>

                <ul class="site-menu site-menu-agents site-menu-hidden js-clone-nav d-none d-lg-block">
                  <li
                  @if( Request::segment(1) == "contact")
                    class="active"
                  @endif
                  ><a href="{{ url('contact') }}">{{ _lang('REACH OUR TEAM') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li
                  @if( Request::segment(1) == "about")
                    class="active"
                  @endif
                  ><a href="{{ url('about') }}">{{ _lang('ABOUT OUR TEAM') }}</a></li>
                  <li style="color:#ccc;" class="hide_if_mobile">|</li>
                  <li class="hide_if_mobile"><a href="tel:+14503477766"><img src="/public/images/icone-tel.png"> &nbsp; 450-347-7766</a></li>
                </ul>

              </nav>
            </div>


          </div>
        </div>
      </div>
    </div>

  	<!--Start Content -->
  	@yield('content')
  	<!-- End Content -->

    <div class="site-footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-6">
            @if (session('lang') === 'en')
            <a href="/fr/?path={{ Request::path() }}">
            @endif
              <strong>FRANÇAIS</strong>
            @if (session('lang') === 'en')
            </a>
            @endif
             |
            @if (session('lang') === 'fr')
            <a href="/en/?path={{ Request::path() }}">
            @endif
              <strong>ENGLISH</strong>
            @if (session('lang') === 'fr')
            </a>
            @endif
          </div>
          <div class="col-md-6 col-6 text-right">
            <a href="mailto:royallepage.stjean@bellnet.ca"><img src="/public/images/ico-mail.png" width="25"></a>&nbsp;
            <a href="https://www.linkedin.com/in/royal-lepage-excellence-308a2127/"><img src="/public/images/ico-li.png" width="25"></a>&nbsp;
            <a href="http://www.facebook.com/royallepageexcellence"><img src="/public/images/ico-fb.png" width="25"></a>&nbsp;
            <a href="http://www.twitter.com/rlpexcellence"><img src="/public/images/ico-tw.png" width="25"></a>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="">
              <div class="col-md-12">
                <h3 class="footer-heading">{{ _lang('BUY/SELL') }}</h3>
              </div>
              <div class="col-md-12 col-lg-12 list-footer-pad">
                <ul class="list-footer">
                  <li><a href="{{ url('properties') }}">- {{ _lang('available properties') }}</a></li>
                  <li><a href="{{ url('evaluation') }}">- {{ _lang('evaluation') }}</a></li>
                  <li><a href="{{ url('our_region') }}">- {{ _lang('our region') }}</a></li>
                </ul>
              </div>
              <div class="col-md-12">
                <h3 class="footer-heading">{{ _lang('RESOURCES') }}</h3>
              </div>
              <div class="col-md-12 col-lg-12 list-footer-pad">
                <ul class="list-footer">
                  <li><a href="{{ url('resources_buyers') }}">- {{ _lang('resources for buyers') }}</a></li>
                  <li><a href="{{ url('resources_sellers') }}">- {{ _lang('resources for sellers') }}</a></li>
                </ul>
              </div>
              <div class="col-md-12">
                <h3 class="footer-heading">{{ _lang('ROYAL LEPAGE EXCELLENCE') }}</h3>
              </div>
              <div class="col-md-12 col-lg-12 list-footer-pad">
                <ul class="list-footer">
                  <li><a href="{{ url('about') }}">- {{ _lang('our team') }}</a></li>
                  <li><a href="{{ url('careers') }}">- {{ _lang('your career') }}</a></li>
                  <li><a href="{{ url('contact') }}">- {{ _lang('contact us') }}</a></li>
                </ul>
              </div>

            </div>
          </div>
          <div class="col-lg-4 ">
            <div class="row ">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4 hide_if_mobile">{{ _lang('ROYAL LEPAGE EXCELLENCE') }}<br>
                </h3>
                <p>
                  <strong>{{ _lang('Real estate agency') }}</strong><br/>
                  ({{ _lang('independent franchise') }})<br/>
                  <p/>
                  {{ _lang('street_address_first') }}<br/>
                  {{ _lang('street_address_second') }}<br/>
                  <p/>
                  {{ _lang('phone') }} : 450.347.7766<br/>
                  {{ _lang('fax') }} : 450.347.0199<br/>
                </p>
              </div>
            </div>


          </div>

          <div class="col-lg-4 text-center">

                <div>
                  <div id="fb-root"></div>
                  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v4.0&appId=875443009503052&autoLogAppEvents=1"></script>

                  <div class="fb-page" data-href="https://www.facebook.com/royallepageexcellence/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/royallepageexcellence/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/royallepageexcellence/">Royal LePage Excellence</a></blockquote></div>
                </div>
                <br/>
          </div>

        </div>
        <br/>
        <div class="row pt-5 mt-5 text-left footer-copyright">
          <div class="col-md-12">
            <p>
              {{ _lang('disclaimer') }}

            </p>
            <p>
              {{ _lang('privacy_terms') }}

            </p>
            <p>
              {{ _lang('copyright') }}

            </p>
            <br/>
            <div class="row">
            <div class="col-md-6 col-6 text-left">
              <p>
                <strong>{{ _lang('Privacy policy') }} | {{ _lang('Non liability clause') }}</strong>
              </p>
            </div>
            <div class="col-md-6 col-6 text-right">
              <p>
              <strong><a href="https://localgo.ca">{{ _lang('LocalGo Marketing Web et SEO') }}</A></strong>
              </p>
            </div>
            </div>

          </div>

        </div>
      </div>
    </footer>

  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/mediaelement-and-player.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/select2.min.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/aos.js') }}"></script>
  <script src="{{ asset('public/theme/reallepageexcellence/js/js.cookie.min.js') }}"></script>

  <script src="{{ asset('public/theme/reallepageexcellence/js/main.js') }}"></script>

  <script type="text/javascript">
    $(document).on('change','#property-sorting',function(){
      var url = window.location.href;
      window.location.href = url+'?sorting='+$(this).val();
    });
  </script>

  @yield('js-script')

  </body>
</html>
