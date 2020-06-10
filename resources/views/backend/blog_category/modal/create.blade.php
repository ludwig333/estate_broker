<form method="post" class="ajax-submit" autocomplete="off" action="{{route('blog_categories.store')}}" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="col-md-12">
		<div class="form-group">
		<label class="control-label">{{ _lang('Name') }} (FR)</label>
		<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
		</div>

	</div>
	<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">{{ _lang('Name') }} (EN)</label>
	<input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" required>
	</div>
</div>

<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">{{ _lang('Description') }} (FR)</label>
	<textarea class="form-control" name="description">{{ old('description') }}</textarea>
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">{{ _lang('Description') }} (EN)</label>
	<textarea class="form-control" name="description_en">{{ old('description_en') }}</textarea>
	</div>
</div>


	<div class="col-md-12">
	  <div class="form-group">
	    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
		<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
	  </div>
	</div>
</form>
