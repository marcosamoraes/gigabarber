@extends('client.layouts.app')

@section('title', 'Calendário')

@section('content')

    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Calendário</h2>
                    </div>
                </div>
                <!-- End Page Header -->

                <div class="row">
                    <div class="col-12 col-md-5 col-xl-4">
                        <div class="form-group">
                            <div id="datepicker"></div>
                            <input type="hidden" name="date">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-xl-8">
                        <div class="card custom-card transcation-crypto">
                            <div class="card-body appointment-dates row" style="padding: 5px">
                                <div class="col-12">
                                    <div class="alert alert-warning alert-block w-100" role="alert">
                                        Selecione uma data para verificar os agendamentos
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content-->

    <!-- JQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <style>
        #datepicker {
            width: 300px;
            margin-left: -15px;
        }

        .ui-datepicker .ui-datepicker-header .ui-datepicker-next:before,
        .ui-datepicker .ui-datepicker-header .ui-datepicker-prev:before {
            display: none;
        }

        .ui-datepicker .ui-datepicker-header .ui-datepicker-next,
        .ui-datepicker .ui-datepicker-header .ui-datepicker-prev {
            top: 2px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                minDate: 0
            });

            $('#datepicker').change(function() {
                let date = $(this).val();
                date = date.split('/');
                date = `${date[2]}-${date[0]}-${date[1]}`
                getAvailableTimes(date);
            });
        });

        function getAvailableTimes(date) {
            const div = $(".appointment-dates");
            $.get(`{{ env('APP_URL') }}/client/calendar-times/${date}`, function(times) {
                let content = "";
                if (times.length > 0) {
                    $.each(times, function(i, time) {
                        let btnClass = time['user'] ? 'btn-success' : 'btn-light';

                        content += `
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="${time['link'] ? `https://wa.me/${time['link']}` : '#'}" target="_blank"
                              class="btn ${btnClass} w-100 mb-3 p-0 d-flex align-items-center flex-wrap justify-content-center"
                              style="height:55px">
                              <p class="mb-0 w-100">${time['time']}</p>
                              ${time['user'] ? `<small class="w-100">${time['user']}</small>` : ''}
                              ${time['whatsapp'] ?
                                `<small class="w-100">
                                  <i class="fab fa-whatsapp mr-2"></i>
                                  <span>${time['whatsapp']}</span>
                                </small>`
                              : ''}
                            </a>
                        </div>`;
                    });
                } else {
                    content = `
                      <div class="col-12">
                          <div class="alert alert-warning alert-block w-100" role="alert">
                              Não há horários disponíveis nessa data.
                          </div>
                      </div>`;
                }
                div.html(content);
            });
        }
    </script>
@endsection
