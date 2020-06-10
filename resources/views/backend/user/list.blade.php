@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">

			<div class="card-body">
			 
			<h4 class="card-title"><span class="panel-title">{{ _lang('User List') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add User') }}" data-href="{{route('users.create')}}">{{ _lang('Add New') }}</button>
			</h4>

			<table class="table table-bordered data-table">
			<thead>
			  <tr>
				<th>{{ _lang('Name') }}</th>
				<th>{{ _lang('Email') }}</th>
				<th>{{ _lang('User Type') }}</th>
				<th>{{ _lang('Status') }}</th>
				<th class="text-center">{{ _lang('Action') }}</th>
			  </tr>
			</thead>
			<tbody>
			  
			  @foreach($users as $user)
			    <tr id="row_{{ $user->id }}">
					<td class='name'>{{ $user->name }}</td>
					<td class='email'>{{ $user->email }}</td>
					<td class='user_type'>{{ ucwords($user->user_type) }}</td>					
					<td class='status'>{{ $user->status == 1 ? _lang('Active') : _lang('In-Active') }}</td>					
					<td class="text-center">
					  <form action="{{action('UserController@destroy', $user['id'])}}" method="post">
						<button data-href="{{action('UserController@edit', $user['id'])}}" data-title="{{ _lang('Update User') }}" class="btn btn-warning btn-sm ajax-modal">{{ _lang('Edit') }}</button>
						<button data-href="{{action('UserController@show', $user['id'])}}" data-title="{{ _lang('View User') }}" class="btn btn-info btn-sm ajax-modal">{{ _lang('View') }}</button>
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="DELETE">
						<button class="btn btn-danger btn-sm btn-remove" type="submit">{{ _lang('Delete') }}</button>
					  </form>
					</td>
			    </tr>
			  @endforeach
			</tbody>
		  </table>
			</div>
		</div>
	</div>
</div>

@endsection


