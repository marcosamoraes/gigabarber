@extends('client.layouts.app')

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
                            <a href="{{ route('client.users.create') }}" class="btn btn-primary my-2 btn-icon-text">
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
                                                <th class="text-center">Whatsapp</th>
                                                <th class="text-center">Ativo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="border-bottom">
                                                    <td class="font-weight-bold text-center">
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        <b>
                                                            <a target="_blank"
                                                                href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/\D/', '', $user->whatsapp) }}">{{ $user->whatsapp }}</a>
                                                        </b>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($user->active)
                                                            <p class="text-success">Sim</p>
                                                        @else
                                                            <p class="text-danger">N??o</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            @if (!$user->active)
                                                                <a href="{{ route('client.users.active', $user) }}"
                                                                    class="btn btn-success">
                                                                    <i class="fa fa-check"></i>
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('client.users.edit', $user) }}"
                                                                class="btn btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <form method="post"
                                                                action="{{ route('client.users.destroy', $user) }}"
                                                                onsubmit="return confirm('Tem certeza que quer excluir esse usu??rio?');">
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
