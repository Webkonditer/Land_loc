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
                                    <h3><strong>3.</strong> Благодаря опции автоплатежа все Ваши перечисления в будущем будут легко и удобно списываться автоматически!</h3>
                                    <br>
                                    <h3><strong>4.</strong> Отказаться от автоплатежа можно в любое время!</h3>
                                    <br>
                                    <h3><strong>5.</strong> Ваши банковские данные находятся в абсолютной сохранности!</h3>
                                    <p><i>Данные сохраняются в банке, а не у нас. Никто не будет иметь доступа к вашим банковским данным, никто не сможет их украсть и т.д. Раз в месяц будет подаваться автоматический запрос на снятие именно той суммы, которую вы выбрали. И, если у вас подключен мобильный банк, вам будут приходить SMS с просьбой подтвердить перевод. А на почту приходить чек о переводе.</i></p>


                                </div>
                                <div class="col-md-3">
                                    <img class="img-fullwidth" src="/images/bank.jpg" alt="...">
</div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <br>

                    <p><h3 class="widget-title line-bottom">Наша скромная благодарность вам.</h3>
                    </p>
                    <div class="row">
                        <div class="panel panel-default col-md-10 col-md-offset-1">
                            <br>
                            <div class="row">
                                <h4 align="center"><strong>Вы поддерживаете наше служение в образовании, и нам также хочется отблагодарить вас:</strong></h4>
                                <br>
                                <h4>1. Участием в обсуждениях и вебинарах ВКонтакте</h4>
                                <p>Каждый регулярный попечитель клуба получает доступ к закрытой группе ВКонтакте только для членов клуба, в которой вы сможете получать свежие новости и отчеты по нашей деятельности, участвовать в обсуждениях, делиться своими идеями, а также участвовать в закрытых вебинарах об образовании;</p>
                                <br>
                                <h4>2. Накопительными бонусами - "Чайтаньями"</h4>
                                <p>Вы получаете бонусы - "Чайтаньи", которые можно обменять на такие подарки как комплект книг "Шримад Бхагаватам" или бесплатное обучение в Маяпуре/Вриндаване.
            <div class="row">
			<div class="col-md-10 col-md-offset-1">
			<div id="accordion1" class="panel-group accordion transparent">
                                        <div class="panel">
                                            <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion11" aria-expanded="false"> <span class="open-sub">Шрила Прабхупада о валюте для ИСККОН - "Чайтаньях":</span></a> </div>
                                            <div id="accordion11" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-content">
                                                    <blockquote class="bg-theme-colored">
                <p>Однажды утром он говорил с нами о будущем ИСККОН. Он сказал, что хочет выкупить землю в Маяуре и создать независимую общину. Когда это произойдет - он бы объявил независимость от Индии и создал бы отдельную страну - "Маяпур". Тогда его храмы повсюду в мире были бы посольствами "Маяпура", а президенты храмов - послами. У нас бы была собственная валюта. <b>Он называл их "Чайтаньи". Был бы один Чайтанья, пять Чайтаний, десять Чайтаний.</b> А для экспорта, мы бы производили предметы для преданного служения и распространяли их по всему миру.</p>
                <footer>Из воспоминаний о Шриле Прабхупаде - том 1, глава 13</footer>
              </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-title"> <a class="collapsed" data-parent="#accordion1" data-toggle="collapse" href="#accordion12" aria-expanded="false"> <span class="open-sub">На какие подарки можно обменять "Чайтаньи":</span></a>
                                            </div>
                                            <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-content">
                                                <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>Базовый комплект книг *</strong><br>Бхагавад-гита, Нектар преданности, Нектар наставлений, Ишопанишад, Наука самосознания, Прабхупада, Кришна, Учение Шри Чайтаньи.</td>
                            <th>60 Чайтаний</th>
                          </tr>
                          <tr>
                            <td><strong>Бхакти-шастры онлайн (1 модуль) **</strong></td>
                            <th>60 Чайтаний</th>
                          </tr>
                          <tr>
                            <td><strong>Подарочный комплект книг 1 *</strong><br>Прабхупада Лиламрита, Кришна - Верховная Личность Бога (Делюкс).</td>
                            <th>120 Чайтаний</th>
                          </tr>
                          <tr>
                            <td><strong>Подарочный комплект книг 2 *</strong><br>Кришна АРТ, Кулинарная книга от Ямуны д.д.</td>
                            <th>120 Чайтаний</th>
                          </tr>
                          <tr>
                            <td><strong>Шримад Бхагаватам, песни 1-4 *</strong></td>
                            <th>120 Чайтаний</th>
                          </tr>
