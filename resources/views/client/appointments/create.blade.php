@extends('client.layouts.app')

@section('title', 'Cadastrar Agendamento')

@section('content')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Cadastrar Agendamento</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('client.appointments.index') }}">Agendamentos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12 col-md-12">
                        <form action="{{ route('client.appointments.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg 4">
                                            <div class="form-group">
                                                <label class="tx-medium">Usuário</label>
                                                <select class="form-control" placeholder="Usuário" name="user_uuid"
                                                    required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user['uuid'] }}">{{ $user['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg 4">
                                            <div class="form-group">
                                                <label class="tx-medium">Data</label>
                                                <input type="date" class="form-control" placeholder="Data" name="date[0]"
                                                    value="{{ old('date.0') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg 4">
                                            <div class="form-group">
                                                <label class="tx-medium">Horário</label>
                                                <select name="date[1]" class="form-control" value="{{ old('date.1') }}"
                                                    required>
                                                    @foreach ($times as $time)
                                                        <option value="{{ $time }}"
                                                            {{ old('date.1') == $time ? 'selected' : false }}>
                                                            {{ $time }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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

    <script>
        const backupDates = $('[name="date[1]"] option').clone();
        let reserveds = [];
        @foreach ($reserveds as $i => $reserved)
            reserveds.push({
                'date': '{{ $reserved['date'] }}',
                'time': '{{ $reserved['time'] }}'
            });
        @endforeach
        console.log(reserveds);

        $('[name="date[0]"]').blur(function() {
            $('[name="date[1]"]').html(backupDates);
            const date = $(this).val();
            reservedDates = reserveds
                .filter((reserved) => reserved.date === date)
                .map((reserved) => reserved.time);

            $.each(reservedDates, function(i, date) {
                $(`[name="date[1]"] option[value="${date}"]`).remove();
            });
        });
    </script>
@endsection
