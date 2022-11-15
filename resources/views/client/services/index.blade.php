@extends('client.layouts.app')
 
@section('title', 'Serviços')
 
@section('content')

	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Serviços</h2>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="{{route('client.services.create')}}" class="btn btn-primary my-2 btn-icon-text">
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
												<th class="text-center">Título</th>
												<th class="text-center">Descrição</th>
												<th class="text-center">Valor</th>
												<th class="text-center">Categoria</th>
												<th>Ativo</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($services as $service)
												<tr class="border-bottom">
													<td class="font-weight-bold text-center">
														{{$service->title}}
													</td>
													<td class="font-weight-bold text-center">
														{{$service->description}}
													</td>
													<td class="font-weight-bold text-center">
														R${{number_format($service->value, 2, ',', '.')}}
													</td>
													<td class="font-weight-bold text-center">
														{{$service->category->name}}
													</td>
													<td>
														@if($service->active)
															<span class="text-success font-weight-semibold">Sim</span>
														@else
															<span class="text-danger font-weight-semibold">Não</span>
														@endif
													</td>
													<td>
														<div class="btn-group" role="group">
															<a href="{{route('client.services.edit', $service)}}" class="btn btn-warning">
																<i class="fa fa-edit"></i>
															</a>

															<form method="post" action="{{route('client.services.destroy', $service)}}" onsubmit="return confirm('Tem certeza que quer excluir esse serviço?');">
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