@extends('client.layouts.app')
 
@section('title', 'Editar Categoria')
 
@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Editar Categoria</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('client.categories.index')}}">Categorias</a></li>
							<li class="breadcrumb-item active" aria-current="page">Editar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('client.categories.update', $category)}}" method="post" enctype="multipart/form-data">
							@csrf
							{{ method_field('PUT') }}
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Nome</label>
										<input type="text" class="form-control" placeholder="Nome" name="name" value="{{$category->name}}" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Status</label>
										<select class="form-control select2" name="active">
											<option value="1" {{$category->active ? 'selected' : false}}>Ativo</option>
											<option value="0" {{!$category->active ? 'selected' : false}}>Inativo</option>
										</select>
									</div>
								</div>
								<div class="card-footer mb-1">
									<button type="submit" class="btn btn-primary">Editar</a>
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