@extends('theme.reallepageexcellence.layouts.theme')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ $post->featured_image != '' ? asset('public/uploads/media/'.$post->featured_image) : asset('public/theme/reallepageexcellence/images/no_blog_image.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">
              @if(session("lang") == "fr")
              {{ $post->title }}
              @else
              {{ $post->title_en }}
              @endif
            </h1>
          </div>
        </div>
      </div>
    </div>

	<div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="bg-white property-body border-bottom border-left border-right">
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Posted On') }}</span>
                  <strong class="d-block">
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
                  </strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Category') }}</span>
                  <strong class="d-block">
                    @if(session("lang") == "fr")
                    {{ isset($post->category) ? $post->category->name : _lang('N/A') }}
                    @else
                    {{ isset($post->category) ? $post->category->name_en : _lang('N/A') }}
                    @endif
                  </strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">{{ _lang('Author') }}</span>
                  <strong class="d-block">{{ isset($post->author) ? $post->author->name : _lang('N/A') }}</strong>
                </div>
              </div>
              <!-- <h2 class="h4 text-black">{{ _lang('Description') }}</h2> -->
              @if(session("lang") == "fr")
              @php echo clean($post->content) @endphp
              @else
              @php echo clean($post->content_en) @endphp
              @endif

            </div>
          </div>
          <div class="col-lg-4">

            <div class="bg-white widget categories border rounded">

              <h3 class="h4 text-black widget-title mb-3">{{ _lang('Blog Category') }}</h3>
			  @foreach($blog_categories as $cat)
				<div class="item d-flex justify-content-between"><a href="{{ url('blog_category/'.$cat->id.'/'.$cat->name) }}">
          @if(session("lang") == "fr")
          {{ $cat->name }}
          @else
          {{ $cat->name_en }}
          @endif
        </a><span>{{ $cat->post->count() }}</span></div>
              @endforeach
			</div>

            <div class="bg-white widget latest-posts border rounded">
              <h3 class="h4 text-black widget-title mb-3">{{ _lang('Recent Post') }}</h3>
              <div class="blog-posts">
				  @foreach($recent_posts as $rp)
				  <a href="{{ url('blog/'.$rp->id.'/'.$rp->title) }}">
					<div class="item d-flex align-items-center">
					  <div class="image">
					    @if($rp->featured_image == '')
							<img src="{{ asset('public/theme/reallepageexcellence/images/no_blog_image.jpg') }}" alt="{{ $rp->title }}" class="img-fluid">
					    @else
							<img src="{{ asset('public/uploads/media/'.$rp->featured_image) }}" alt="{{ $rp->title }}" class="img-fluid">
						@endif
					  </div>
					  <div class="title"><strong>
              @if(session("lang") == "fr")
              {{ $rp->title }}
              @else
              {{ $rp->title_en }}
              @endif
            </strong>
					    <div class="d-flex align-items-center">
						  <div class="posted">
                @if(session("lang") == "fr")
                @php
                echo strftime('%e ',strtotime($rp->created_at)).
                _lang(strtolower(strftime('%B',strtotime($rp->created_at)))).
                strftime(', %Y',strtotime($rp->created_at));
                @endphp
                @else
                @php
                echo strftime('%b %e, %Y',strtotime($rp->created_at));
                @endphp
                @endif
                </div>
						</div>
					  </div>
					</div>
				  </a>
				  @endforeach
				</div>
            </div>

          </div>

        </div>
      </div>
    </div>


@endsection
