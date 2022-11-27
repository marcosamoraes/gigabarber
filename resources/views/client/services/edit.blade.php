@extends('client.layouts.app')

@section('title', 'Editar Serviço')

@section('content')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Editar Serviço</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('client.services.index') }}">Serviços</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12 col-md-12">
                        <form action="{{ route('client.services.update', $service) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Título</label>
                                                <input type="text" class="form-control" placeholder="Título"
                                                    value="{{ old('title', $service->title) }}" name="title" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Descrição</label>
                                                <input type="text" class="form-control" placeholder="Descrição"
                                                    value="{{ old('description', $service->description) }}"
                                                    name="description">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Valor</label>
                                                <input type="text" class="form-control" placeholder="Valor"
                                                    value="{{ old('value', $service->value) }}" name="value">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Categoria</label>
                                                <select class="form-control" name="category_uuid" id="category_uuid"
                                                    required>
                                                    <option value="">Selecione uma categoria...</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->uuid }}"
                                                            {{ $service->category_uuid === $category->uuid ? 'selected' : false }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Status</label>
                                                <select class="form-control select2" name="active">
                                                    <option value="1" {{ $service->active ? 'selected' : false }}>Ativo
                                                    </option>
                                                    <option value="0" {{ !$service->active ? 'selected' : false }}>
                                                        Inativo
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
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
