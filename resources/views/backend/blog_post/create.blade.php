@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Add New Post') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('blog_posts')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Title') }} (FR)</label>
				<input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
			  </div>
			</div>
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Title') }} (EN)</label>
				<input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" required>
			  </div>
			</div>

			<div class="col-md-12">
			 <div class="form-group">
				<label class="control-label">{{ _lang('Excerpt') }} (FR)</label>
				<textarea class="form-control" rows="4" name="excerpt">{{ old('excerpt') }}</textarea>
			 </div>
			</div>

			<div class="col-md-12">
			 <div class="form-group">
				<label class="control-label">{{ _lang('Excerpt') }} (EN)</label>
				<textarea class="form-control" rows="4" name="excerpt_en">{{ old('excerpt_en') }}</textarea>
			 </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Content') }} (FR)</label>
				<textarea class="form-control summernote" name="content">{{ old('content') }}</textarea>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Content') }} (EN)</label>
				<textarea class="form-control summernote" name="content_en">{{ old('content_en') }}</textarea>
			  </div>
			</div>

			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Category') }}</label>
				<select class="form-control select2" name="cat_id" required>
					{{ create_option("blog_categories","id","name",old('cat_id')) }}
				</select>
			  </div>
			</div>

			<input type="hidden" name="post_type" value="post">

			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>
				<select class="form-control" name="status" required>
			       <option value="published">{{ _lang('Published') }}</option>
			       <option value="draft">{{ _lang('Draft') }}</option>
			       <option value="pending">{{ _lang('Pending') }}</option>
				</select>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Featured Image') }}</label>
				<input type="file" class="form-control dropify" name="featured_image">
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
				<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
			  </div>
			</div>
        </div>
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection
