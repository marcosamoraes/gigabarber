@extends('admin.layouts.app')
 
@section('title', 'Clientes')
 
@section('content')

	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Clientes</h2>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="{{route('admin.clients.create')}}" class="btn btn-primary my-2 btn-icon-text">
							  <i class="fe fe-plus me-2"></i> Cadastrar
							</a>
						</div>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-12">
						<div class="card custom-card transcation-crypto">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table" id="example1">
										<thead>
											<tr>
												<th class="text-center">Nome</th>
												<th>E-mail</th>
												<th>Whatsapp</th>
												<th>Cidade</th>
												<th>Verificado</th>
												<th>Ativo</th>
												<th>Data de criação</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($clients as $client)
												<tr class="border-bottom">
													<td class="font-weight-bold text-center">
														<a href="{{$client->slug}}" target="_blank">
															<img src="{{$client->logo}}" class="avatar avatar-sm me-2" alt="" style="margin: auto!important;">
															{{$client->name}}
														</a>
													</td>
													<td>{{$client->email}}</td>
													<td><a target="_blank" href="https://api.whatsapp.com/send?phone=55{{preg_replace('/\D/', '', $client->whatsapp)}}">{{$client->whatsapp}}</a></td>
													<td>
														@if ($client->address[0]->city)
															{{$client->address[0]->city}}/{{$client->address[0]->state}}
														@endif
													</td>
													<td>
														@if(filled($client->email_verified_at))
															<span class="text-success font-weight-semibold">Sim</span>
														@else
															<span class="text-danger font-weight-semibold">Não</span>
														@endif
													</td>
													<td>
														@if($client->active)
															<span class="text-success font-weight-semibold">Sim</span>
														@else
															<span class="text-danger font-weight-semibold">Não</span>
														@endif
													</td>
													<td>
														{{ formatDate($client->created_at) }}
													</td>
													<td>
														<div class="btn-group" role="group">
															<a href="{{route('admin.clients.impersonate', $client->uuid)}}" class="btn btn-primary">
																<i class="fa fa-user-secret"></i>
															</a>

															<a href="{{route('admin.clients.edit', $client)}}" class="btn btn-warning">
																<i class="fa fa-edit"></i>
															</a>

															<form method="post" action="{{route('admin.clients.destroy', $client)}}" onsubmit="return confirm('Tem certeza que quer excluir esse cliente?');">
																@csrf
	    														{{ method_field('DELETE') }}
																<button type="submit" class="btn btn-danger">
																	<i class="fa fa-trash"></i>
																</button>
															</form>
														</div>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
				<!-- Row End -->
			</div>
		</div>
	</div>
	<!-- End Main Content-->

@endsection