<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{ config('app.name', 'Laravel') }}</title>
		<meta name="description" content="Emberlinestudios Login">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{asset('app/custom/login/login-v6.default.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

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

		<!--end::Global Theme Styles -->

        <style>
        #ESlogo .st0 {
            stroke-width: 1;
            stroke-miterlimit: 10;
            stroke: rgb(238,57,57);
            fill: rgb(238,57,57);
            stroke-dasharray: 1400;
            opacity: 10;
            animation: ESlogo 1.5s cubic-bezier(0, .23, 1, .1);
        }
        @keyframes ESlogo {
        0% {
            opacity: 0;
            fill: none;
            stroke-dashoffset: 1400;
        }
        30% {
            opacity: 10;
            fill: none;
            stroke-dashoffset: 1400;
        }
        90% {
            fill: rgba(238,57,57,0);
        }
        100% {
            opacity: 10;
            fill: rgba(238,57,57,1);
            stroke-dashoffset: 0;
        }
        }

        </style>
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{asset('media/logos/favicon.ico')}}" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
					<div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
						<div class="kt-login__wrapper">
							<div class="kt-login__container">
								<div class="kt-login__body">
									<div class="kt-login__logo">
										<a href="{{ url('/') }}">
											<svg width="65pt" height="65pt" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 263.21 205" style="enable-background:new 0 0 263.21 205;" xml:space="preserve">
                                                <g id="ESlogo">
                                                    <g>
                                                        <path class="st0" d="M67.41,33.75c9.04-3.5,19.22,0.87,22.91,9.84c7.25,10.4,21.56,12.95,31.96,5.7
                            c6.86-4.78,10.58-12.92,9.7-21.24c0-3.67-2.98-6.65-6.65-6.65s-6.65,2.98-6.65,6.65c0,1.76,0.69,3.44,1.93,4.69
                            c-6.92-6.92-6.92-18.13,0-25.04s18.13-6.92,25.04,0s6.92,18.13,0,25.04s-6.92,18.13,0,25.04s18.13,6.92,25.04,0
                            c3.32-3.32,5.19-7.83,5.19-12.52c0-2.33,0.61-4.62,1.78-6.64c3.67-6.35,11.79-8.53,18.14-4.86c-4.5,1.85-6.69,6.97-4.93,11.5
                            c8.06,17.36,28.66,24.89,46.01,16.83s24.89-28.66,16.83-46.01c-0.12-0.25-0.24-0.5-0.36-0.75c12.99,27.87,6.53,60.94-16.01,81.85
                            c-6.7-15.75-24.9-23.09-40.65-16.39c-6.76,2.87-12.27,8.06-15.57,14.62c-3.54,7.06-0.69,15.65,6.37,19.19
                            c1.72,0.86,3.6,1.37,5.53,1.49c-11.2,0.13-22.28-2.4-32.32-7.38c7.2-1.4,11.9-8.38,10.5-15.58c-1.4-7.2-8.38-11.9-15.58-10.5
                            c-6.24,1.22-10.74,6.68-10.74,13.04c0,7.05,2.8,13.8,7.78,18.78c6.64,6.64,10.37,15.65,10.37,25.04c0-7.34-5.95-13.28-13.28-13.28
                            s-13.28,5.95-13.28,13.28c0,7.05,2.8,13.8,7.78,18.78c3.1,3.1,5.39,6.93,6.65,11.13c4.22,14.05-3.74,28.86-17.79,33.09
                            c6.12-16.17,3.09-34.38-7.92-47.7c-11.8-15.83-13.14-37.13-3.4-54.31c4.36-6.59,2.55-15.46-4.04-19.81
                            c-6.59-4.36-15.46-2.55-19.81,4.04c-4.36,6.59-2.55,15.46,4.04,19.81c2.09,1.38,4.5,2.19,7,2.34c-10.9,6.18-23.24,9.36-35.77,9.21
                            c7.88-0.49,13.87-7.27,13.38-15.15c-0.12-1.92-0.63-3.8-1.49-5.53c-7.68-15.3-26.3-21.48-41.6-13.8
                            c-7.23,3.63-12.75,9.94-15.39,17.58C3.86,78.52-3.62,44.2,9.85,15.32C1.31,32.28,8.13,52.96,25.09,61.5s37.64,1.73,46.18-15.23
                            c0.17-0.33,0.33-0.67,0.49-1.01c2.15-3.92,0.71-8.84-3.21-10.99C68.18,34.07,67.8,33.89,67.41,33.75z" />
                                                    </g>
                                                </g>
                                            </svg>
										</a>
									</div>
									<div class="kt-login__signin">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Sign In To Admin</h3>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                <div class="form-group">
													<input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Email" value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
												<div class="form-group">
													<input class="form-control form-control-last  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
												<div class="kt-login__extra">
													<label class="kt-checkbox">
														<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
														<span></span>
                                                    </label>
                                                    @if (Route::has('password.request'))
													    <a href="{{ route('password.request') }}" id="kt_login_forgot">{{ __('Forgot Password?') }}</a>
                                                    @endif
                                                </div>
												<div class="kt-login__actions">
													<button id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">{{ __('Sign In') }}</button>
												</div>
											</form>
										</div>
									</div>
									
									<div class="kt-login__forgot">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Forgotten Password ?</h3>
											<div class="kt-login__desc">Enter your email to reset your password:</div>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" action="">
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
												</div>
												<div class="kt-login__actions">
													<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
													<button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url({{asset('media//bg/bg-4.jpg')}}">
						<div class="kt-login__section">
							<div class="kt-login__block">
								<h3 class="kt-login__title">YOUR SKYWARD COMPANION</h3>
								<div class="kt-login__desc">
                                      Concert Hall is the architecture of a new generation <br>A building
                                        that exists not only in the dimension of space.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
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
		<!--end::Global App Bundle -->
	</body>

	<!-- end::Body -->
</html>