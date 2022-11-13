@extends('admin.layouts.app')
 
@section('title', 'Dashboard')
 
@section('content')

	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Dashboard</h2>
					</div>
					{{-- <div class="d-flex">
						<div class="justify-content-center">
							<button type="button" class="btn btn-white btn-icon-text my-2 me-2">
							  <i class="fe fe-filter me-2"></i> Filtro
							</button>
						</div>
					</div> --}}
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
						<div class="card custom-card">
							<div class="card-body">
								<div class="card-order ">
									<label class="main-content-label mb-3 pt-1">Acompanhantes</label>
									<h2 class="text-end card-item-icon card-icon">
									<i class="icon-size mdi mdi-poll-box   float-start text-primary"></i><span class="font-weight-bold"></span>{{$totalClients}}</h2>
								</div>
							</div>
						</div>
					</div>
					<!-- COL END -->
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
						<div class="card custom-card">
							<div class="card-body">
								<div class="card-order ">
									<label class="main-content-label mb-3 pt-1">Aprovadas</label>
									<h2 class="text-end card-item-icon card-icon">
									<i class="icon-size mdi mdi-poll-box   float-start text-primary"></i><span class="font-weight-bold"></span>{{$totalClientsApproved}}</h2>
								</div>
							</div>
						</div>
					</div>
					<!-- COL END -->
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
						<div class="card custom-card">
							<div class="card-body">
								<div class="card-order">
									<label class="main-content-label mb-3 pt-1">Visualizações</label>
									<h2 class="text-end"><i class="mdi mdi-account-multiple icon-size float-start text-primary"></i><span class="font-weight-bold"></span>{{$totalViews}}</h2>
								</div>
							</div>
						</div>
					</div>
					<!-- COL END -->
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
						<div class="card custom-card">
							<div class="card-body">
								<div class="card-order">
									<label class="main-content-label mb-3 pt-1">Clicks</label>
									<h2 class="text-end"><i class="mdi mdi-cube icon-size float-start text-primary"></i><span class="font-weight-bold"></span>{{$totalClicks}}</h2>
								</div>
							</div>
						</div>
					</div>
					<!-- COL END -->
				</div>
				<!-- End Row -->
			</div>
		</div>
	</div>
	<!-- End Main Content-->

@endsection