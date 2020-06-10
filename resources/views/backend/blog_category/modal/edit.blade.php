<form method="post" class="ajax-submit" autocomplete="off" action="{{action('BlogCategoryController@update', $id)}}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">

	<div class="col-md-12">
		<div class="form-group">
		 <label class="control-label">{{ _lang('Name') }} (FR)</label>
		 <input type="text" class="form-control" name="name" value="{{ $blogcategory->name }}" required>
		</div>
	 </div>
	 <div class="col-md-12">

	 <div class="form-group">
		<label class="control-label">{{ _lang('Name') }} (EN)</label>
		<input type="text" class="form-control" name="name_en" value="{{ $blogcategory->name_en }}" required>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Description') }} (FR)</label>
		<textarea class="form-control" name="description">{{ $blogcategory->description }}</textarea>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Description') }} (EN)</label>
		<textarea class="form-control" name="description_en">{{ $blogcategory->description_en }}</textarea>
	 </div>
	</div>


	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
	  </div>
	</div>
</form>
