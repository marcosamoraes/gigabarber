<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $client->description }}" />
    <meta name="author" content="DynamicLayers" />

    <title>{{ $client->company_name . ' | ' . env('APP_NAME') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ env('APP_URL') . $client->favicon }}" />

    <!-- Elegant Font Icons CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/elegant-font-icons.css" />
    <!-- Elegant Line Icons CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/elegant-line-icons.css" />
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/themify-icons.css" />
    <!-- Barber Icons CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/barber-icons.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/animate.min.css" />
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/venobox/venobox.css" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/nice-select.css" />
    <!-- OWL-Carousel CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/owl.carousel.css" />
    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/slicknav.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/main.css?v=1.0.1" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/responsive.css" />
    <!-- Multiple Select CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/themes/bootstrap.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/owl.carousel.min.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/app.css" />
    <!-- JQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="{{ env('APP_URL') }}/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <script>
        envUrl = "{{ explode('/public', env('APP_URL'))[0] }}";
        slug = "{{ $client->slug }}";
    </script>

    <style>
        :root {
            --client-primary-color: {{ $client->attributes->primary_color }};
            --client-text-color: {{ $client->attributes->text_color }};
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <i class="fa fa-spinner fa-spin fa-4x" aria-hidden="true"></i>
        </div>
    </div>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="z-index: 999999">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <script>
            setTimeout(() => {
                $(".alert").alert('close')
            }, 3000);
        </script>
    @endforeach

    <header id="header" class="header-section">
        <div class="container">
            <nav class="navbar">
                <a href="{{env('APP_URL').$client->slug}}" class="navbar-brand">
                    @if ($client->logo)
                        <img src="{{ env('APP_URL') . $client->logo }}" alt="{{ $client->company_name }}" />
                    @else
                        {{ $client->company_name }}
                    @endif
                </a>
                <style>
                    .slicknav_nav {
                        background-color: #222227;
                        height: 150px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-wrap: wrap;
                    }

                    .slicknav_nav .header-btn {
                        margin-right: 0;
                    }

                    .header-btn button {
                        cursor: pointer;
                    }
                </style>
                <div class="d-flex menu-wrap align-items-center">
                    <div id="mainmenu" class="mainmenu">
                        <ul class="nav d-lg-flex align-items-center">
                            <li class="text-light">
                                Olá, <b>{{ $user->name }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <style>
        .ms-parent.form-control {
            height: 60px;
        }
    </style>

    <section id="about" class="about_section bd-bottom padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about_content align-center">
                        <h2 class="wow fadeInUp" data-wow-delay="200ms">
                            Realizar Agendamento
                        </h2>
                    </div>
                    <form action="{{ route('make.appointment', $user->uuid) }}" method="post" id="appointment_form">
                        @csrf
                        <input type="hidden" name="uuid" value="{{ $client->uuid }}">
                        <input type="hidden" name="user_uuid" value="{{$user->uuid}}">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="form-control" placeholder="Serviços" name="services[]"
                                                data-select-all="false" required>
                                                <option value="0">Selecione um serviço...</option>
                                                @foreach ($client->services as $service)
                                                    <option>{{ $service->category->name . ' - ' . $service->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div id="datepicker"></div>
                                            <input type="hidden" name="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <input type="hidden" name="time">
                                <div class="row appointment-dates">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="widget_section padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 sm-padding">
                    <div class="footer_widget">
                        @if ($client->logo)
                            <img class="mb-15" height="100" src="{{ env('APP_URL') . $client->logo }}"
                                alt="{{ $client->company_name }}" />
                        @else
                            <p>{{ $client->company_name }}</p>
                        @endif
                        <p>
                            {{ $client->attributes->description_footer }}
                        </p>
                        <ul class="widget_social">
                            @if ($client->attributes->link_facebook)
                                <li>
                                    <a href="{{ $client->attributes->link_facebook }}" target="_blank"><i
                                            class="social_facebook"></i></a>
                                </li>
                            @endif
                            @if ($client->attributes->link_instagram)
                                <li>
                                    <a href="{{ $client->attributes->link_instagram }}" target="_blank"><i
                                            class="social_instagram"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 sm-padding">
                    <div class="footer_widget">
                        <h3>Endereço</h3>
                        <p>
                            <a target="_blank"
                                href="https://www.google.com.br/maps/place/{{ str_replace(' ', '+', $client->fullAddress()) }}">
                                {{ $client->fullAddress() }}
                            </a>
                        </p>
                        <p>
                            <a href="mailto:{{ $client->attributes->public_email }}">
                                {{ $client->attributes->public_email }}
                            </a>
                        </p>
                        <p>
                            <a href="http://wa.me/{{ preg_replace('/[^0-9]/', '', $client->whatsapp) }}?text=Olá,%20vim%20pelo%20seu%20site.%20Poderia%20me%20passar%20mais%20informações?"
                                target="_blank">
                                <i class="fa fa-whatsapp"></i> {{ $client->whatsapp }}
                            </a>
                        </p>
                    </div>
                </div>
                @if ($client->attributes->opening_hours)
                    <div class="col-lg-3 col-md-6 sm-padding">
                        <div class="footer_widget">
                            <h3>Horário de Funcionamento</h3>
                            <p class="opening_time">
                                {!! $client->attributes->opening_hours !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 xs-padding">
                    <div class="copyright">
                        &copy;
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script>
                        Desenvolvido com <i class="icon_heart text-danger mx-1"></i> por <a href="#"
                            class="text-light"><strong>GigaBarber</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a data-scroll href="#header" id="scroll-to-top"><i class="arrow_up"></i></a>

    <!-- jQuery Lib -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- Jquery Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/bootstrap.min.js"></script>
    <!-- Imagesloaded JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <!-- OWL-Carousel JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/owl.carousel.min.js"></script>
    <!-- isotope JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/jquery.isotope.v3.0.2.js"></script>
    <!-- Smooth Scroll JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/smooth-scroll.min.js"></script>
    <!-- venobox JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/venobox.min.js"></script>
    <!-- ajaxchimp JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/jquery.ajaxchimp.min.js"></script>
    <!--Slicknav-->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/jquery.slicknav.min.js"></script>
    <!--Nice Select-->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/jquery.nice-select.min.js"></script>
    <!-- Wow JS -->
    <script src="{{ env('APP_URL') }}/assets/js/vendor/wow.min.js"></script>
    <!-- Contact JS -->
    <script src="{{ env('APP_URL') }}/assets/js/contact.js"></script>
    <!-- Appointment JS -->
    <script src="{{ env('APP_URL') }}/assets/js/appointment.js"></script>
    <!-- Multiple Select JS -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <!-- Owl Carousel CSS -->
    <script src="{{ env('APP_URL') }}/assets/js/owl.carousel.min.js"></script>
    <!-- Main JS -->
    <script src="{{ env('APP_URL') }}/assets/js/main.js"></script>

    <!-- App JS -->
    <script src="{{ env('APP_URL') }}/assets/js/app.js?v={{time()}}"></script>
</body>

</html>
