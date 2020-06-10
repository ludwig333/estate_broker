@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('View User') }}</h4>

	  <table class="table table-bordered">
		<tr><td colspan="2"><img style="margin: auto;" class="thumb-image-md thumbnail" src="{{ $user->profile_picture != "" ? asset('public/uploads/profile/'.$user->profile_picture) : asset('public/images/avatar.png') }}"></td></tr>
		<tr><td>{{ _lang('Name') }}</td><td>{{ $user->name }}</td></tr>
		<tr><td>{{ _lang('Email') }}</td><td>{{ $user->email }}</td></tr>
		<tr><td>{{ _lang('User Type') }}</td><td>{{ $user->user_type }}</td></tr>	
	  </table>
	</div>
  </div>
 </div>
</div>
@endsection


