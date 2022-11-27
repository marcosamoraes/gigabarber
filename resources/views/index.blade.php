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
            {{$error}}
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

    @if (session('success'))
		<div class="alert alert-success mg-b-0" role="alert" style="z-index: 999999;">
			{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
		</div>

        <script>
            setTimeout(() => {
                $(".alert").alert('close')
            }, 3000);
        </script>
	@endif

    <header id="header" class="header-section">
        <div class="container">
            <nav class="navbar">
                <a href="{{env('APP_URL')}}" class="navbar-brand">
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
                        <form action="{{ route('appointment', $client->slug) }}">
                            <ul class="nav d-lg-flex align-items-center">
                                <li>
                                    <input type="text" name="whatsapp" class="form-control"
                                        placeholder="Digite seu Whatsapp" style="height: 45px">
                                </li>
                                <li>
                                    <div class="header-btn">
                                        <button type="submit" class="menu-btn">Realizar Agendamento</button>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    {{-- <section id="about" class="about_section bd-bottom padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about_content align-center">
                        <h2 class="wow fadeInUp" data-wow-delay="200ms">
                            {{ $client->attributes->title }}
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="600ms">
                            {{ $client->attributes->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="appointment" class="book_section padding">
        <div class="book_bg" style="background-image: url({{ $client->attributes->image }})"></div>
        <div class="map_pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-6">
                    <form action="{{ route('make.appointment', ['uuid' => $client->uuid]) }}" method="post"
                        id="appointment_form" class="form-horizontal appointment_form">
                        @csrf
                        <div class="book_content">
                            <h2>Faça um agendamento</h2>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="user[name]" class="form-control" placeholder="Nome" required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <input type="email" name="user[email]" class="form-control" placeholder="E-mail"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="user[whatsapp]" id="whatsapp" class="form-control" placeholder="Whatsapp"
                                    required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <select class="form-control" placeholder="Serviços" name="services[]"
                                    data-select-all="false" multiple>
                                    @foreach ($client->services as $service)
                                        <option>{{$service->category->name . ' - ' . $service->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="user[cpf]" class="form-control" id="cpf" placeholder="CPF"
                                    required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <input type="datetime-local" name="date" class="form-control" placeholder="Data"
                                    required />
                            </div>
                        </div>
                        <button id="app_submit" class="default_btn" type="submit">
                            Agendar
                        </button>
                        <div id="msg-status" class="alert" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="services" class="pricing_section bg-grey bd-bottom padding">
        <div class="container">
            <div class="section_heading text-center mb-40 wow fadeInUp" data-wow-delay="300ms">
                <h2>Nossos Serviços</h2>
            </div>
            <div class="row">
                @foreach ($client->categories as $category)
                    @if ($category->services->count() > 0 && $category->active)
                        <div class="col-12 col-md-6 col-lg-4 sm-padding">
                            <div class="price_wrap">
                                <h3>{{ $category->name }}</h3>
                                <ul class="price_list">
                                    @foreach ($category->services as $service)
                                        @if ($service->active)
                                            <li>
                                                <h4>{{ $service->title }}</h4>
                                                <p class="description">
                                                    {{ $service->description }}
                                                </p>
                                                <span
                                                    class="price" style="background: #fcf9f5;">R${{ number_format($service->value, 2, ',', '.') }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @if (count($client->images) > 0)
        <section id="portfolio" class="pricing_section bg-grey bd-bottom padding">
            <div class="container">
                <div class="section_heading text-center mb-40 wow fadeInUp" data-wow-delay="300ms">
                    <h2>Imagens</h2>
                </div>
                <div class="row">
                    <div class="col-12 sm-padding">
                        <div class="owl-carousel">
                            @foreach ($client->images as $image)
                                <div>
                                    <a href="{{ env('APP_URL').$image->name }}" target="_blank">
                                        <img src="{{ env('APP_URL').$image->name }}" alt="{{ $client->company_name }}"
                                            class="w-100">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- @if (count($client->address) > 0)
        <section id="map" class="pricing_section bg-grey bd-bottom">
            <div class="container-fluid px-0">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="300" id="gmap_canvas"
                            src="https://maps.google.com/maps?q={{ $client->fullAddress() }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 300px;
                                width: 100%;
                            }

                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 300px;
                                width: 100%;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    <section class="widget_section padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 sm-padding">
                    <div class="footer_widget">
                        @if ($client->logo)
                            <img class="mb-15" height="100" src="{{ env('APP_URL') . $client->logo }}" alt="{{ $client->company_name }}" />
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
    <script src="{{ env('APP_URL') }}/assets/js/vendor/jquery-1.12.4.min.js"></script>
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
    <script src="{{ env('APP_URL') }}/assets/js/app.js"></script>
</body>

</html>