<tr>
                            <td><strong>Шримад Бхагаватам, песни 5-8 *</strong></td>
                            <th>100 Чайтаний</th>
                          </tr>
<tr>
                            <td><strong>Шримад Бхагаватам, песни 9-12 *</strong></td>
                            <th>160 Чайтаньи</th>
                          </tr>
<tr>
                            <td><strong>Полный комплект "Чайтанья-чаритамрита" *</strong></td>
                            <th>120 Чайтаний</th>
                          </tr>
                          <tr>
                            <td><strong>Очный курс отдела образования ***</strong><br>Включает: взнос, проживание и питание, если они предусмотрены.</td>
                            <th>200 Чайтаний</th>
                          </tr>
<tr>
                            <td><strong>Полный комплект "Шримад Бхагаватам" *</strong></td>
                            <th>240 Чайтаний</th>
                          </tr>
<tr>
                            <td><strong>Бхакти-шастры/Бхакти-вайбхава в Маяпуре или Вриндаване ****</strong><br>Только взнос за обучение, без билетов, питания и проживания.</td>
                            <th>480 Чайтаний</th>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                      <p>* Доставку из Москвы Почтой России вы оплачиваете самостоятельно.</p>
                      <p>** Имеется ввиду только онлайн-курс отдела образования. За участие одного человека в одном модуле без взноса рекомендованного пожертвования.</p>
                      <p>*** Участие одного человека на одном курсе из числа: "Курс подготовки учителей 1", "Курс подготовки учителей 2", "Курс подготовки лидеров и менеджеров", "Базовый курс для наставников", "Забота о преданных".</p>
                      <p>**** Обучение на выбор во Вриндаванском/Маяпурском институтах, Вриндаванской академии или Маяпурской академии Бхактиведанты<p>


                                                </div>
                                            </div>
                                        </div>     </div>


            </div>
            </div>




                            </div>

                        </div>
                     </div>
                        <br>
                        <br>

                        <p><h3 class="widget-title line-bottom">Выберите формат своего участия:</h3>
                        </p>
                        <div class="row">



                            @forelse($formats  as $format)
                            <div class="thumbnail col-md-2"> <a href="#"><img class="img-fullwidth" src="{{ asset('/storage/'.$format->image) }}" alt="..."></a>
                                <div class="caption text-center">
                                    <h3>{{ $format->name }}</h3>
                                    <p>{{ $format->summ }}
                                        @if(is_numeric  ($format->summ))руб.
                                        @endif
                                        @if($format->monthly == "Ежемесячно")/мес. @endif</p> <p><a href="{{ route('form', ['id' => $format->id]) }}" class="btn btn-theme-colored btn-flat btn-xl" role="button">Выбрать</a>
                                    </p>
                                </div>
                                <h5><strong>Бонус:</strong></h5>
                                <ul class="list table-list theme-colored check-circle">
                                    <li>{{ $format->bonus_1 }}</li>
                                    <li>{!! $format->bonus_2 !!}</li>
                                    @if ($format->ctn > 0)
                                      <p><strong>+{{ $format->ctn }} Чайтаний в мес.</strong></p>
                                    @endif
                                </ul>
                            </div>
                            @empty
                            <tr>
                                <td><h2>Опции отсутствуют</h2>
                                </td>
                            </tr>
                            @endforelse


                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center">
                                <p>Если вы хотите делать взносы большего размера - <a class="text-theme-colored" style="cursor: pointer;" href="skype:makarovta?add">напишите нам!</a></p>
                                </div><br><br>
                            <div class="col-md-6 text-center">
                             <p><a class="btn btn-default btn-xl btn-theme-colored" style="cursor: pointer;" href="{{ route('bonus.gifts') }}" target="_blank">Обменять Чайтаньи на подарок</a></p>
                            </div>
                            <div class="col-md-6 text-center">
                             <p><a class="btn btn-default btn-xl btn-theme-colored" style="cursor: pointer;" href="{{ route('unsubscribe') }}" target="_blank">Отписаться от ежемесячного перевода</a></p>
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

    <!-- Yandex.Metrika counter -->

    <!-- /Yandex.Metrika counter -->
</body>

</html>
