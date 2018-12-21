<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Prostofood</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="MgEj1Uue6bV2PEy3JUUkC4tzmvMzvqCrFeuQkukl">

    <link href="{{ asset('/css/public.css?ver=0.3') }}" rel="stylesheet" type="text/css">

    {{--SCC с Тильды--}}
    <link rel="stylesheet" href="https://static.tildacdn.com/css/tilda-grid-3.0.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://tilda.ws/project206353/tilda-blocks-2.12.css?t=1544194322" type="text/css" media="all" />
    <link rel="stylesheet" href="https://static.tildacdn.com/css/tilda-animation-1.0.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://static.tildacdn.com/css/tilda-slds-1.4.min.css" type="text/css" media="all" /><link rel="stylesheet" href="https://static.tildacdn.com/css/tilda-zoom-2.0.min.css" type="text/css" media="all" /><link rel="stylesheet" href="https://static.tildacdn.com/css/tilda-popup-1.1.min.css" type="text/css" media="all" />

    <script src="{{ asset('/js/public.js') }}"></script>
    <script  src = "/js/jquery-cookie/jquery.cookie.js"></script>

</head>

<body class="boxed-layout pb-40 pt-sm-0">


    <div id="wrapper" class="clearfix">
        <!-- preloader -->

        <!-- Header -->


        <header id="header" class="header">
          <div id="nav77550271" class="t199__header t199__js__header t199__is__active" style="" data-menu="yes">
            <div class="t199__holder">
              <a class="t199__logo" href="" style="">
                <div class="t199__logo-text t-title" field="title" style="">
                  PROSTOfood
                </div>
                <div class="t199__logo-text-mobile t-title" field="title" style="">PROSTOfood</div>
              </a>
              <a class="t199__mmenu-toggler t199__js__menu-toggler" href="#">
                <span class="t199__mmenu-toggler-in"></span>
              </a>
              <div class="t199__mmenu t199__js__menu">
                <nav class="t199__menu">
                  <a class="t199__menu-item t-title t-menu__link-item" href="">
                    О школе
                  </a>
                  <a class="t199__menu-item t-title t-menu__link-item" href="">
                    Преимущества
                  </a>
                  <a class="t199__menu-item t-title t-menu__link-item" href="">
                    Выбор курса
                  </a>
                  <a class="t199__menu-item t-title t-menu__link-item" href="">
                    Формат обучения
                  </a>
                  <a class="t199__menu-item t-title t-menu__link-item" href="">
                    Об авторах
                  </a>
                  <a class="t199__menu-item t-title t-menu__link-item" href="{{route('vega.chat')}}" >
                    Чат
                  </a>
                  @if(!Auth::guard('user_guard')->user())
                        <a class="t199__menu-item t-title t-menu__link-item" href="{{route('login')}}" >
                          Войти
                        </a>
                  @else
                        <a class="t199__menu-item t-title t-menu__link-item" href="{{route('logout')}}" >
                          Выйти
                        </a>
                  @endif

                </nav>
              </div>
            </div>
          </div>
        </header>

        <!-- Start main-content -->
        <div class="main-content">
            <section>
                <div class="container">
                    <div class="content"></div>
                </div>

                <h2 class="text-center">{{ $format->name }}</h2>


                @for ($i=1; $i <= $pages; $i++)
                  <div style="margin:20px 30px 10px 30px;z-index: {{ 100-$i }};">
                    <h3>Видео {{ $i }}</h3>
                    <?php $text = "text_".$i; ?>
                    {!! $format->$text !!}
                    <?php $video = "video_".$i; ?>
                    <div>{!! $format->$video !!}</div>
                  </div>
                @endfor

                <div class="checkbox" style="margin:0px 30px 0px 30px; padding-bottom:20px">
                    @if ($end)
                      Вы посмотрели все видео.
                    @else
                      <label for="is_opened">
                          <input id="checkbox" onclick="next_video()" name="anonim" type="checkbox"> &nbsp; Я просмотрел(а) это видео.
                      </label>
                    @endif

                </div>

                </div>
            </section>
        </div>
        <!-- end main-content -->

        <!-- Footer -->
        <footer id="footer" class="footer pb-0 bg-black-111">
            <div class="t-tildalabel " id="tildacopy" data-tilda-sign="206353#4087779">
              <a href="https://tilda.cc/" class="t-tildalabel__link">
                <div class="t-tildalabel__wrapper">
                  <div class="t-tildalabel__txtleft">
                    Made on
                  </div>
                  <div class="t-tildalabel__wrapimg">
                    <img src="https://static.tildacdn.com/img/tildacopy.png" class="t-tildalabel__img">
                  </div>
                  <div class="t-tildalabel__txtright">
                    Tilda
                  </div>
                </div>
              </a>
            </div>
        </footer>


    </div>
    <script src="/js/custom.js"></script>
    <script type="text/javascript">
        {{--Куки + перезагрузка--}}
        $('#checkbox').prop('checked', false);
        function next_video() {
          if(typeof $.cookie('course_{{ $format->id }}') == 'undefined') {var course = 2;}
          else {var course = Number.parseInt($.cookie('course_{{ $format->id }}'))+1;}
          $.cookie('course_{{ $format->id }}',course,{expires:90});
          window.location.reload();
        }
    </script>
</body>

</html>
