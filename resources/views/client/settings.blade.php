@extends('client.layouts.app')

@section('title', 'Configurações')

@section('content')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Configurações</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12 col-md-12">
                        <form action="{{ route('client.settings.update', $client) }}" method="post"
                            enctype="multipart/form-data" novalidate>
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
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Nome</label>
                                                <input type="text" class="form-control" placeholder="Nome" name="name"
                                                    value="{{ old('name', $client->name) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Slug</label>
                                                <input type="text" class="form-control" placeholder="Slug" name="slug"
                                                    value="{{ old('slug', $client->slug) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">E-mail</label>
                                                <input type="email" class="form-control" placeholder="E-mail"
                                                    name="email" value="{{ old('email', $client->email) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Senha</label>
                                                <input type="password" class="form-control" placeholder="Senha"
                                                    name="password">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Whatsapp</label>
                                                <input type="text" class="form-control" placeholder="Whatsapp"
                                                    name="whatsapp" value="{{ old('whatsapp', $client->whatsapp) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Nome da Empresa</label>
                                                <input type="text" class="form-control" placeholder="Nome da Empresa"
                                                    name="company_name"
                                                    value="{{ old('company_name', $client->company_name) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">CNPJ</label>
                                                <input type="text" class="form-control" placeholder="CNPJ" name="cnpj"
                                                    value="{{ old('cnpj', $client->cnpj) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Logo (300x300px)</label>
                                                <input type="file" class="form-control" name="logo" id="logo">
                                                @if ($client->logo)
                                                    <img height="100px" src="{{ env('APP_URL') . $client->logo }}"
                                                        alt="logo">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Foto de Perfil (100x100px)</label>
                                                <input type="file" class="form-control" name="profile" id="profile">
                                                @if ($client->profile)
                                                    <img height="100px" src="{{ env('APP_URL') . $client->profile }}"
                                                        alt="profile">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Favicon (32x32px)</label>
                                                <input type="file" class="form-control" name="favicon" id="favicon">
                                                @if ($client->favicon)
                                                    <img height="100px" src="{{ env('APP_URL') . $client->favicon }}"
                                                        alt="favicon">
                                                @endif
                                            </div>
                                        </div>
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
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">E-mail Público</label>
                                                <input type="email" class="form-control" placeholder="E-mail Público"
                                                    name="attributes[public_email]"
                                                    value="{{ old('attributes.public_email', $client->attributes ? $client->attributes->public_email : null) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Cor Primária</label>
                                                <input type="color" class="form-control" placeholder="Cor Primária"
                                                    name="attributes[primary_color]"
                                                    value="{{ old('attributes.primary_color', $client->attributes ? $client->attributes->primary_color : '#9E8A78') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Cor dos Textos</label>
                                                <input type="color" class="form-control" placeholder="Cor dos Textos"
                                                    name="attributes[text_color]"
                                                    value="{{ old('attributes.text_color', $client->attributes ? $client->attributes->text_color : '#FFFFFF') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Descrição do Rodapé</label>
                                                <textarea name="attributes[description_footer]" id="description_footer" class="form-control" rows="3"
                                                    placeholder="Descrição do Rodapé">{{ old('attributes.description_footer', $client->attributes ? $client->attributes->description_footer : null) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Link do Facebook</label>
                                                <input type="url" pattern="https://.*" class="form-control"
                                                    placeholder="Link do Facebook" name="attributes[link_facebook]"
                                                    value="{{ old('attributes.link_facebook', $client->attributes ? $client->attributes->link_facebook : null) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Link do Instagram</label>
                                                <input type="url" pattern="https://.*" class="form-control"
                                                    placeholder="Link do Instagram" name="attributes[link_instagram]"
                                                    value="{{ old('attributes.link_instagram', $client->attributes ? $client->attributes->link_instagram : null) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label class="tx-medium">Intervalo dos agendamentos (minutos)</label>
                                                <input type="number" class="form-control"
                                                    placeholder="Intervalo dos agendamentos"
                                                    name="attributes[time_interval]"
                                                    value="{{ old('attributes.time_interval', $client->attributes ? $client->attributes->time_interval : '30') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card custom-card">
                        <div class="card-header p-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h3>Horário de Funcionamento</h3>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div style="text-align: right">
                                        <button type="submit" class="btn btn-primary">Salvar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($client->hours && count($client->hours) > 0)
                                @foreach ($client->hours as $i => $clientHour)
                                    <div class="form-group hours">
                                        <div class="row">
                                            <div class="col-12 col-lg-4 mb-2">
                                                <select name="hours[{{ $i }}][day]"
                                                    data-id="{{ $i }}" class="form-control day" required>
                                                    <option value="segunda"
                                                        {{ $clientHour->day === 'segunda' ? 'selected' : false }}>
                                                        segunda</option>
                                                    <option value="terça"
                                                        {{ $clientHour->day === 'terça' ? 'selected' : false }}>
                                                        terça</option>
                                                    <option value="quarta"
                                                        {{ $clientHour->day === 'quarta' ? 'selected' : false }}>
                                                        quarta</option>
                                                    <option value="quinta"
                                                        {{ $clientHour->day === 'quinta' ? 'selected' : false }}>
                                                        quinta</option>
                                                    <option value="sexta"
                                                        {{ $clientHour->day === 'sexta' ? 'selected' : false }}>
                                                        sexta</option>
                                                    <option value="sábado"
                                                        {{ $clientHour->day === 'sábado' ? 'selected' : false }}>
                                                        sábado</option>
                                                    <option value="domingo"
                                                        {{ $clientHour->day === 'domingo' ? 'selected' : false }}>
                                                        domingo</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4 mb-2">
                                                <input type="time" class="form-control open_time"
                                                    placeholder="Horário de Abertura"
                                                    name="hours[{{ $i }}][open_time]"
                                                    data-id="{{ $i }}" value="{{ $clientHour->open_time }}"
                                                    required>
                                            </div>
                                            <div class="col-12 col-lg-4 mb-2">
                                                <input type="time" class="form-control close_time"
                                                    placeholder="Horário de Fechamento"
                                                    name="hours[{{ $i }}][close_time]"
                                                    data-id="{{ $i }}" value="{{ $clientHour->close_time }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[0][day]" data-id="0" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda" selected>segunda</option>
                                                <option value="terça">terça</option>
                                                <option value="quarta">quarta</option>
                                                <option value="quinta">quinta</option>
                                                <option value="sexta">sexta</option>
                                                <option value="sábado">sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[0][open_time]"
                                                data-id="0" value="{{ old('hours.0.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[0][close_time]"
                                                data-id="0" value="{{ old('hours.0.close_time', '18:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[1][day]" data-id="1" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda">segunda</option>
                                                <option value="terça" selected>terça</option>
                                                <option value="quarta">quarta</option>
                                                <option value="quinta">quinta</option>
                                                <option value="sexta">sexta</option>
                                                <option value="sábado">sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[1][open_time]"
                                                data-id="1" value="{{ old('hours.1.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[1][close_time]"
                                                data-id="1" value="{{ old('hours.1.close_time', '18:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[2][day]" data-id="2" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda">segunda</option>
                                                <option value="terça">terça</option>
                                                <option value="quarta" selected>quarta</option>
                                                <option value="quinta">quinta</option>
                                                <option value="sexta">sexta</option>
                                                <option value="sábado">sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[2][open_time]"
                                                data-id="2" value="{{ old('hours.2.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[2][close_time]"
                                                data-id="2" value="{{ old('hours.2.close_time', '18:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[3][day]" data-id="3" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda">segunda</option>
                                                <option value="terça">terça</option>
                                                <option value="quarta">quarta</option>
                                                <option value="quinta" selected>quinta</option>
                                                <option value="sexta">sexta</option>
                                                <option value="sábado">sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[3][open_time]"
                                                data-id="3" value="{{ old('hours.3.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[3][close_time]"
                                                data-id="3" value="{{ old('hours.3.close_time', '18:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[4][day]" data-id="4" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda">segunda</option>
                                                <option value="terça">terça</option>
                                                <option value="quarta">quarta</option>
                                                <option value="quinta">quinta</option>
                                                <option value="sexta" selected>sexta</option>
                                                <option value="sábado">sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[4][open_time]"
                                                data-id="4" value="{{ old('hours.4.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[4][close_time]"
                                                data-id="4" value="{{ old('hours.4.close_time', '18:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hours">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-2">
                                            <select name="hours[5][day]" data-id="5" class="form-control day"
                                                required>
                                                <option value="0">Selecione um dia...</option>
                                                <option value="segunda">segunda</option>
                                                <option value="terça">terça</option>
                                                <option value="quarta">quarta</option>
                                                <option value="quinta">quinta</option>
                                                <option value="sexta">sexta</option>
                                                <option value="sábado" selected>sábado</option>
                                                <option value="domingo">domingo</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control open_time"
                                                placeholder="Horário de Abertura" name="hours[5][open_time]"
                                                data-id="5" value="{{ old('hours.5.open_time', '08:00') }}" required>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-2">
                                            <input type="time" class="form-control close_time"
                                                placeholder="Horário de Fechamento" name="hours[5][close_time]"
                                                data-id="5" value="{{ old('hours.5.close_time', '12:00') }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group hours-buttons">
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger" onclick="removeHours()">Remover</a>
                                    </div>
                                    <div class="col-6 d-flex justify-content-start">
                                        <button type="button" class="btn btn-success" onclick="addHours()">Adicionar</a>
                                    </div>
                                </div>
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
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">CEP</label>
                                        <input type="text" id="cep" class="form-control" placeholder="CEP"
                                            name="address[cep]"
                                            value="{{ old('address.cep', isset($client->address[0]) ? $client->address[0]->cep : null) }}"
                                            maxlength="8" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Endereço</label>
                                        <input type="text" id="address" class="form-control" placeholder="Endereço"
                                            name="address[address]"
                                            value="{{ old('address.address', isset($client->address[0]) ? $client->address[0]->address : null) }}"
                                            maxlength="50" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Número</label>
                                        <input type="text" id="number" class="form-control" placeholder="Número"
                                            name="address[number]"
                                            value="{{ old('address.number', isset($client->address[0]) ? $client->address[0]->number : null) }}"
                                            maxlength="4" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Bairro</label>
                                        <input type="text" id="area" class="form-control" placeholder="Bairro"
                                            name="address[area]"
                                            value="{{ old('address.area', isset($client->address[0]) ? $client->address[0]->area : null) }}"
                                            maxlength="50" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Complemento</label>
                                        <input type="text" id="complement" class="form-control"
                                            placeholder="Complemento" name="address[complement]"
                                            value="{{ old('address.complement', isset($client->address[0]) ? $client->address[0]->complement : null) }}"
                                            maxlength="50">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Estado</label>
                                        <select id="state" name="address[state]" value="" class="form-control"
                                            id="state" required>
                                            <option value="">Selecione um estado...</option>
                                            @foreach ($all_states as $all_state)
                                                <option data-id="{{ $all_state['id'] }}" value="{{ $all_state['uf'] }}"
                                                    {{ $all_state['uf'] === old('address.state', isset($client->address[0]) ? $client->address[0]->state : null) ? 'selected' : false }}>
                                                    {{ $all_state['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="tx-medium">Cidade</label>
                                        <select id="city" name="address[city]" class="form-control" id="city"
                                            required>
                                            @foreach ($all_cities as $all_city)
                                                <option data-id="{{ $all_city['id'] }}" value="{{ $all_city['name'] }}"
                                                    {{ $all_city['name'] === old('address.city', isset($client->address[0]) ? $client->address[0]->city : null) ? 'selected' : false }}>
                                                    {{ $all_city['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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

    <script>
        function removeHours() {
            if ($('.hours').length > 1)
                $('.hours:last').remove();
        }

        function addHours() {
            const lastDay = $('.hours:last');
            const index = parseInt(lastDay.find('.day').attr('data-id')) + 1;
            const clone = lastDay.clone();
            $('.hours-buttons').before(clone);

            $('.hours:last .day').attr('name', `hours[${index}][day]`).attr('data-id', `${index}`);
            $('.hours:last .open_time').attr('name', `hours[${index}][open_time]`).attr('data-id', `${index}`);
            $('.hours:last .close_time').attr('name', `hours[${index}][close_time]`).attr('data-id', `${index}`);
        }

        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                const elements = $(this).find('input[required]');
                let hasErrors = false;
                $('.errors').remove();

                $.each(elements, function(i, el) {
                    if (!$(el).val()) {
                        $(el).parent().append(
                            '<p class="errors text-danger">Esse campo não pode ser nulo</p>')
                        hasErrors = true;
                    }
                });

                if (!hasErrors) {
                    $('form')[0].submit();
                } else {
                    $('html, body').animate({
                        scrollTop: $('.errors:first').offset().top - 150
                    }, 500);
                }
            })
        });
    </script>
@endsection
