@extends('client.layouts.app')

@section('title', 'Editar Imagem')

@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Editar Imagem</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('client.images.index')}}">Imagens</a></li>
							<li class="breadcrumb-item active" aria-current="page">Editar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('client.images.update', $image)}}" method="post" enctype="multipart/form-data">
							@csrf
							{{ method_field('PUT') }}
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Nome</label>
										<input type="text" class="form-control" placeholder="Nome" name="image_name" value="{{$image->image_name}}">
									</div>
									<div class="form-group">
										<label class="tx-medium">Imagem</label>
										<input type="file" class="form-control" name="image">
                    <img src="{{$image->name}}" height="100">
									</div>
								</div>
								<div class="card-footer mb-1">
									<button type="submit" class="btn btn-primary">Salvar</a>
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