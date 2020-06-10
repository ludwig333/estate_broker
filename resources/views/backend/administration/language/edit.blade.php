@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Edit Translation') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{ action('LanguageController@update', $id) }}">
		{{ csrf_field() }}
		<input name="_method" type="hidden" value="PATCH">
		<div class="row">
			@foreach($language as $key=>$lang)
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ ucwords($key) }}</label>						
				<input type="text" class="form-control" name="language[{{ str_replace(' ','_',$key) }}]" value="{{ $lang }}" required>
			  </div>
			</div>
			@endforeach
			
			<div class="form-group">
			  <div class="col-md-12">
				<button type="submit" class="btn btn-primary">{{ _lang('Save Translation') }}</button>
			  </div>
			</div>
		</div>
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection
