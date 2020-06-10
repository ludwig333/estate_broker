 AOS.init({
 	duration: 800,
 	easing: 'slide',
 	once: true
 });

jQuery(document).ready(function($) {

	"use strict";

	// Loading page
	var loaderPage = function() {
		$(".site-loader").fadeOut("slow");
	};
	loaderPage();

  $('.owl-carousel').owlCarousel({
      // loop:true,
      responsiveClass:true,
      responsive:{
              0:{
                  items:1,
                  nav:true
              },
              600:{
                  items:3,
                  nav:false
              },
              1000:{
                  items:3,
                  nav:true,
                  loop:false
              }
          },
      margin:10,
      nav:true,
      navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],

  });

	var siteMenuClone = function() {

		$('.js-clone-nav').each(function() {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function() {

			var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);

        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

		$('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();

    });

		$(window).resize(function() {
			var $this = $(this),
				w = $this.width();

			if ( w > 768 ) {
				if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function(e) {
			var $this = $(this);
			e.preventDefault();

			if ( $('body').hasClass('offcanvas-menu') ) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		})

		// click outisde offcanvas
		$(document).mouseup(function(e) {
	    var container = $(".site-mobile-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
	    }
		});
	};
	siteMenuClone();


	var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 0  ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(0));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	// sitePlusMinus();


	var siteSliderRange = function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	};
	// siteSliderRange();


	var siteMagnificPopup = function() {
		$('.image-popup').magnificPopup({
	    type: 'image',
	    closeOnContentClick: true,
	    closeBtnInside: false,
	    fixedContentPos: true,
	    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
	     gallery: {
	      enabled: true,
	      navigateByImgClick: true,
	      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	    },
	    image: {
	      verticalFit: true
	    },
	    zoom: {
	      enabled: true,
	      duration: 300 // don't foget to change the duration also in CSS
	    }
	  });

	  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	    disableOn: 700,
	    type: 'iframe',
	    mainClass: 'mfp-fade',
	    removalDelay: 160,
	    preloader: false,

	    fixedContentPos: false
	  });
	};
	siteMagnificPopup();


	var siteCarousel = function () {
		if ( $('.nonloop-block-13').length > 0 ) {
			$('.nonloop-block-13').owlCarousel({
		    center: false,
		    items: 1,
		    loop: true,
				stagePadding: 0,
				autoplay: true,
		    margin: 20,
		    nav: false,
		    dots: true,
				navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        responsiveClass:true,
        responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            },
			});
		}

		if ( $('.slide-one-item').length > 0 ) {
			$('.slide-one-item').owlCarousel({
		    center: false,
		    items: 1,
		    loop: true,
				stagePadding: 0,
		    margin: 0,
		    autoplay: true,
		    pauseOnHover: false,
		    nav: true,
        responsiveClass:true,
        responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            },
		    animateOut: 'fadeOut',
		    animateIn: 'fadeIn',
		    navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">']
		  });
	  }


	  if ( $('.nonloop-block-4').length > 0 ) {
		  $('.nonloop-block-4').owlCarousel({
		    center: true,
		    items:1,
		    loop:false,
		    margin:10,
		    nav: true,

				navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
        responsiveClass:true,
        responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            },
			});
		}

		if ( $('.agent-carousel').length > 0 ) {
		  $('.agent-carousel').owlCarousel({
			loop:true,
			margin:15,
      responsiveClass:true,
      responsive:{
              0:{
                  items:1,
                  nav:true
              },
              600:{
                  items:3,
                  nav:false
              },
              1000:{
                  items:3,
                  nav:true,
                  loop:false
              }
          },
		});

		}

	};
	siteCarousel();

	var siteStellar = function() {
		$(window).stellar({
	    responsive: false,
	    parallaxBackgrounds: true,
	    parallaxElements: true,
	    horizontalScrolling: false,
	    hideDistantElements: false,
	    scrollProperty: 'scroll'
	  });
	};
	siteStellar();

	var siteCountDown = function() {

		if ( $('#date-countdown').length > 0 ) {
			$('#date-countdown').countdown('2020/10/10', function(event) {
			  var $this = $(this).html(event.strftime(''
			    + '<span class="countdown-block"><span class="label">%w</span> weeks </span>'
			    + '<span class="countdown-block"><span class="label">%d</span> days </span>'
			    + '<span class="countdown-block"><span class="label">%H</span> hr </span>'
			    + '<span class="countdown-block"><span class="label">%M</span> min </span>'
			    + '<span class="countdown-block"><span class="label">%S</span> sec</span>'));
			});
		}

	};
	siteCountDown();

	var siteDatePicker = function() {

		if ( $('.datepicker').length > 0 ) {
			$('.datepicker').datepicker();
		}

	};
	siteDatePicker();

	var select2Box = function() {

		if ( $('.select2').length > 0 ) {
			$('.select2').select2();
		}

	};
	select2Box();

  var select_slider_buyers = function() {
    var new_class = 'slider_buyers_bg';
    $('.slider_bg').removeClass(current_slider).addClass(new_class);
    current_slider = new_class;

    $('#slider_agents_content').hide();
    $('#slider_sellers_content').hide();
    $('#slider_buyers_content').show();

    $('.site-menu-buyers').removeClass('site-menu-hidden');
    $('.site-menu-sellers').addClass('site-menu-hidden');
    $('.site-menu-agents').addClass('site-menu-hidden');


    $(".site-top-menu li").removeClass('active');
    $(".menu_buyers").toggleClass( "active" );
  }

  var select_slider_sellers = function() {
    var new_class = 'slider_sellers_bg';
    $('.slider_bg').removeClass(current_slider).addClass(new_class);
    current_slider = new_class;

    $('#slider_buyers_content').hide();
    $('#slider_agents_content').hide();
    $('#slider_sellers_content').show();

    $('.site-menu-sellers').removeClass('site-menu-hidden');
    $('.site-menu-buyers').addClass('site-menu-hidden');
    $('.site-menu-agents').addClass('site-menu-hidden');


    $(".site-top-menu li").removeClass('active');
    $(".menu_sellers").toggleClass( "active" );
  }

  var select_slider_agents = function() {
    var new_class = 'slider_agents_bg';
    $('.slider_bg').removeClass(current_slider).addClass(new_class);
    current_slider = new_class;

    $('#slider_buyers_content').hide();
    $('#slider_sellers_content').hide();
    $('#slider_agents_content').show();

    $('.site-menu-agents').removeClass('site-menu-hidden');
    $('.site-menu-buyers').addClass('site-menu-hidden');
    $('.site-menu-sellers').addClass('site-menu-hidden');


    $(".site-top-menu li").removeClass('active');
    $(".menu_agents").toggleClass( "active" );
  }

  var current_slider = 'slider_buyers_bg';
  var cookie_current_slider = Cookies.get('current_slider');
  if (cookie_current_slider) {
    current_slider = cookie_current_slider;
    if (current_slider == "slider_sellers_bg") {
      select_slider_sellers();
    }
    if (current_slider == "slider_agents_bg") {
      select_slider_agents();
    }
  }

  var siteMenuEvents = function() {
    $(".site-menu li").click(function(){
      // $("li").removeClass('active');
      // $( this ).toggleClass( "active" );

      if ($( this ).hasClass('menu_buyers')) {
        select_slider_buyers();
      }

      if ($( this ).hasClass('menu_sellers')) {
        select_slider_sellers();
      }

      if ($( this ).hasClass('menu_agents')) {
        select_slider_agents();
      }

      Cookies.set('current_slider', current_slider);

    });

  }
  siteMenuEvents();

});
