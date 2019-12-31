<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>@yield('page_title', 'Default Title')</title>
		<meta name="description" content="Google Cloud Vision Product Integration">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('vendors/general/prism/prism.css')}}" />
		<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Fonts -->

		
		<!--end::Page Vendors Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="{{asset('vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<link href="{{asset('vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/custom/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{asset('demo/demo10/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('ember/rubber-slider.css')}}" rel="stylesheet" type="text/css" />
		

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{asset('media/logos/favicon.ico')}}" />
		@yield('pageStyles')
		<style>
			.sub-title {
				font-family: 'Muli','Poppins';
				margin: 23px 0px;
				font-weight:bold;
			}
			.power-off:hover {
				transform: scale(1.2);
			}
			.power-off {
				transition: all 1s;
				transform-origin: 50% 50%;
			}
			.dropdown-menu {
				filter: blur(0px) !important;
			}
		</style>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-page--fixed kt-page-content-white kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->

		<!--begin::Portlet-->


		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="/">
					<img alt="Logo" width="80" src="{{asset('media/logos/emberlines.png')}}" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
						<div class="kt-header__top">
							<div class="kt-container">

								<!-- begin:: Brand -->
								<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
									<div class="kt-header__brand-logo">
										<a href="/">
											<img alt="Logo" width="150" src="{{asset('media/logos/emberlines.png')}}" class="kt-header__brand-logo-default" />
										</a>
									</div>
									<div class="kt-header__brand-nav">
										
										<div class="dropdown">
											<button type="button" class="btn btn-pill btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												Dashboard
											</button>
											<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md">
												<ul class="kt-nav kt-nav--bold kt-nav--md-space kt-margin-t-20 kt-margin-b-20">
													<li class="kt-nav__item">
														<a class="kt-nav__link active" href="/admin/project/add">
															<span class="kt-nav__link-icon"><i class="flaticon2-user"></i></span>
															<span class="kt-nav__link-text">Add Project</span>
														</a>
													</li>
													<li class="kt-nav__separator"></li>
													<li class="kt-nav__item">
														<a class="kt-nav__link" href="/admin/projects">
															<span class="kt-nav__link-icon"><i class="flaticon-feed"></i></span>
															<span class="kt-nav__link-text">Show Projects</span>
														</a>
													</li>
													
													
													
												</ul>
											</div>
										</div>
									</div>
									
								</div>

								<div class="kt-header__topbar kt-grid__item kt-grid__item--fluid">
										<div class="kt-header__topbar-wrapper" data-offset="10px,0px">
										<a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class="power-off" title="Signout" >
											<svg  data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Signout" class="power-off" style="margin-top: 65%;" height="20pt" viewBox="0 0 464 464" width="20pt" xmlns="http://www.w3.org/2000/svg"><path d="m232 216c8.835938 0 16-7.164062 16-16v-144c0-8.835938-7.164062-16-16-16s-16 7.164062-16 16v144c0 8.835938 7.164062 16 16 16zm0 0" fill="#f1f2f2"/><path d="m303.273438 97.726562c-4.429688-2.394531-9.726563-2.582031-14.3125-.503906-4.585938 2.082032-7.933594 6.1875-9.050782 11.097656v.105469c-1.546875 7.039063 1.808594 14.246094 8.195313 17.597657 48.75 25.773437 73.660156 81.457031 60.382812 134.980468-13.277343 53.523438-61.324219 91.109375-116.46875 91.109375s-103.191406-37.585937-116.46875-91.109375c-13.277343-53.523437 11.632813-109.207031 60.386719-134.980468 6.386719-3.347657 9.742188-10.554688 8.199219-17.597657v-.097656c-1.105469-4.902344-4.433594-9.007813-9.007813-11.09375-4.570312-2.089844-9.851562-1.921875-14.28125.453125-61.667968 32.71875-93.121094 103.234375-76.265625 170.976562 16.855469 67.746094 77.691407 115.296876 147.503907 115.296876 69.808593 0 130.644531-47.550782 147.5-115.296876 16.855468-67.742187-14.597657-138.257812-76.265626-170.976562zm0 0" fill="#f1f2f2"/><path d="m232 0v40c8.835938 0 16 7.164062 16 16v144c0 8.835938-7.164062 16-16 16v135.832031c1.960938 0 3.886719.121094 5.863281 0 53.96875-2.632812 99.515625-41.023437 111.242188-93.769531 11.730469-52.742188-13.257813-106.816406-61.027344-132.070312-6.382813-3.351563-9.738281-10.558594-8.191406-17.601563v-.101563c1.117187-4.910156 4.464843-9.019531 9.050781-11.097656s9.882812-1.894531 14.308594.503906c61.707031 32.703126 93.1875 103.242188 76.324218 171.011719-16.863281 67.765625-77.734374 115.324219-147.570312 115.292969v80c128.128906 0 232-103.871094 232-232s-103.871094-232-232-232zm0 0" fill="#ff4764"/><path d="m214.59375 383.03125c-66.179688-7.59375-119.703125-57.390625-132.042969-122.851562-12.339843-65.457032 19.378907-131.324219 78.25-162.492188 4.425781-2.375 9.710938-2.542969 14.28125-.453125 4.570313 2.085937 7.902344 6.191406 9.007813 11.09375v.097656c1.542968 7.042969-1.8125 14.25-8.203125 17.597657-48.726563 25.738281-73.625 81.386718-60.332031 134.871093 13.289062 53.480469 61.335937 91.003907 116.445312 90.9375v-135.832031c-8.835938 0-16-7.164062-16-16v-144c0-8.835938 7.164062-16 16-16v-40c-128.128906 0-232 103.871094-232 232s103.871094 232 232 232v-80c-5.816406-.003906-11.628906-.324219-17.40625-.96875zm0 0" fill="#ff3051"/></svg>		
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</div>
								</div>
								
								<!-- end:: Brand -->

								
								<!-- end:: Header Topbar -->
							</div>
						</div>
					</div>


					<div class="kt-portlet" id="block_app">
		               @yield("content")
		            </div>
					
					<!-- begin:: Footer -->
					<div class="kt-footer kt-grid__item" id="kt_footer">
						<div class="kt-container">
							<div class="kt-footer__bottom">
								<div class="kt-footer__copyright">
									<?=date("Y")?>&nbsp;&copy;&nbsp;<a href="https://emberlinestudios.com/" target="_blank" class="kt-link">Emberlinestudios Inc</a>
								</div>
								<div class="kt-footer__menu">
									<a href="https://emberlinestudios.com/" target="_blank" class="kt-link">About</a>
									<a href="https://emberlinestudios.com/" target="_blank" class="kt-link">Team</a>
									<a href="https://emberlinestudios.com/" target="_blank" class="kt-link">Contact</a>
								</div>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		

	
		<!-- begin::Demo Panel -->
		

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->
		<script src="{{asset('vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
		
		<!--begin:: Global Mandatory Vendors -->
		<script src="{{asset('vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
		
		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="{{asset('vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
		{{-- <script src="{{asset('vendors/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script> --}}
		
		<script src="{{asset('vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/custom/components/vendors/jquery-validation/init.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/custom/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('vendors/custom/components/vendors/sweetalert2/init.js')}}" type="text/javascript"></script>
		
		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{asset('demo/demo10/base/scripts.bundle.js')}}" type="text/javascript"></script>
		
		
		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		
		<!--end::Page Vendors -->

		
		<!--end::Page Scripts -->

		<!--begin::Global App Bundle(used by all pages) -->
		<script src="{{ asset('app/bundle/app.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('vendors/general/prism/prism.js')}}"></script>
		<script src="{{ asset('app/custom/general/crud/datatables/extensions/buttons.js')}}" type="text/javascript"></script>
		<script src="{{ asset('vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
		
		
		<script src="https://unpkg.com/cropperjs"></script>
		@yield("pageScripts")
		
		<!--end::Global App Bundle -->
	</body>

	<!-- end::Body -->
</html>