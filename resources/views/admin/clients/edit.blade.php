@extends('admin.layouts.app')
 
@section('title', 'Editar Cliente')
 
@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Editar Cliente</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('admin.clients.index')}}">Clientes</a></li>
							<li class="breadcrumb-item active" aria-current="page">Editar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('admin.clients.update', $client->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							{{ method_field('PUT') }}
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Nome</label>
										<input type="text" class="form-control" placeholder="Nome" name="name" value="{{$client->name}}" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Slug</label>
										<input type="text" class="form-control" placeholder="Slug" name="slug" value="{{$client->slug}}" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">E-mail</label>
										<input type="email" class="form-control" placeholder="E-mail" name="email" value="{{$client->email}}" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Whatsapp</label>
										<input type="text" class="form-control" placeholder="Whatsapp" name="whatsapp" value="{{$client->whatsapp}}" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Visível</label>
										<select class="form-control select2" name="visible">
											<option value="0" {{!$client->visible ? 'selected' : false}}>Não</option>
											<option value="1" {{$client->visible ? 'selected' : false}}>Sim</option>
										</select>
									</div>
									<div class="form-group">
										<label class="tx-medium">Aprovado</label>
										<select class="form-control select2" name="approved">
											<option value="0" {{!$client->approved ? 'selected' : false}}>Não</option>
											<option value="1" {{$client->approved ? 'selected' : false}}>Sim</option>
										</select>
									</div>
									<div class="form-group">
										<label class="tx-medium">Status</label>
										<select class="form-control select2" name="active">
											<option value="1" {{$client->active ? 'selected' : false}}>Ativo</option>
											<option value="0" {{!$client->active ? 'selected' : false}}>Inativo</option>
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