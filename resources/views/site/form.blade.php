<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Бхакти-лата</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="MgEj1Uue6bV2PEy3JUUkC4tzmvMzvqCrFeuQkukl">

    <link href="{{ asset('/css/public.css?ver=0.3') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('/js/public.js') }}"></script>

</head>

<body class="boxed-layout pb-40 pt-sm-0" data-bg-img="{{ asset('/images/pattern/p5.png') }}">


    <div id="wrapper" class="clearfix">
        <!-- preloader -->

        <!-- Header -->

        <header id="header" class="header">
            <div class="header-top bg-deep xs-text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="widget no-border m-0">

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="widget no-border m-0">
                                <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm text-right">
                                    <li class=" ">
                                      <li style="vertical-align: middle;"><span style="line-height: 30px;">Присоединяйтесь:</span></li>
                                      <li style="vertical-align: middle;"><a target="_blank" href="https://vk.com/bhaktilata"><i class="fa fa-vk"></i></a></li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav">
                <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest" style="z-index: 1000;">
                    <div class="container">
                        <nav id="menuzord" class="menuzord default bg-lightest menuzord-responsive">
                            <a class="menuzord-brand pull-left flip xs-pull-center mt-10" href="/">
                                <img src="/images/logo-wide.png" alt="">
                            </a>
                            <ul class="menuzord-menu">
                                <li class=" ">
                                    <a href="https://bhaktilata.ru" >Сайт отдела</a>
                                </li>
                                <li class=" ">
                                    <a href="https://iskconclub.ru/clubcontact.html" >Связь с нами</a>
                                </li>
                                <li class=" ">
                                    <a href="{{route('user.dashboard')}}" >Личный кабинет</a>
                                </li>
                                @if(!Auth::guard('user_guard')->user())
                                  <li class=" ">
                                      <a href="{{route('user.login')}}" >Войти/Зарегистрироваться</a>
                                  </li>
                                @else
                                  <li class=" ">
                                      <a href="{{route('logout')}}" >Выйти</a>
                                  </li>
                                @endif
                            </ul>
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
                <section data-bg-img="/images/pattern/p50.png" data-margin-top="-119px">
                    <div class="section-title text-center">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <br><br>
                                <h1 class="mt-0">Выбранный Вами формат участия</h1>
                                <div class="title-icon">
                                    <i class="fa fa-heart fa-3x"></i>
                                </div>
                                <h2 class="mt-0">"{{$format->name}}"</h2>
                                <h3>( @if($format->monthly == "Ежемесячно")Ежемесячный @else Разовый @endif платеж: {{$format->summ}} @if(is_numeric ($format->summ))рублей @endif )</h3>

                                <p></p>
                            </div>
                        </div>
                    </div>
                </section>
                <div id="register" class="panel panel-default col-md-12">


                  @if(!Auth::guard('user_guard')->user())
                    <h4 class="widget-title line-bottom">Уже делаете регулярные переводы? <a class="collapsed text-theme-colored" data-parent="#accordion1" data-toggle="collapse" href="#accordion11" aria-expanded="false">Авторизуйтесь!</a></h4>

                    <div id="accordion11" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                        <div class="panel-content">

                          <div class="col-md-12 panel panel-default" style="padding-top: 10px;">
                              <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ url('/user/login')}}" method="POST">
                                  @csrf
                                    <label for="name" class="col-form-label">Ваш email:</label>
                                    <input class="form-control" id="e-mail" type="email" name="email" placeholder="Ваш email" required="required">
                                    <label for="name" class="col-form-label">Ваш пароль:</label>
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Ваш пароль" required>
                                    <input onclick="validation_left()" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Войти" />
                                    <a href="{{ url('/password/reset')}}" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62); padding-top:12px;">Забыл пароль</a>
                              </form>
                          </div>
                        </div>
                    </div>
                  @endif

                  @if  ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach  ($errors->all() as $error){{--Возврат ошибок--}}
                          <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif


                    <div style="clear: both"></div>
                    @if(!Auth::guard('user_guard')->user())
                      <h4 class="widget-title">Ваш первый перевод? Заполните, пожалуйста, форму:</h4>
                    @endif

                  <div class="col-md-12 panel panel-default" style="padding-top: 10px;">
                        <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('form_check')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                            <fieldset>
                                    @if(!is_numeric ($format->summ))
                                      <div class="form-group">
                                          <label for="name" class="col-form-label">Введите желаемую сумму</label>
                                          <div>
                                              <input lang="ru" type="text" id="def_sum" name="summ" required="required"
                                              class="form-control" placeholder="1000" value="{{old('summ')}}" />
                                          </div>
                                      </div>
                                    @else
                                      <input id="cost" name="summ" value="{{$format->summ}}" type="hidden">
                                    @endif

                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Ваше духовное имя. Если его нет - ФИО.</label>
                                        <div>
                                            <input lang="ru" type="text" id="name" name="name" required="required"
                                            class="form-control"
                                            @if(Auth::guard('user_guard')->user())
                                              value="{{ $user->name }}"
                                              disabled />
                                            @else
                                              value="{{old('name')}}" />
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Ваш Email</label>
                                        <div>
                                            <input type="email" id="email" name="email" required="required"
                                            class="form-control"
                                            @if(Auth::guard('user_guard')->user())
                                              value="{{ $user->email }}"
                                              disabled />
                                            @else
                                              value="{{old('email')}}" />
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Ваш телефон*</label>
                                        <div>
                                            <input type="text" id="phone" name="phone" required="required"
                                            class="form-control"
                                            @if(Auth::guard('user_guard')->user())
                                              value="{{ $user->phone }}"
                                              disabled />
                                            @else
                                              value="{{old('phone')}}" />
                                            @endif

                                        </div>
                                    </div>
                                    <p>*Мы обещаем не беспокоить Вас по телефону без крайней необходимости</p>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">От кого вы узнали о клубе:</label>
                                        <div>
                                            <input lang="ru" type="text" id="city" name="city" required="required"
                                            class="form-control"
                                            @if(Auth::guard('user_guard')->user())
                                              value="{{ $user->city }}"
                                              disabled />
                                            @else
                                              value="{{old('city')}}" />
                                            @endif

                                        </div>
                                    </div>

                                  @if ($format->summ > 999)
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label for="is_opened">
                                                <input name="anonim" type="checkbox"> &nbsp; Хочу оставаться анонимным, не указывайте мое имя в открытых списках попечителей.
                                            </label>
                                        </div>
                                    </div>
                                  @endif

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label for="is_opened">
                                                    <input id="pers" name="pers" required="required" type="checkbox"> &nbsp; С условиями <a href="/oferta1.pdf" target="_blank"><font color="green;">оферты и политики</font></a> обработки персональных данных ознакомился и согласен
                                                </label>
                                            </div>
                                        </div>

                                        @if ($format->monthly == "Ежемесячно")
                                          <div class="form-group">
                                              <div class="checkbox">
                                                  <label for="is_opened">
                                                      <input id="podp" name="podp" required="required" type="checkbox"> &nbsp; С условиями подписки ознакомился и согласен
                                                  </label>
                                              </div>
                                          </div>
                                        @endif

                                        </div>
                                      @if ($format->monthly == "Ежемесячно")
                                        <div class="col-md-6">
                                            <label for="name" class="col-form-label">Условия подписки:</label>
                                            <p>Сумма платежа - {{$format->summ}} рублей.</p>
                                            <p>Периодичность списаний - ежемесячно в то число месяца, когда сделан первый платеж.</p>
                                            <p>Отказаться от подписки Вы можете в любое время по Вашему желанию (Уже внесенные платежи не возвращаются).</p>
                                            <p>Чтобы отказаться от подписки Вам необходимо пройти по этой <a href="{{ route('unsubscribe') }}" target="_blank"><font color="green;">этой ссылке</font></a>.</p>
                                        </div>
                                      @endif
                                          <input id="cost" name="format_id" value="{{$format->id}}" type="hidden">
                                          <input id="cost" name="format_name" value="{{$format->name}}" type="hidden">
                                          <input id="cost" name="monthly" value="{{$format->monthly}}" type="hidden">
                                          @if(Auth::guard('user_guard')->user())
                                            <input id="cost" name="autorised" value="autorised" type="hidden">
                                          @endif

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                              <a href="{{ route('home') }}" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)">Назад</a>
                                                <input onclick="validation()" type="submit" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Сохранить" />
                                            </div>
                                       </div>
                            </fieldset>
                        </form>
                        @if(Auth::guard('user_guard')->user())
                          **При необходимости Вы можете изменить Ваши данные в <a href="{{route('user.dashboard')}}">личном кабинете</a>.
                        @endif

                </div>

                <center>
                <h4>
                <strong>Сразу после перевода на вашу почту будет отправлено письмо со ссылкой на группу клуба попечителей. Если письмо со ссылкой не пришло - оно в папке Спам. Если его нет в папке Спам - напишите на info@bhaktilata.ru </strong></h4></center>
          </div>
        </div>
      </section>
    </div>
    <!-- end main-content -->

    <!-- Footer -->
    <footer id="footer" class="footer pb-0 bg-black-111">
        <div class="container pt-70 pb-40">
            <div class="row multi-row-clearfix">
                <div class="col-sm-6 col-md-3" style="text-align:center;">
                    <div class="widget dark"> <img alt="" src="/images/logo-wide2.png">
                        <ul class="styled-icons icon-dark mt-20" style="display:inline-block">
                            <li><a href="https://vk.com/bhaktilata" data-bg-color="#3B5998" style="background: rgb(59, 89, 152) none repeat scroll 0% 0% !important;"><i class="fa fa-vk"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCJqCv7PHvvKTBEYSy9_Rveg?spfreload=10" data-bg-color="#C22E2A" style="background: rgb(194, 46, 42) none repeat scroll 0% 0% !important;"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <br><br>
                    <p style="font-size: 10px; color: #fff;">Соединение с платежным шлюзом и передача информации осуществляется в защищенном режиме с использованием протокола шифрования SSL. В случае если Ваш банк поддерживает технологию
                        безопасного проведения интернет-платежей Verified By Visa или MasterCard SecureCode для проведения платежа также может потребоваться ввод специального пароля.</p>
                    <p style="font-size: 10px; color: #fff;">Настоящий сайт поддерживает 256-битное шифрование. Введенная информация не будет предоставлена третьим лицам за исключением случаев, предусмотренных законодательством РФ. Проведение
                        платежей по банковским картам осуществляется в строгом соответствии с требованиями платежных систем МИР, Visa Int. и MasterCard Europe Sprl.</p>
                    <p style="font-size: 10px; color: #fff;">
                      <a href="https://money.yandex.ru" target="_blank">
                         <img src="https://money.yandex.ru/img/yamoney_button.gif"
                          alt="Я принимаю Яндекс.Деньги" align="left" hspace="5"
                          title="Я принимаю Яндекс.Деньги" border="0" width="88" height="31"/>
                      </a>
                      Принимаем Яндекс.Деньги – доступный и безопасный способ платить за товары и услуги через интернет.
                      Пополнение счета и оплата заказов происходят в реальном времени
                      <a href="http://money.yandex.ru/" target="_blank">на сайте платежной системы</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-nav bg-black-222 p-20">
            <div class="row text-center">
                <div class="col-md-12">
                    <p class="text-white font-11 m-0">© 2017, Бхакти-лата. Все права защищены.</p>
                </div>
            </div>
        </div>
    </footer>

    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="/js/custom.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrapformhelpers/css/bootstrap-formhelpers.min.css">
    <script type="text/javascript" src="bootstrapformhelpers/js/bootstrap-formhelpers.min.js"></script>

    <script type="text/javascript">
        {{--Валидация формы--}}
        var pattern = /^[a-z0-9\._-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
        var pattern_num = /^([0-9])+$/;

        function validation() {
          @if(!is_numeric ($format->summ))
            $("#def_sum").get(0).setCustomValidity('Введите, пожалуйста, желаемую сумму цифрами.');
            if($("#def_sum").val().search(pattern_num) == 0) $("#def_sum").get(0).setCustomValidity('');
         @endif
            $("#name").get(0).setCustomValidity('Введите, пожалуйста, Ваше имя.');
            if ($('#name').val() != '') $("#name").get(0).setCustomValidity('');
            $("#email").get(0).setCustomValidity('Введите, пожалуйста, корректный адрес электронной почты.');
            if ($("#email").val().search(pattern) == 0) $("#email").get(0).setCustomValidity('');
            $("#phone").get(0).setCustomValidity('Введите, пожалуйста, номер телефона (только цифры).');
            if($("#phone").val().search(pattern_num) == 0 && $('#phone').val().length > 4) $("#phone").get(0).setCustomValidity('');
            $("#city").get(0).setCustomValidity('Заполните, пожалуйста, это поле.');
            if ($("#city").val() != '') $("#city").get(0).setCustomValidity('');
            $("#pers").get(0).setCustomValidity('Для продолжения необходимо согласиться с условиями оферты.');
            if ($('#pers').is(':checked')) $("#pers").get(0).setCustomValidity('');
            $("#podp").get(0).setCustomValidity('Для продолжения необходимо согласиться с условиями подписки.');
            if ($('#podp').is(':checked')) $("#podp").get(0).setCustomValidity('');
        }
        $('form').submit(function() {
            if (this.checkValidity()) {
                $('input[type=submit]').prop('disabled', true);
            }
        })
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter46106202 = new Ya.Metrika({
                        id: 46106202,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {}
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/46106202" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</body>

</html>
