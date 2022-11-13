@extends('admin.layouts.app')
 
@section('title', 'Acompanhantes')
 
@section('content')

	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Acompanhantes</h2>
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
												<th>Whatsapp</th>
												<th>Cidade</th>
												<th>Aprovado</th>
												<th>Ativo</th>
												<th>Data de criação</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($clients as $client)
												<tr class="border-bottom">
													<td class="font-weight-bold text-center">
														<a href="{{env('APP_URL')}}/acompanhante/{{$client->slug}}" target="_blank">
															<img src="{{env('APP_URL')}}/{{$client->image}}" class="avatar avatar-sm me-2" alt="" style="margin: auto!important;">
															{{$client->name}}
														</a>
													</td>
													<td><a target="_blank" href="https://api.whatsapp.com/send?phone=55{{preg_replace('/\D/', '', $client->whatsapp)}}">{{$client->whatsapp}}</a></td>
													<td>
														@if ($client->city)
															{{$client->city}} - {{$client->state}}
														@endif
													</td>
													<td>
														@if($client->approved)
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
														{{ date_format(date_create($client->created_at), 'd/m/Y H:i:s') }}
													</td>
													<td>
														<div class="btn-group" role="group">
															@if (!$client->approved)
																<form method="post" action="{{route('admin.clients.approve', $client->id)}}">
																	@csrf
																	@method('PUT')
																	<button type="submit" class="btn btn-success">
																		<i class="fa fa-check"></i>
																	</button>
																</form>
															@endif
															<a href="{{env('APP_URL')}}/{{ $client->document_image }}" target="_blank" class="btn btn-info">
																<i class="fa fa-image"></i>
															</a>
															<form method="post" action="{{route('admin.clients.impersonate', $client->id)}}">
																@csrf
																<button type="submit" class="btn btn-primary">
																	<i class="fa fa-user-secret"></i>
																</button>
															</form>

															<a href="{{route('admin.clients.edit', $client->id)}}" class="btn btn-warning">
																<i class="fa fa-edit"></i>
															</a>

															<form method="post" action="{{route('admin.clients.destroy', $client->id)}}" onsubmit="return confirm('Tem certeza que quer excluir esse cliente?');">
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