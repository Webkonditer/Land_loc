<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PROSTOfood</title>

    <!-- CSRF Token -->

    <link href="https://bhaktilata.ru/css/public.css?ver=0.3" rel="stylesheet" type="text/css">

    <script src="https://bhaktilata.ru/js/public.js"></script>

</head>
<body class="">


    <div id="wrapper" class="clearfix">
        <!-- preloader -->

        <!-- Header -->

        <header id="header" class="header">

            <div class="header-nav">
                <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest" style="z-index: 1000;">
                    <div class="container">
                        <nav id="menuzord" class="menuzord default bg-lightest menuzord-responsive">
                            <ul class="menuzord-menu">
    <li class="">
        <a href="" >Приобрести курс</a>
        </li>
        <li class="">
        <a href="" >Выбрать курс</a>
        </li>
        <li class="">
        <a href="" >ВКонтакте</a>
        </li>
        <li class="">
        <a href="" >Instagram</a>
        </li>
                </ul>

                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Start main-content -->
    <section>
<div class="col-md-10 col-md-offset-1">
<h2 align="center">Добро пожаловать на курсы PROSTOfood!</h2>
</div>

<div class="container">
<div class="section-content">
<div class="heading-line-bottom">
<h3 class="heading-title">Выберите ваш курс:</h3>
</div>

<div class="row">
  @forelse($formats  as $format)
<div class="col-xs-12 col-sm-4 col-md-4">
<div class="image-box-thum"><img alt="" src="/storage/{{ $format->image }}" /></div>

<div class="image-box-details text-center p-20 pt-30 pb-30 bg-lighter">
<h3 class="title mt-0">{{ $format->name }}</h3>

<a class="btn btn-colored btn-theme-colored" href="/course/{{ $format->position }}">Начать</a></div>
</div>
  @empty
    <h3>Курсы пока отсутствуют</h3>
  @endforelse

</div>
</div>
</div>


    </section>
        <!-- end main-content -->

        <!-- Footer -->
            <div class="footer-nav bg-black-222 p-20">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p class="text-white font-11 m-0">© PROSTOfood. Все права защищены.</p>
                    </div>
                </div>
            </div>
        </footer>

        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="https://bhaktilata.ru/js/custom.js"></script>

</body>
</html>
