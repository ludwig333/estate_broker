@extends('layouts.app')

@section('content')
 <div class="row">
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
	  <div class="card card-statistics">
		<div class="card-body">
		  <div class="clearfix">
			<div class="float-left">
			  <i class="mdi mdi-cube text-danger icon-lg"></i>
			</div>
			<div class="float-right">
			  <p class="mb-0 text-right">{{ _lang('Total Property') }}</p>
			  <div class="fluid-container">
				<h3 class="font-weight-medium text-right mb-0">{{ $total_property }}</h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
	  <div class="card card-statistics">
		<div class="card-body">
		  <div class="clearfix">
			<div class="float-left">
			  <i class="mdi mdi-receipt text-warning icon-lg"></i>
			</div>
			<div class="float-right">
			  <p class="mb-0 text-right">{{ _lang('Featured Property') }}</p>
			  <div class="fluid-container">
				<h3 class="font-weight-medium text-right mb-0">{{ $featured_property }}</h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
	  <div class="card card-statistics">
		<div class="card-body">
		  <div class="clearfix">
			<div class="float-left">
			  <i class="mdi mdi-poll-box text-success icon-lg"></i>
			</div>
			<div class="float-right">
			  <p class="mb-0 text-right">{{ _lang('Sold Property') }}</p>
			  <div class="fluid-container">
				<h3 class="font-weight-medium text-right mb-0">{{ $sold_property }}</h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
	  <div class="card card-statistics">
		<div class="card-body">
		  <div class="clearfix">
			<div class="float-left">
			  <i class="mdi mdi-account-location text-info icon-lg"></i>
			</div>
			<div class="float-right">
			  <p class="mb-0 text-right">{{ _lang('In-Active Property') }}</p>
			  <div class="fluid-container">
				<h3 class="font-weight-medium text-right mb-0">{{ $inactive_property }}</h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>


  <div class="row">
	<div class="col-lg-12 grid-margin">
	  <div class="card">
		<div class="card-body">
		  @if(count($recent_properties) > 0)
		  <h4 class="card-title">{{ _lang('Recently Added Property') }}</h4>
		  <div class="table-responsive">
			<table class="table table-bordered">
				<thead>
				  <tr>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Property Type') }}</th>
					<th>{{ _lang('Price') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th class="text-center">{{ _lang('Featured') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($recent_properties as $property)
				  <tr id="row_{{ $property->id }}">
					<td class='name'>{{ $property->name }}</td>
					<td class='property_type_id'>{{ isset($property->property_type) ? $property->property_type->type : '' }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($property->price) }}</td>
					<td class='status'>@if ($property->status == 'Active') <span class="badge badge-success">{{ $property->status }}</span> @else <span class="badge badge-danger">{{ $property->status }}</span> @endif</td>
					<td class='is_featured text-center'>@if ($property->is_featured == 1) <span class="badge badge-success">{{ _lang('Yes') }}</span> @else <span class="badge badge-danger">{{ _lang('No') }}</span> @endif</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('PropertyController@destroy', $property['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('PropertyController@edit', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('PropertyController@show', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								<a href="{{ action('PropertyController@gallery', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-image-filter"></i> {{ _lang('Gallery') }}</a>
								<button class="btn-remove dropdown-item" type="submit"><i class="mdi mdi-delete"></i> {{ _lang('Delete') }}</button>
							</div>
						  </form>
						</div>
					  
					</td>
				  </tr>
				  @endforeach
				</tbody>
			</table>
		  </div>
		  @else
			<h3 class="text-center">{{ _lang('No Property Found !') }}</h3>  
			<p class="text-center mt-4"><a class="btn btn-secondary" href="{{ url('property/create') }}"><i class="mdi mdi-plus-circle"></i> {{ _lang('Add Property') }}</a></p>  
		  @endif
		</div>
	  </div>
	</div>
  </div>

@endsection
