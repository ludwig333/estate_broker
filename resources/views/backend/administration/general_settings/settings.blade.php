@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
		  <ul class="nav nav-tabs setting-tab">
			  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general">{{ _lang('General') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email">{{ _lang('Email') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logo">{{ _lang('Logo') }}</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#favicon">{{ _lang('Favicon') }}</a></li>
		  </ul>
		  <div class="tab-content">
				
			  <div id="general" class="tab-pane active">
				  <div class="card">
				  <div class="card-body">
				      <h4 class="card-title panel-title">{{ _lang('General Settings') }}</h4>
						  <form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/general_settings/update') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Company Name') }}</label>						
									<input type="text" class="form-control" name="company_name" value="{{ get_option('company_name') }}">
								  </div>
								</div>
								
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Site Title') }}</label>						
									<input type="text" class="form-control" name="site_title" value="{{ get_option('site_title') }}">
								  </div>
								</div>
								
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Currency Symbol') }}</label>						
									<input type="text" class="form-control" name="currency_symbol" value="{{ get_option('currency_symbol','$') }}" required>
								  </div>
								</div>
								
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Google map API KEY') }}</label>						
									<input type="text" class="form-control" name="google_map_api_key" value="{{ get_option('google_map_api_key') }}">
								  </div>
								</div>
								
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Timezone') }}</label>						
									<select class="form-control select2" name="timezone" required>
									<option value="">{{ _lang('-- Select One --') }}</option>
									{{ create_timezone_option(get_option('timezone')) }}
									</select>
								  </div>
								</div>
														
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Language') }}</label>						
									<select class="form-control select2" name="language" required>
										{{ load_language( get_option('language') ) }}
									</select>
								  </div>
								</div>
								
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Theme Direction') }}</label>						
									<select class="form-control" name="backend_direction" required>
										<option value="ltr" {{ get_option('backend_direction') == 'ltr' ? 'selected' : '' }}>{{ _lang('LTR') }}</option>
										<option value="rtl" {{ get_option('backend_direction') == 'rtl' ? 'selected' : '' }}>{{ _lang('RTL') }}</option>
									</select>
								  </div>
								</div>
								
									
								<div class="col-md-12">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
								  </div>
								</div>
							</div>
						</form>
					</div>
				  </div>
			  </div>
			 
			
			  <div id="email" class="tab-pane fade">
				<div class="card"> 
				  <div class="card-body">
				    <h4 class="card-title panel-title">{{ _lang('Email Settings') }}</h4>
					<form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/general_settings/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('Mail Type') }}</label>						
								<select class="form-control niceselect wide" name="mail_type" id="mail_type" required>
								  <option value="mail" {{ get_option('mail_type')=="mail" ? "selected" : "" }}>{{ _lang('PHP Mail') }}</option>
								  <option value="smtp" {{ get_option('mail_type')=="smtp" ? "selected" : "" }}>{{ _lang('SMTP') }}</option>
								</select>
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('From Email') }}</label>						
								<input type="text" class="form-control" name="from_email" value="{{ get_option('from_email') }}" required>
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('From Name') }}</label>						
								<input type="text" class="form-control" name="from_name" value="{{ get_option('from_name') }}" required>
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('SMTP Host') }}</label>						
								<input type="text" class="form-control smtp" name="smtp_host" value="{{ get_option('smtp_host') }}">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('SMTP Port') }}</label>						
								<input type="text" class="form-control smtp" name="smtp_port" value="{{ get_option('smtp_port') }}">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('SMTP Username') }}</label>						
								<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="{{ get_option('smtp_username') }}">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('SMTP Password') }}</label>						
								<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="{{ get_option('smtp_password') }}">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								<label class="control-label">{{ _lang('SMTP Encryption') }}</label>						
								<select class="form-control smtp" name="smtp_encryption">
								   <option value="ssl" {{ get_option('smtp_encryption')=="ssl" ? "selected" : "" }}>{{ _lang('SSL') }}</option>
								   <option value="tls" {{ get_option('smtp_encryption')=="tls" ? "selected" : "" }}>{{ _lang('TLS') }}</option>
								</select>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Settings') }}</button>
							  </div>
							</div>
						</div>	
					  </form>
				   </div>
				 </div>
			  </div>
			  
			  
			  <div id="logo" class="tab-pane fade">
			     <div class="card">
				    <div class="card-body">
					   <form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/upload_logo') }}" enctype="multipart/form-data">				         
							<h4 class="card-title panel-title">{{ _lang('Logo Upload') }}</h4>
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Upload Logo') }}</label>						
									<input type="file" class="form-control dropify" name="logo" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_logo() }}" required>
								  </div>
								</div>
							</div>	
							
							<div class="row">	
								<div class="col-md-6">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">{{ _lang('Upload') }}</button>
								  </div>
								</div>	
							</div>
					   </form>	
				   </div>
				 </div>
			  </div>
			  
			  <div id="favicon" class="tab-pane fade">
			     <div class="card">
				    <div class="card-body">
					   <form method="post" class="appsvan-submit params-panel" autocomplete="off" action="{{ url('administration/upload_favicon') }}" enctype="multipart/form-data">				         
							<h4 class="card-title panel-title">{{ _lang('Upload Favicon') }}</h4>
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Upload Favicon') }}</label>						
									<input type="file" class="form-control dropify" name="favicon" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_favicon() }}" required>
								  </div>
								</div>
							</div>	
							
							<div class="row">	
								<div class="col-md-6">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">{{ _lang('Upload') }}</button>
								  </div>
								</div>	
							</div>
					   </form>	
				   </div>
				 </div>
			  </div>
			  
		   </div>  
		</div>
	  </div>
     </div>
    </div>
@endsection

@section('js-script')
<script type="text/javascript">
if($("#mail_type").val() != "smtp"){
	$(".smtp").prop("disabled",true);
}
$(document).on("change","#mail_type",function(){
	if( $(this).val() != "smtp" ){
		$(".smtp").prop("disabled",true);
	}else{
		$(".smtp").prop("disabled",false);
	}
});

</script>
@stop

