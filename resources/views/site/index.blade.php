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
                                    <a href="https://iskconclub.ru" >Сайт отдела</a>
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
                                <h1 class="mt-0">Ваш формат участия</h1>
                                <div class="title-icon">
                                    <i class="fa fa-heart fa-3x"></i>
                                </div>
                                <br><br>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </section>
                <div id="register" class="panel panel-default col-md-12">
                    <p><h3 class="widget-title line-bottom">Добро пожаловать!</h3>
                    </p>
                    <p align="center"><h4>Спасибо вам, что подумываете стать частью нашего клуба. Этот клуб создан специально для тех, для кого слова "образование", "обучение", "наставничество" и "воспитание" - не пустой звук, но он считает их ключевой составляющей нашего социума, и потому хочет сам лучше понять принципы, на которых оно основано, и поддержать наши начинания в данной области.</h4>
                    </p>
                    <br><br>
                    <p><h3 class="widget-title line-bottom">Как это работает?</h3>
                    </p>
                    <div class="row">
                        <div class="panel panel-default col-md-10 col-md-offset-1">
                            <br>
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><strong>1.</strong> Вы выбираете комфортный формат Вашего участия (сумму).</h3>
                                    <br>
                                    <h3><strong>2.</strong> Вводите данные банковской карточки / электронных денег. Включая международные банки.</h3>
                                    <br>
                                    <h3><strong>3.</strong> Выбираете, если хотите, автоплатеж - все Ваши перечисления в будущем будут легко и удобно списываться автоматически!</h3>
                                    <br>
                                    <h3><strong>4.</strong> Отказаться от автоплатежа можно в любое время!</h3>
                                </div>
                                <div class="col-md-3">
                                    <img class="img-fullwidth" src="/images/bank.jpg" alt="...">
</div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <br>
                        <p><h3 class="widget-title line-bottom">Выберите формат своего участия:</h3>
                        </p>
                        <div class="row">



                          @forelse($formats as $format)
                            <div class="thumbnail col-md-2"> <a href="#"><img class="img-fullwidth" src="{{ asset('/storage/'.$format->image) }}" alt="..."></a>
                                <div class="caption text-center">
                                    <h3>{{ $format->name }}</h3>
                                    <p>{{ $format->summ }} @if(is_numeric ($format->summ))руб. @endif @if($format->monthly == "Ежемесячно")/мес. @endif</p>
                                    <p><a href="{{ route('form', ['id' => $format->id]) }}" class="btn btn-theme-colored btn-flat" role="button">Выбрать</a></p>
                                </div>
                                <h5><strong>Бонус:</strong></h5>
                                <ul class="list table-list theme-colored check-circle">
                                    <li>{{ $format->bonus_1 }}</li>
                                    <li>{{ $format->bonus_2 }}</li>
                                </ul>
                            </div>
                          @empty
                            <tr>
                              <td><h2>Опции отсутствуют</h2></td>
                            </tr>
                          @endforelse


                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center">
                                <p>Нажимая кнопку "Выбрать" Вы соглашаетесь с <a class="text-theme-colored" style="cursor: pointer;" href="/oferta1.pdf" target="_blank">публичной офертой.</a></p>
                                <p>Если вы хотите делать взносы большего размера - <a class="text-theme-colored" style="cursor: pointer;" href="skype:makarovta?add">напишите нам!</a></p>
                                <p><a class="btn btn-default btn-theme-colored" style="cursor: pointer;" href="{{ route('unsubscribe') }}" target="_blank">Отписаться от ежемесячного платежа</a>.</p>
                                </ul>
                                <br><br>
</div>
                            </div>
                            <p><h5 class="widget-title line-bottom"><strong>Пояснения к бонусам:</strong></h5>
                            </p>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <h5>(1) - Вы сможете участвовать в группе ВКонтакте, где 1 раз в месяц мы будем организовывать вебинары об образовании в ИСККОН, с ответами на Ваши вопросы;</h5>
                                    <h5>(2) - Вы сможете участвовать в чате в WhatsApp, где Вы сможете обсуждать вебинары и разные образовательные темы с другими участниками.</h5>
                                    <h5>(3) - Мы разместим Ваше имя в списке на странице <a href="https://поддержиотдел.рф" target="_blank">https://поддержиотдел.рф</a> </h5>
                                    <h5>(4) - Во время Вашего нахождения в данном статусе Вы сможете бесплатно участвовать в любом организованном нами онлайн-курсе, если соответствуете требованиям данного курса.</h5>
                                    <h5>(5) - Один раз за год пребывания в данном статусе Вы можете оформить бесплатное обучение на курсах Бхакти-шастр или Бхакти-вайбхавы во Вриндаванском/Маяпурском институтах, Вриндаванской академии или Маяпурской академии Бхактиведанты (без учета дороги, питания и проживания) на себя или кого-то из членов вашей семьи, минимальное время нахождения в данном статусе перед подачей запроса - 6 мес.</h5>
                                </div>
                            </div>
                            <br><br>
                            <p><h5 class="widget-title line-bottom"><strong>Частые вопросы:</strong></h5>
                            </p>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div id="accordion1" class="panel-group accordion transparent">
                                        <div class="panel">
                                            <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion11" aria-expanded="false"> <span class="open-sub"></span>Куда пойдут деньги?</a> </div>
                                            <div id="accordion11" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-content">
                                                    <p>Развитие образовательных начинаний в нашем социуме и поддержание тех, кто активно вовлечен в данную деятельность.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion12" aria-expanded="false"> <span class="open-sub"></span>Какая есть отчетность по финансам?</a>
                                            </div>
                                            <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-content">
                                                    <p>Все данные по доходам предоставляются в налоговую инспекцию России. Информацию по доходам и расходам мы также будем предоставлять представителю Джи-Би-Си, а периодически делать открытые отчеты
                                                        для всех участников нашей программы.</p>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="panel">
                                            <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion14" aria-expanded="false"> <span class="open-sub"></span>Если я оставлю данные карты, Вы не снимете с меня больше положенного?</a>
                                            </div>
                                            <div id="accordion14" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-content">
                                                    <p>Нет. Данные сохраняются в банке, а не у нас, и платеж будет делаться именно той суммы, что Вы указали.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
