@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="cards no-export">
			<div class="cards-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Languages') }}</span>
				<a class="btn btn-primary btn-sm float-right" href="{{ route('languages.create') }}">{{ _lang('Add New') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Language Name') }}</th>
					<th>{{ _lang('Edit Translation') }}</th>
					<th>{{ _lang('Remove') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach(get_language_list() as $language)
				  <tr>
					<td class='role_name'>{{ ucwords($language) }}</td>
					<td>
						<a href="{{ action('LanguageController@edit', $language) }}" class="btn btn-info btn-sm">{{ _lang('Edit Translation') }}</a>
					</td>	
					<td>
					    <form action="{{action('LanguageController@destroy', $language)}}" method="post">
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


