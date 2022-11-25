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
                            <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12 col-md-12">
                        <form action="{{ route('admin.clients.update', $client) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card custom-card">
                                <div class="card-header p-3">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <h3>Principais Dados</h3>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div style="text-align: right">
                                                <button type="submit" class="btn btn-primary">Salvar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="tx-medium">Nome</label>
                                        <input type="text" class="form-control" placeholder="Nome" name="name"
                                            value="{{ old('name', $client->name) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Slug</label>
                                        <input type="text" class="form-control" placeholder="Slug" name="slug"
                                            value="{{ old('slug', $client->slug) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">E-mail</label>
                                        <input type="email" class="form-control" placeholder="E-mail" name="email"
                                            value="{{ old('email', $client->email) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Senha</label>
                                        <input type="password" class="form-control" placeholder="Senha" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Whatsapp</label>
                                        <input type="text" class="form-control" placeholder="Whatsapp" name="whatsapp"
                                            value="{{ old('whatsapp', $client->whatsapp) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Nome da Empresa</label>
                                        <input type="text" class="form-control" placeholder="Nome da Empresa"
                                            name="company_name" value="{{ old('company_name', $client->company_name) }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">CNPJ</label>
                                        <input type="text" class="form-control" placeholder="CNPJ" name="cnpj"
                                            value="{{ old('cnpj', $client->cnpj) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Logo</label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                        @if ($client->logo)
                                            <img height="100px" src="{{$client->logo}}" alt="logo">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Favicon</label>
                                        <input type="file" class="form-control" name="favicon" id="favicon">
                                        @if ($client->favicon)
                                            <img height="100px" src="{{env('APP_URL') . '/' . $client->favicon}}" alt="favicon">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card custom-card">
                                <div class="card-header p-3">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <h3>Atributos da Página</h3>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div style="text-align: right">
                                                <button type="submit" class="btn btn-primary">Salvar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="tx-medium">Título</label>
                                        <input type="text" class="form-control" placeholder="Título"
                                            name="attributes[title]"
                                            value="{{ old('attributes.title', $client->attributes->title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Descrição</label>
                                        <textarea name="description" id="attributes[description]" placeholder="Descrição" class="form-control"
                                            rows="3">{{ old('attributes.description', $client->attributes->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">E-mail Público</label>
                                        <input type="email" class="form-control" placeholder="E-mail Público"
                                            name="attributes[public_email]"
                                            value="{{ old('attributes.public_email', $client->attributes->public_email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Imagem</label>
                                        <input type="file" class="form-control" name="attributes[image]"
                                            id="image">
                                        @if ($client->attributes->image)
                                            <img height="100px" src="{{env('APP_URL') . '/' . $client->attributes->image}}" alt="image">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Cor Primária</label>
                                        <input type="color" value="#9E8A78" class="form-control"
                                            placeholder="Cor Primária" name="attributes[primary_color]"
                                            value="{{ old('attributes.primary_color', $client->attributes->primary_color) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Cor dos Textos</label>
                                        <input type="color" value="#FFFFFF" class="form-control"
                                            placeholder="Cor dos Textos" name="attributes[text_color]"
                                            value="{{ old('attributes.text_color', $client->attributes->text_color) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Descrição do Rodapé</label>
                                        <textarea name="description_footer" id="attributes[description_footer]" class="form-control" rows="3"
                                            placeholder="Descrição do Rodapé">{{ old('attributes.description_footer', $client->attributes->description_footer) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Link do Facebook</label>
                                        <input type="url" pattern="https://.*" class="form-control"
                                            placeholder="Link do Facebook" name="attributes[link_facebook]"
                                            value="{{ old('attributes.link_facebook', $client->attributes->link_facebook) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Link do Instagram</label>
                                        <input type="url" pattern="https://.*" class="form-control"
                                            placeholder="Link do Instagram" name="attributes[link_instagram]"
                                            value="{{ old('attributes.link_instagram', $client->attributes->link_instagram) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Horário de Funcionamento</label>
                                        <textarea name="opening_hours" id="attributes[opening_hours]" class="form-control" rows="3"
                                            placeholder="Segunda - Sexta 8:00 às 18:00<br>Sábado 8:00 às 12:00">{{ old('attributes.opening_hours', $client->attributes->opening_hours) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card custom-card">
                                <div class="card-header p-3">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <h3>Endereço</h3>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div style="text-align: right">
                                                <button type="submit" class="btn btn-primary">Salvar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="tx-medium">CEP</label>
                                        <input type="text" id="cep" class="form-control" placeholder="CEP"
                                            name="address[cep]"
                                            value="{{ old('address.cep', $client->address[0]->cep) }}" maxlength="8"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Endereço</label>
                                        <input type="text" id="address" class="form-control" placeholder="Endereço"
                                            name="address[address]"
                                            value="{{ old('address.address', $client->address[0]->address) }}"
                                            maxlength="50" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Número</label>
                                        <input type="text" id="number" class="form-control" placeholder="Número"
                                            name="address[number]"
                                            value="{{ old('address.number', $client->address[0]->number) }}"
                                            maxlength="4" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Bairro</label>
                                        <input type="text" id="area" class="form-control" placeholder="Bairro"
                                            name="address[area]"
                                            value="{{ old('address.area', $client->address[0]->area) }}" maxlength="50"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Complemento</label>
                                        <input type="text" id="complement" class="form-control"
                                            placeholder="Complemento" name="address[complement]"
                                            value="{{ old('address.complement', $client->address[0]->complement) }}"
                                            maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Estado</label>
                                        <select id="state" name="address[state]" value=""
                                            class="form-control" id="state" required>
                                            <option value="">Selecione um estado...</option>
                                            @foreach ($all_states as $all_state)
                                                <option data-id="{{ $all_state['id'] }}" value="{{ $all_state['uf'] }}"
                                                    {{ $all_state['uf'] === old('address.state', $client->address[0]->state) ? 'selected' : false }}>
                                                    {{ $all_state['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Cidade</label>
                                        <select id="city" name="address[city]" class="form-control"
                                            id="city" required>
                                            @foreach ($all_cities as $all_city)
                                                <option data-id="{{ $all_city['id'] }}" value="{{ $all_city['name'] }}"
                                                    {{ $all_city['name'] === old('address.city', $client->address[0]->city) ? 'selected' : false }}>
                                                    {{ $all_city['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div style="text-align: right">
                                        <button type="submit" class="btn btn-primary">Salvar</a>
                                    </div>
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
