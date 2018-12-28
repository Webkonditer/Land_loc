<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROSTOfood</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <link href="{{ asset('/css/public.css?ver=0.3') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/js/public.js') }}"></script>
    <script  src = "/js/jquery-cookie/jquery.cookie.js"></script>

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
                              <a href="http://prostofood.online">Приобрести курс</a>
                            </li>
                            <li class="">
                              <a href="{{route('vega.home')}}">Выбрать курс</a>
                            </li>
                            <li class="">
                              <a href="https://vk.com/prostofoodonline">ВКонтакте</a>
                            </li>
                            <li class="">
                              <a href="https://www.instagram.com/prostofood_online/">Instagram</a>
                            </li>
                            @if(!Auth::guard('user_guard')->user())
                              <li class="">
                                  <a class="t199__menu-item t-title t-menu__link-item" href="{{route('login')}}" >
                                    Войти
                                  </a>
                              </li>
                            @else
                              <li class="">
                                  <a class="t199__menu-item t-title t-menu__link-item" href="{{route('logout')}}" >
                                    Выйти
                                  </a>
                              </li>
                            @endif
                        </ul>
                      </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Start main-content -->
    <section>
      <h2 class="text-center">{{ $format->name }}</h2>
      <ul id="myTab" class="nav nav-tabs boot-tabs">
          @for ($i=1; $i <= $pages; $i++)
            <li
              @if ($i == $pages) class="active" @endif
              @if ($i > $pages) class="disabled" @endif
            ><a href="#profile{{$i}}" data-toggle="tab">Видео {{$i}}</a></li>
          @endfor
      </ul>



<div id="myTabContent" class="tab-content">
  @for ($i=1; $i <= $pages; $i++)
  <div class="tab-pane fade @if ($i == $pages) in active @endif " id="profile{{$i}}">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <h3>Видео {{$i}}</h3>
            <?php $video = "video_".$i; ?>
            <div style="max-height:650px;overflow: hidden;">{!! $format->$video !!}</div>
        </div>
    </div>

<br><br>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div id="accordion1" class="panel-group accordion">
  <div class="panel">
    <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion11" class="" aria-expanded="true"> <span class="open-sub"></span> Рецепт данного блюда</a> </div>
    <div id="accordion11" class="panel-collapse collapse" role="tablist" aria-expanded="true">
      <div class="panel-content">
        <pre>Рецепт первого блюда:
        1. Покупаем
        2. Готовим.
        </pre>
      </div>
    </div>
  </div>
  <div class="panel">
    <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion12" aria-expanded="false"> <span class="open-sub"></span>Советы по приготовлению</a> </div>
    <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
      <div class="panel-content">
        <pre>Надо прелдожить Кришне!
        Не забудьте.</pre>
      </div>
    </div>
  </div>
</div>
</div>
</div>

    @if ($i == $pages)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form>
                    <div class="form-group text-center">
                        <div class="checkbox">
                          @if ($end)
                            Вы посмотрели все видео.
                          @else
                            <label for="is_opened">
                                <input id="checkbox" onclick="next_video()" name="anonim" type="checkbox">
                                &nbsp; <strong>Я просмотрел(-а) видео и попробовал(-а) сделать по нему блюдо.</strong>
                            </label>
                          @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h3>Ваши обратная связь и вопросы:</h3>
        <textarea class="form-control"></textarea>
        </div>
    </div>
    <br>

  </div>
@endfor






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
    <script src="/js/custom.js"></script>
    <script type="text/javascript">
        {{--$(".fluid-width-video-wrapper").css({padding-top:60%});--}}
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
