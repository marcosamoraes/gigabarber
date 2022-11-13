<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $client->description }}" />
    <meta name="author" content="DynamicLayers" />

    <title>{{ $client->company_name . ' | ' . env('APP_NAME') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $client->favicon }}" />

    <!-- Elegant Font Icons CSS -->
    <link rel="stylesheet" href="assets/css/elegant-font-icons.css" />
    <!-- Elegant Line Icons CSS -->
    <link rel="stylesheet" href="assets/css/elegant-line-icons.css" />
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="assets/css/themify-icons.css" />
    <!-- Barber Icons CSS -->
    <link rel="stylesheet" href="assets/css/barber-icons.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css" />
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="assets/css/venobox/venobox.css" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets/css/nice-select.css" />
    <!-- OWL-Carousel CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" />
    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="assets/css/slicknav.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!-- Multiple Select CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/themes/bootstrap.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app.css" />

    <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <style>
        :root {
            --client-primary-color: {{$client->attributes->primary_color}};
            --client-text-color: {{$client->attributes->text_color}};
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <img src="assets/img/loading.gif" width="80" alt="" />
        </div>
    </div>

    <header id="header" class="header-section">
        <div class="container">
            <nav class="navbar">
                <a href="#" class="navbar-brand">
                    @if ($client->logo)
                        <img src="{{ $client->logo }}" alt="{{ $client->company_name }}" />
                    @else
                        {{ $client->company_name }}
                    @endif
                </a>
                <div class="d-flex menu-wrap align-items-center">
                    <div id="mainmenu" class="mainmenu">
                        <ul class="nav d-lg-flex align-items-center">
                            <li>
                                <a data-scroll class="nav-link active" href="#about">Home<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li>
                                <a href="#services">Serviços</a>
                            </li>
                            <li>
                                <a href="#portfolio">Portfólio</a>
                            </li>
                            <li>
                                <a href="#contact">Contato</a>
                            </li>
                            <li>
                                <div class="header-btn">
                                    <a href="#appointment" class="menu-btn">Realizar Agendamento</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section id="about" class="about_section bd-bottom padding">
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
                        <div class="book_content">
                            <h2>Faça um agendamento</h2>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="name" class="form-control" placeholder="Nome" required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <input type="email" name="email" class="form-control" placeholder="E-mail"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="whatsapp" class="form-control" placeholder="Whatsapp"
                                    required />
                            </div>
                            <div class="col-md-6 padding-10">
                                <select class="form-control" placeholder="Serviços" name="services"
                                    data-select-all="false" multiple>
                                    <option>Hair Styling</option>
                                    <option>Shaving</option>
                                    <option>Face Mask</option>
                                    <option>Hair Wash</option>
                                    <option>Beard Triming</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 padding-10">
                                <input type="text" name="cpf" class="form-control" placeholder="CPF"
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
    </section>

    <section id="services" class="pricing_section bg-grey bd-bottom padding">
        <div class="container">
            <div class="section_heading text-center mb-40 wow fadeInUp" data-wow-delay="300ms">
                <h2>Nossos Serviços</h2>
                <div class="heading-line"></div>
            </div>
            <div class="row">
                @foreach ($client->categories as $category)
                    <div class="col-12 col-md-6 col-lg sm-padding">
                        <div class="price_wrap">
                            <h3>{{ $category->name }}</h3>
                            <ul class="price_list">
                                @foreach ($category->services as $service)
                                    <li>
                                        <h4>{{ $service->name }}</h4>
                                        <p class="description">
                                            {{ $service->description }}
                                        </p>
                                        <span
                                            class="price">R${{ number_format($service->value, 2, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="widget_section padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 sm-padding">
                    <div class="footer_widget">
                        @if ($client->logo)
                            <img class="mb-15" src="{{ $client->logo }}" alt="{{ $client->company_name }}" />
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
                                {{ $client->whatsapp }}
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
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Jquery Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!-- Imagesloaded JS -->
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <!-- OWL-Carousel JS -->
    <script src="assets/js/vendor/owl.carousel.min.js"></script>
    <!-- isotope JS -->
    <script src="assets/js/vendor/jquery.isotope.v3.0.2.js"></script>
    <!-- Smooth Scroll JS -->
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <!-- venobox JS -->
    <script src="assets/js/vendor/venobox.min.js"></script>
    <!-- ajaxchimp JS -->
    <script src="assets/js/vendor/jquery.ajaxchimp.min.js"></script>
    <!--Slicknav-->
    <script src="assets/js/vendor/jquery.slicknav.min.js"></script>
    <!--Nice Select-->
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <!-- Wow JS -->
    <script src="assets/js/vendor/wow.min.js"></script>
    <!-- Contact JS -->
    <script src="assets/js/contact.js"></script>
    <!-- Appointment JS -->
    <script src="assets/js/appointment.js"></script>
    <!-- Multiple Select JS -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- App JS -->
    <script src="assets/js/app.js"></script>
</body>

</html>
