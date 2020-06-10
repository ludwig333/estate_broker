@extends('theme.reallepageexcellence.layouts.theme')

@section('content')

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ get_option('blog_banner_image') !='' ? asset('public/uploads/media/'.get_option('blog_banner_image')) : asset('public/theme/reallepageexcellence/images/hero_bg_2.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
	<div class="row align-items-center justify-content-center text-center">
	  <div class="col-md-10">
		<h1 class="mb-2">{{ _lang('Our Blog') }}</h1>
	  </div>
	</div>
  </div>
</div>

<div class="site-section">
  <div class="container">
	<div class="row">
	  @if(count($posts) == 0)
	    <div class="col-md-12 mb-4">
	       <h3 class="text-center">{{ _lang('No Post Found !') }}</h3>
		</div>
      @endif
	  @foreach($posts as $post)
	  <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
		<a href="{{ url('blog/'.$post->id.'/'.$post->title) }}">
		    @if($post->featured_image == '')
				<img src="{{ asset('public/theme/reallepageexcellence/images/no_blog_image.jpg') }}" alt="Image" class="img-fluid">
		    @else
				<img src="{{ asset('public/uploads/media/'.$post->featured_image) }}" alt="Image" class="img-fluid">
			@endif
		</a>
		<div class="p-4 bg-white">
		  <span class="d-block text-secondary small text-uppercase">

        @if(session("lang") == "fr")
        @php
        echo strftime('%e ',strtotime($post->created_at)).
        _lang(strtolower(strftime('%B',strtotime($post->created_at)))).
        strftime(', %Y',strtotime($post->created_at));
        @endphp
        @else
        @php
        echo strftime('%b %e, %Y',strtotime($post->created_at));
        @endphp
        @endif
      </span>
		  <h2 class="h5 text-black mb-3"><a href="{{ url('blog/'.$post->id.'/'.$post->title) }}">
        @if(session("lang") == "fr")
        {{ $post->title }}
        @else
        {{ $post->title_en }}
        @endif
      </a></h2>
		  <p>
        @if(session("lang") == "fr")
          {{ $post->excerpt }}
        @else
          {{ $post->excerpt_en }}
        @endif
      </p>
		</div>
	  </div>
	  @endforeach
	</div>

	<div class="row" data-aos="fade-up">
	  <div class="col-md-12 text-center">
		{{ $posts->links('theme.reallepageexcellence.pagination.default') }}
	  </div>
	</div>

  </div>
</div>


@endsection
