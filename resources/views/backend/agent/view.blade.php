@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			 <h4 class="card-title panel-title">{{ _lang('View Agent') }}</h4>
			 <table class="table table-bordered">
				<tr><td colspan="2" class="text-center"><img src="{{ asset('public/uploads/media/'.$agent->image) }}" class="img-lg"></td></tr>
				<tr><td>{{ _lang('Name') }}</td><td>{{ $agent->name }}</td></tr>
				<tr><td>{{ _lang('Email') }}</td><td>{{ $agent->email }}</td></tr>
				<tr><td>{{ _lang('Centris Agent Id') }}</td><td>{{ $agent->centris_agent_id }}</td></tr>
				<tr><td>{{ _lang('Phone') }}</td><td>{{ $agent->phone }}</td></tr>
				<tr><td>{{ _lang('Address') }}</td><td>{{ $agent->address }}</td></tr>
				<tr><td>{{ _lang('Description') }}</td><td>{{ $agent->description }}</td></tr>
				<tr><td>{{ _lang('Facebook') }}</td><td>{{ $agent->facebook }}</td></tr>
				<tr><td>{{ _lang('Twitter') }}</td><td>{{ $agent->twitter }}</td></tr>
				<tr><td>{{ _lang('Linkedin') }}</td><td>{{ $agent->linkedin }}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection
