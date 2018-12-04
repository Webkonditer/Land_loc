<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Бхакти-лата</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="">

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
                                    <li style="vertical-align: middle;"><span style="line-height: 30px;">Присоединяйтесь:</span></li>
                                    <li style="vertical-align: middle;"><a target="_blank" href="https://vk.com/bhaktilata"><i class="fa fa-vk"></i></a></li>
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
                                <h3 class="mt-0">Пожалуйста войдите или зарегистрируйтесь</h3>
                                <div class="title-icon">
                                    <i class="fa fa-heart fa-3x"></i>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </section>
                <div id="register" class="panel panel-default col-md-12">

                    @if  ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach  ($errors->all() as $error){{--Возврат ошибок--}}
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="col-md-6">{{--Правая колонка--}}
                      <p><h3 class="widget-title line-bottom">Войти:</h3></p>

                      <form role="form" name="edit" enctype="multipart/form-data" action="{{ url('/user/login')}}" method="POST">
                          @csrf

                          <fieldset>

                              <div class="form-group">
                                  <label for="email" class="col-form-label">Ваш Email</label>
                                  <div>
                                      <input type="email" id="e-mail" name="email" required="required"
                                      class="form-control" value="{{old('email')}}" />
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="password" class="col-form-label">Пароль</label>
                                  <input id="password" type="password" class="form-control" name="password" required>
                              </div>

                              <div class="form-group">

                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox" name="remember"> Запомнить меня
                                          </label>
                                      </div>

                              </div>
                              <div class="form-group">

                                <a href="{{ route('home') }}" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)">Назад</a>
                                  <input onclick="validation_left()" type="submit" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Войти" />

                              </div>
                          </fieldset>
                      </form>
                      <a href="{{ url('/password/reset')}}">--Сброс пароля--</a>


                    </div>

                          <div class="col-md-6"> {{--Левая колонка--}}

                            <p><h3 class="widget-title line-bottom">Зарегистрироваться:</h3></p>

                              <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('user.register')}}" method="POST">
                                  @csrf
                                  <fieldset>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Ваше духовное имя. Если его нет - ФИО.</label>
                                        <div>
                                            <input lang="ru" type="text" id="name" name="name" required="required"
                                            class="form-control" value="{{old('name')}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Ваш Email</label>
                                        <div>
                                            <input type="email" id="email" name="email" required="required"
                                            class="form-control" value="{{old('email')}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Ваш пароль</label>
                                        <input id="pass" type="password" class="form-control" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Повторите пароль</label>
                                        <input id="pass_check" type="password" class="form-control" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Ваш телефон*</label>
                                        <div>
                                            <input type="text" id="phone" name="phone" required="required"
                                            class="form-control" value="{{old('phone')}}" />
                                        </div>
                                    </div>
                                    <p>*Мы обещаем не беспокоить Вас по телефону без крайней необходимости</p>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Ваш город</label>
                                        <div>
                                            <input lang="ru" type="text" id="city" name="city" required="required"
                                            class="form-control" value="{{old('city')}}" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                          <a href="{{ route('home') }}" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)">Назад</a>
                                            <input onclick="validation()" type="submit" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Зарегистрироваться" />
                                        </div>
                                   </div>
                            </fieldset>
                        </form>
                      </div>
                </div>
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

        function validation_left() {

            $("#e-mail").get(0).setCustomValidity('Введите, пожалуйста, корректный адрес электронной почты.');
            if ($("#e-mail").val().search(pattern) == 0) $("#e-mail").get(0).setCustomValidity('');
            $("#password").get(0).setCustomValidity('Введите, пожалуйста, Ваш пароль.');
            if ($("#password").val() != '') $("#password").get(0).setCustomValidity('');
        }

        function validation() {
            $("#name").get(0).setCustomValidity('Введите, пожалуйста, Ваше имя.');
            if ($('#name').val() != '') $("#name").get(0).setCustomValidity('');
            $("#email").get(0).setCustomValidity('Введите, пожалуйста, корректный адрес электронной почты.');
            if ($("#email").val().search(pattern) == 0) $("#email").get(0).setCustomValidity('');
            $("#pass").get(0).setCustomValidity('Введите, пожалуйста, пароль (не менее 8 знаков).');
            if($('#pass').val().length > 7) $("#pass").get(0).setCustomValidity('');
            $("#pass_check").get(0).setCustomValidity('Должен совпадать с паролем.');
            if($('#pass_check').val() == $('#pass').val()) $("#pass_check").get(0).setCustomValidity('');
            $("#phone").get(0).setCustomValidity('Введите, пожалуйста, номер телефона (только цифры).');
            if($("#phone").val().search(pattern_num) == 0 && $('#phone').val().length > 4) $("#phone").get(0).setCustomValidity('');
            $("#city").get(0).setCustomValidity('Введите, пожалуйста, Ваш город.');
            if ($("#city").val() != '') $("#city").get(0).setCustomValidity('');

        }
        $('form').submit(function() {
            if (this.checkValidity()) {
                $('input[type=submit]').prop('disabled', true);
            }
        })
    </script>

    <!-- Yandex.Metrika counter -->

    <!-- /Yandex.Metrika counter -->
</body>

</html>
