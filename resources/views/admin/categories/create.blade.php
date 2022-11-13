@extends('admin.layouts.app')
 
@section('title', 'Cadastrar Categoria')
 
@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Cadastrar Categoria</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">Categorias</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Nome</label>
										<input type="text" class="form-control" placeholder="Nome" name="name" required>
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