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
                                <h2 class="mt-0">Выбор подарков</h2>

                            </div>
                        </div>
                    </div>
                </section>
                <div id="register" class="panel panel-default col-md-12">
                    <p>
                      <h3 class="widget-title line-bottom">Выберите пожалуйста Ваш подарок</h3>
                    </p>

                    <div class="col-md-12">

                        @if  ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach  ($errors->all() as $error){{--Возврат ошибок--}}
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="panel">

                          <div class="panel-content">
                            <table class="table table-striped">
                              <tbody>
                                @foreach  ($gifts as $gift)
                                  <tr>
                                    <td><strong>{{ $gift->name }}</strong><br>{{ $gift->description }}</td>
                                    <th>{{ $gift->summ }} Чайтаний</th>
                                      <td>
                                        <form role="form" name="edit" enctype="multipart/form-data" action="{{route('spend.entrance')}}" method="GET">

                                            <input type="hidden" name="bonus_name" value="{{ $gift->name }}">
                                            <input type="hidden" name="bonus_summ" value="{{ $gift->summ }}">
                                            <input type="submit" class="btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Выбрать" />
                                        </form>
                                      </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
              <br>
              <p>* Доставку из Москвы Почтой России вы оплачиваете самостоятельно.</p>
              <p>** Имеется ввиду только онлайн-курс отдела образования. За участие одного человека в одном модуле без взноса рекомендованного пожертвования.</p>
              <p>*** Участие одного человека на одном курсе из числа: "Курс подготовки учителей 1", "Курс подготовки учителей 2", "Курс подготовки лидеров и менеджеров", "Базовый курс для наставников", "Забота о преданных".</p>
              <p>**** Обучение на выбор во Вриндаванском/Маяпурском институтах, Вриндаванской академии или Маяпурской академии Бхактиведанты<p>


                                        </div>

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

        function validation() {
            $("#email").get(0).setCustomValidity('Введите, пожалуйста, корректный адрес электронной почты.');
            if ($("#email").val().search(pattern) == 0) $("#email").get(0).setCustomValidity('');
            $("#phone").get(0).setCustomValidity('Введите, пожалуйста, номер телефона (только цифры).');
            if($("#phone").val().search(pattern_num) == 0 && $('#phone').val().length > 4) $("#phone").get(0).setCustomValidity('');
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
