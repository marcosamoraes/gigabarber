$(document).ready(function () {
    $(document).on("change", '[name="state"]', function () {
        let state_id = $('[name="state"] option:selected').data("id");
        $.getJSON("/storage/json/cities.json", function (data) {
            data = data.filter(function (v) {
                return v.estado == state_id;
            });

            $('[name="city"]').html("<option>Selecione uma cidade...</option>");
            let new_content = "";
            $.each(data, function (i, v) {
                new_content +=
                    '<option value="' + v.nome + '">' + v.nome + "</option>";
            });
            $('[name="city"]').html(new_content);
        });
    });

    $(document).on("blur", '[name="cep"]', function () {
        let cep = $(this).val();
        cep.replace(/\D/g, "");

        if (cep.length == 8) {
            $("#global-loader").fadeIn();
            $.get(
                "https://viacep.com.br/ws/" + cep + "/json/",
                function (response) {
                    $('[name="address"]').val(response.logradouro);
                    $('[name="number"]').val();
                    $('[name="area"]').val(response.bairro);
                    $('[name="complement"]').val();
                    $("[name='state']").val(response.uf).trigger("change");

                    setTimeout(function () {
                        $('[name="city"]')
                            .val(response.localidade)
                            .trigger("change");
                    }, 1000);

                    $("#global-loader").fadeOut();
                }
            );
        }
    });

    $('[name="cpf"], #cpf').mask("999.999.999-99");
    $('[name="value"], #value').mask("000.000.000.000.000,00", {
        reverse: true,
    });

    $('[name="whatsapp"], #whatsapp').mask("(00) 00000-0000");
    function updateMask(event) {
        var $element = $(this);
        $(this).off("blur");
        $element.unmask();
        if (this.value.replace(/\D/g, "").length > 10) {
            $element.mask("(00) 00000-0000");
        } else {
            $element.mask("(00) 0000-00009");
        }
        $(this).on("blur", updateMask);
    }
    $('[name="whatsapp"]').on("blur", updateMask);

    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true,
            },
            600: {
                items: 3,
                nav: true,
                loop: true,
            },
            1000: {
                items: 5,
                nav: true,
                loop: true,
            },
        },
    });

    if ($("#datepicker").length > 0) {
        $("#datepicker").datepicker({
            minDate: 0
        });
    }

    $('#datepicker').change(function () {
        let date = $(this).val();
        date = date.split('/');
        date = `${date[2]}-${date[0]}-${date[1]}`
        getAvailableTimes(date);
    });

    function getAvailableTimes(date) {
        const div = $(".appointment-dates");
        const uuid = $('[name="uuid"]').val();
        const user_uuid = $('[name="user_uuid"]').val();
        $.get(`${envUrl}/available-times/${uuid}/${date}?u=${user_uuid}`, function (times) {
            let content = "";
            if (times.length > 0) {
                $.each(times, function (i, time) {
                    let btnClass = '';
                    let btnAction = '';
                    switch (time['reserved']) {
                        case 2:
                            btnAction = 'btn-cancel';
                            btnClass = 'btn-warning';
                            break;
                        case 1:
                            btnClass = 'btn-danger';
                            break;
                        default:
                            btnAction = 'btn-finish';
                            btnClass = 'btn-outline-dark';
                            break;
                    }
                    content += `
                        <div class="col-6 col-md-4 col-lg-2">
                            <input type="button" class="${btnAction} btn ${btnClass} w-100 mb-3" value="${time['time']}">
                        </div>`;
                });
            } else {
                content = `
                <div class="col-12">
                    <div class="alert alert-warning w-100" role="alert">
                        Não há horários disponíveis nessa data.
                    </div>
                </div>`;
            }
            div.html(content);
        });
    }

    $(document).on("click", ".btn-finish", function (e) {
        e.preventDefault();
        const time = $(this).val();
        $('[name="time"]').val(time);
        const data = $("form").serialize();

        $.post($("form").attr("action"), data, function (response) {
            if (response.message) {
                alert(
                    "Agendamento realizado com sucesso!\nVocẽ receberá um e-mail com a confirmação."
                );
                window.location = envUrl + "/" + slug;
            } else {
                alert("Falha ao realizar agendamento.");
            }
        });
    });

    $(document).on("click", ".btn-cancel", function (e) {
        e.preventDefault();
        const time = $(this).val();
        $('[name="time"]').val(time);
        const data = $("form").serialize();
        const user_uuid = $('[name="user_uuid"]').val();

        $.post(`${envUrl}/cancelar/${user_uuid}`, data, function (response) {
            if (response.message) {
                alert(
                    "Agendamento cancelado com sucesso."
                );
                location.reload();
            } else {
                alert("Falha ao cancelar agendamento.");
            }
        });
    });
});
