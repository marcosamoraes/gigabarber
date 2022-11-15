@extends('client.layouts.app')
 
@section('title', 'Cadastrar Imagem')
 
@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Cadastrar Imagem</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('client.images.index')}}">Imagems</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('client.images.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Imagem</label>
										<input type="file" class="form-control" name="image" required>
									</div>
								</div>
								<div class="card-footer mb-1">
									<button type="submit" class="btn btn-primary">Cadastrar</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End Row -->

			</div>
		</div>
	</div>
	<!-- End Main Content-->
@endsection