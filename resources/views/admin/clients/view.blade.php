@extends('admin.layouts.app')
 
@section('title', 'Cadastrar Empresa')
 
@section('content')
	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Cadastrar Empresa</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('admin.clientes.index')}}">Empresas</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row row-sm">
					<div class="col-lg-12 col-md-12 col-md-12">
						<form action="{{route('admin.clientes.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="card custom-card">
								<div class="card-body">
									<div class="form-group">
										<label class="tx-medium">Nome</label>
										<input type="text" class="form-control" placeholder="Nome" name="name" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">E-mail</label>
										<input type="email" class="form-control" placeholder="E-mail" name="email" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Senha</label>
										<input type="password" class="form-control" placeholder="Senha" name="password" required>
									</div>
									<div class="form-group">
										<label class="tx-medium">Whatsapp</label>
										<input type="text" class="form-control" placeholder="Whatsapp" name="whatsapp">
									</div>
									<div class="form-group">
										<label class="tx-medium">CEP</label>
										<input type="text" class="form-control" placeholder="CEP" name="cep">
									</div>
									<div class="form-group">
										<label class="tx-medium">Endereço</label>
										<input type="text" class="form-control" placeholder="Endereço" name="address">
									</div>
									<div class="form-group">
										<label class="tx-medium">Número</label>
										<input type="text" class="form-control" placeholder="Número" name="number">
									</div>
									<div class="form-group">
										<label class="tx-medium">Bairro</label>
										<input type="text" class="form-control" placeholder="Bairro" name="area">
									</div>
									<div class="form-group">
										<label class="tx-medium">Complemento</label>
										<input type="text" class="form-control" placeholder="Complemento" name="complement">
									</div>
									<div class="form-group">
										<label class="tx-medium">Estado</label>
										<select class="form-control select2" name="state">
											<option>Selecione um estado...</option>
											@foreach($states as $state)
												<option data-id="{{$state->id}}" value="{{$state->sigla}}">{{$state->sigla}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label class="tx-medium">Cidade</label>
										<select class="form-control select2" name="city">
											<option>Selecione um estado...</option>
										</select>
									</div>
									<div class="form-group">
										<label class="tx-medium">Segmento</label>
										<input type="text" class="form-control" placeholder="Segmento" name="segment">
									</div>
									<div class="form-group">
										<label class="tx-medium">Link do Facebook</label>
										<input type="text" class="form-control" placeholder="Link do Facebook" name="facebook">
									</div>
									<div class="form-group">
										<label class="tx-medium">Link do Instagram</label>
										<input type="text" class="form-control" placeholder="Link do Instagram" name="instagram">
									</div>
									<div class="ql-wrapper ql-wrapper-demo mb-3">
										<label class="tx-medium">Horário de Funcionamento</label>
										<textarea id="summernote" name="opening_hours"></textarea>
									</div>
									<label class="tx-medium">Imagem</label>
									<div class="row mb-4">
										<div class="col-sm-12 col-md-4">
											<input type="file" class="dropify" data-height="200" name="image" />
										</div>
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