@extends('client.layouts.app')

@section('title', 'Agendamentos')

@section('content')

	<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">

				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Agendamentos</h2>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							<a href="{{route('client.appointments.create')}}" class="btn btn-primary my-2 btn-icon-text">
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
												<th class="text-center">Email</th>
												<th class="text-center">Whatsapp</th>
												<th class="text-center">Serviços</th>
												<th class="text-center">CPF</th>
												<th>Data do Agendamento</th>
												<th>Data de criação</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($appointments as $appointment)
												<tr class="border-bottom">
													<td class="font-weight-bold text-center">
														{{$appointment->user->name}}
													</td>
													<td class="font-weight-bold text-center">
														<a href="mailto:{{$appointment->user->email}}">
															{{$appointment->user->email}}
														</a>
													</td>
													<td class="font-weight-bold text-center">
														<a href="https://wa.me/{{preg_replace('/[^0-9]/', '', $appointment->user->whatsapp)}}" target="_blank">
															{{$appointment->user->whatsapp}}
														</a>
													</td>
													<td>
														@php
															$services = json_decode($appointment->services);
															$services = is_array($services) ? implode(',', $services) : $services;
														@endphp
														<span class="font-weight-semibold">{{$services}}</span>
													</td>
													<td class="font-weight-bold text-center">
														{{$appointment->user->cpf}}
													</td>
													<td>
														{{ formatDate($appointment->date) }}
													</td>
													<td>
														{{ formatDate($appointment->created_at) }}
													</td>
													<td>
														<div class="btn-group" role="group">
															<form method="post" action="{{route('client.appointments.destroy', $appointment)}}" onsubmit="return confirm('Tem certeza que quer excluir esse agendamento?');">
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