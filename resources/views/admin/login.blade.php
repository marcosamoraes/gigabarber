<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="{{env('APP_NAME')}}">
		<meta name="author" content="{{env('APP_NAME')}}">

		<!-- Favicon -->
		<link rel="icon" href="{{env('APP_URL')}}/assets/admin/img/brand/favicon.ico" type="image/x-icon"/>

		<!-- Title -->
		<title>{{env('APP_NAME')}} - Login</title>

		<!-- Bootstrap css-->
		<link  id="style" href="{{env('APP_URL')}}/assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="{{env('APP_URL')}}/assets/admin/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="{{env('APP_URL')}}/assets/admin/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="{{env('APP_URL')}}/assets/admin/plugins/web-fonts/plugin.css" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{env('APP_URL')}}/assets/admin/css/style.css" rel="stylesheet">
	</head>

	<body class="ltr main-body leftmenu error-1">

		@foreach ($errors->all() as $error)
			<div class="alert alert-solid-danger mg-b-0" role="alert">
				<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
				<span aria-hidden="true">&times;</span></button>
				{{ $error }}
			</div>
		@endforeach

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{env('APP_URL')}}/assets/admin/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page main-signin-wrapper">

			<!-- Row -->
			<div class="row signpages text-center">
				<div class="col-md-12">
					<div class="card">
						<div class="row row-sm">
							<div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details" style="padding-left: 0!important">
								<div class="mt-5 pt-4 p-2 pos-absolute w-100">
									<div class="clearfix"></div>
									<img src="{{env('APP_URL')}}/assets/admin/img/svgs/user.svg" class="ht-100 mb-0" alt="user">
									<h5 class="mt-4 text-white">{{env('APP_NAME')}}</h5>
									<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Painel Administrativo</span>
								</div>
							</div>
							<div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
								<div class="main-container container-fluid">
									<div class="row row-sm">
										<div class="card-body mt-2 mb-2">
											<div class="clearfix"></div>
											<form method="post" action="{{route('admin.authenticate')}}">
												@csrf
												<div class="form-group text-start">
													<label>E-mail</label>
													<input class="form-control" placeholder="E-mail" name="email" type="email">
												</div>
												<div class="form-group text-start">
													<label>Senha</label>
													<input class="form-control" placeholder="Senha" name="password" type="password">
												</div>
												<button class="btn ripple btn-main-primary btn-block">Entrar</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
		<!-- End Page -->

		<!-- Jquery js-->
		<script src="{{env('APP_URL')}}/assets/admin/plugins/jquery/jquery.min.js"></script>
		
		<!-- Jquery Mask js -->
		<script src="{{env('APP_URL')}}/assets/admin/js/jquery.mask.min.js"></script>

		<!-- Bootstrap js-->
		<script src="{{env('APP_URL')}}/assets/admin/plugins/bootstrap/js/popper.min.js"></script>
		<script src="{{env('APP_URL')}}/assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Select2 js-->
		<script src="{{env('APP_URL')}}/assets/admin/plugins/select2/js/select2.min.js"></script>
		<script src="{{env('APP_URL')}}/assets/admin/js/select2.js"></script>

		<!-- Perfect-scrollbar js -->
		<script src="{{env('APP_URL')}}/assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

		<!-- Color Theme js -->
		<script src="{{env('APP_URL')}}/assets/admin/js/themeColors.js"></script>

		<!-- Custom js -->
		<script src="{{env('APP_URL')}}/assets/admin/js/custom.js"></script>
	</body>
</html>