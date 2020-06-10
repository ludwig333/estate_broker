<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ get_option('site_title','WEBSITE') }}</title>

      <!-- plugins:css -->
	  <link rel="stylesheet" href="{{ asset('public/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
	  <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.base.css') }}">
	  <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.addons.css') }}">

	  <link href="{{ asset('public/css/datatables.css') }}" rel="stylesheet">
      <link href="{{ asset('public/css/select2.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/toastr.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/dropify.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/fullcalendar.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/animate.css') }}" rel="stylesheet">
	  <link href="{{ asset('public/css/summernote.css') }}" rel="stylesheet">
	  <!-- endinject -->
	  <!-- plugin css for this page -->
	  <!-- End plugin css for this page -->
	  <!-- inject:css -->
	  <link rel="stylesheet" href="{{ asset('public/css/app-style.css') }}">
	  <!-- endinject -->
	  <link rel="shortcut icon" href="{{ get_favicon() }}" />
      <script type="text/javascript">
	   var direction = "{{ get_option('backend_direction') }}";
	   var _url = "{{ asset('/') }}";
	   var u_s = "{{ get_option('max_upload_size') }}";
	  </script>
   </head>

<body>
 <!-- Main Modal -->
 <div id="main_modal" class="modal animated bounceInDown" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>

		<!--<button type="button" id="modal-fullscreen" class="modal-btn btn btn-primary btn-sm float-right"><i class="glyphicon glyphicon-fullscreen"></i> {{ _lang('Full Screen') }}</button>-->

		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="alert alert-danger" style="display:none; margin: 15px;"></div>
	  <div class="alert alert-success" style="display:none; margin: 15px;"></div>
	  <div class="modal-body" style="overflow:hidden;"></div>

    </div>
  </div>
</div>


 <div id="preloader">
	<div class="bar"></div>
 </div>


  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('dashboard') }}">
            <img class="logo " src="{{ get_logo() }}">
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('dashboard') }}">
			       <img class="logo " src="{{ get_logo() }}">
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
		<p class="page-title"></p>

        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">{{ _lang('Hello').", ".Auth::user()->name }}</span>
              <img class="img-xs rounded-circle" src="{{ Auth::user()->profile_picture !='' ? asset('public/uploads/profile/'.Auth::user()->profile_picture) : asset('public/images/avatar.png') }}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a href="{{ url('profile/edit') }}" class="dropdown-item mt-2">
			  {{ _lang('Manage Profile') }}
              </a>
              <a href="{{ url('profile/change_password') }}" class="dropdown-item">
                {{ _lang('Change Password') }}
              </a>
              <a href="{{ url('logout') }}" class="dropdown-item">
                {{ _lang('Sign Out') }}
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{ Auth::user()->profile_picture !='' ? asset('public/uploads/profile/'.Auth::user()->profile_picture) : asset('public/images/avatar.png') }}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }}</p>
                  <div>
                    <small class="designation text-muted">{{ ucwords(Auth::user()->user_type) }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">{{ _lang('Dashboard') }}</span>
            </a>
          </li>

      <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#property-management" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-city"></i>
              <span class="menu-title">{{ _lang('Property Management') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="property-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('property') }}">{{ _lang('All Properties') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('property/create') }}">{{ _lang('Add New') }}</a>
                </li>
        <li class="nav-item">
                  <a class="nav-link" href="{{ url('locations') }}">{{ _lang('Location') }}</a>
                </li>
        <li class="nav-item">
                  <a class="nav-link" href="{{ url('benefits') }}">{{ _lang('Features') }}</a>
                </li>
        <li class="nav-item">
                  <a class="nav-link" href="{{ url('property_types') }}">{{ _lang('Property Type') }}</a>
                </li>
              </ul>
            </div>
          </li>

      <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#agent-management" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-account-outline"></i>
              <span class="menu-title">{{ _lang('Agent Management') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="agent-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('agents') }}">{{ _lang('List Agent') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('agents/create') }}">{{ _lang('Add New') }}</a>
                </li>
              </ul>
            </div>
          </li>


      <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blog-management" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-format-align-right"></i>
              <span class="menu-title">{{ _lang('Blog') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog-management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('blog_posts') }}">{{ _lang('List Post') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('blog_posts/create') }}">{{ _lang('Add New') }}</a>
                </li>
        <li class="nav-item">
                  <a class="nav-link" href="{{ url('blog_categories') }}">{{ _lang('Blog Category') }}</a>
                </li>
              </ul>
            </div>
          </li>


      @if(Auth::user()->user_type == 'admin')
      <li class="nav-item">
      <a class="nav-link" href="{{ url('administration/theme_option') }}">
        <i class="menu-icon mdi mdi-monitor-multiple"></i>
        <span class="menu-title">{{ _lang('Site Option') }}</span>
      </a>
      </li>

        <li class="nav-item">
        <a class="nav-link" href="{{ url('faqs') }}">
          <i class="menu-icon mdi mdi-message-text-outline"></i>
          <span class="menu-title">{{ _lang('Faqs') }}</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-account-multiple"></i>
          <span class="menu-title">{{ _lang('User Management') }}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user-management">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users/create') }}">{{ _lang('Add New') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">{{ _lang('All User') }}</a>
          </li>
          </ul>
        </div>
        </li>

        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#language-management" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-earth"></i>
          <span class="menu-title">{{ _lang('Languages') }}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="language-management">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('languages/create') }}">{{ _lang('Add New') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('languages') }}">{{ _lang('All Language') }}</a>
          </li>
          </ul>
        </div>
        </li>


        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-memory"></i>
          <span class="menu-title">{{ _lang('Administration') }}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('administration/general_settings') }}"> {{ _lang('General Settings') }} </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('administration/backup_database') }}"> {{ _lang('Database Backup') }} </a>
          </li>
          </ul>
        </div>
        </li>
      @endif
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">

	   <!--Start Content -->
		 <div class="content-wrapper">
			@yield('content')
		 </div>
	   <!-- End Content -->

        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
              <a href="http://www.royallepageexcellence.com" target="_blank">Royal Lepage Excellence</a>. All rights reserved.</span>
          </div>
        </footer>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('public/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
	<script src="{{ asset('public/js/off-canvas.js') }}"></script>
	<script src="{{ asset('public/js/misc.js') }}"></script>

	<script src="{{ asset('public/js/datatables.min.js') }}"></script>
	<script src="{{ asset('public/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('public/js/vfs_fonts.js') }}"></script>

	<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('public/js/moment.min.js') }}"></script>
	<script src="{{ asset('public/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('public/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('public/js/select2.min.js') }}"></script>
	<script src="{{ asset('public/js/jquery.mask.min.js') }}"></script>
	<script src="{{ asset('public/js/dropify.min.js') }}"></script>
	<script src="{{ asset('public/js/toastr.js') }}"></script>
	<script src="{{ asset('public/js/summernote.js') }}"></script>
	<script src="{{ asset('public/js/sweetalert.min.js') }}"></script>
	<script src="{{ asset('public/js/print.js') }}"></script>
	<script src="{{ asset('public/js/app.js') }}"></script>

  <!-- endinject -->
  @if(Request::is('dashboard'))
	  <!-- Custom js for this page-->
	  <script src="{{ asset('public/js/dashboard.js') }}"></script>
	  <!-- End custom js for this page-->
  @endif

  @yield('js-script')

	 <script type="text/javascript">
		$(document).ready(function() {

            @if( ! Request::is('dashboard'))
				$(".page-title").html($(".panel-title").html());
			@else
				$(".page-title").html('{{ _lang('Dashboard') }}');
			@endif

			$(".data-table").DataTable({
				responsive: true,
				"bAutoWidth":false,
				"ordering": false,
				"language": {
				   "decimal":        "",
				   "emptyTable":     "{{ _lang('No Data Found') }}",
				   "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
				   "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
				   "infoFiltered":   "(filtered from _MAX_ total entries)",
				   "infoPostFix":    "",
				   "thousands":      ",",
				   "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
				   "loadingRecords": "{{ _lang('Loading...') }}",
				   "processing":     "{{ _lang('Processing...') }}",
				   "search":         "{{ _lang('Search') }}",
				   "zeroRecords":    "{{ _lang('No matching records found') }}",
				   "paginate": {
					  "first":      "{{ _lang('First') }}",
					  "last":       "{{ _lang('Last') }}",
					  "next":       "{{ _lang('Next') }}",
					  "previous":   "{{ _lang('Previous') }}"
				  },
				  "aria": {
					  "sortAscending":  ": activate to sort column ascending",
					  "sortDescending": ": activate to sort column descending"
				  }
			  },
			});


			$(".report-table").DataTable({
				responsive: true,
				"bAutoWidth":false,
				lengthChange: false,
				"ordering": false,
				"language": {
				   "decimal":        "",
				   "emptyTable":     "{{ _lang('No Data Found') }}",
				   "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
				   "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
				   "infoFiltered":   "(filtered from _MAX_ total entries)",
				   "infoPostFix":    "",
				   "thousands":      ",",
				   "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
				   "loadingRecords": "{{ _lang('Loading...') }}",
				   "processing":     "{{ _lang('Processing...') }}",
				   "search":         "{{ _lang('Search') }}",
				   "zeroRecords":    "{{ _lang('No matching records found') }}",
				   "paginate": {
					  "first":      "{{ _lang('First') }}",
					  "last":       "{{ _lang('Last') }}",
					  "next":       "{{ _lang('Next') }}",
					  "previous":   "{{ _lang('Previous') }}"
				  },
				  "aria": {
					  "sortAscending":  ": activate to sort column ascending",
					  "sortDescending": ": activate to sort column descending"
				  }
			  },
			  dom: 'Blfrtip',
			  buttons: [
			  'copy', 'csv', 'excel', 'pdf', 'print'
			  ],
			});


			//Show Success Message
			@if(Session::has('success'))
			   Command: toastr["success"]("{{session('success')}}")
			@endif

			//Show Single Error Message
			@if(Session::has('error'))
			   Command: toastr["error"]("{{session('error')}}")
			@endif


			@php $i =0; @endphp

			@foreach ($errors->all() as $error)
				Command: toastr["error"]("{{ $error }}");

				var name= "{{$errors->keys()[$i] }}";

				$("input[name='"+name+"']").addClass('error');
				$("select[name='"+name+"'] + span").addClass('error');

				$("input[name='"+name+"'], select[name='"+name+"']").parent().append("<span class='v-error'>{{$error}}</span>");

				@php $i++; @endphp

			@endforeach

		});
	 </script>

</body>
</html>
