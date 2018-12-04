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
    <link href="{{ asset('/css/modal_window.css') }}" rel="stylesheet" type="text/css">
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
                                    <a href="{{route('logout')}}" >Выйти</a>
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


                <div id="register" class="panel panel-default col-md-12">
                  <p><h3 class="widget-title line-bottom">Ваш личный кабинет</h3></p>
					        <p></p>


                  <div class="row">
                      <div class="col-sm-12">
                        @if  ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach  ($errors->all() as $error){{--Возврат ошибок--}}
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                            <tbody>
                              <h3>Ваши данные:</h3>
                                <tr role="row" >
                                    <td style="vertical-align:middle">Ваш Email</td>
                                    <td style="vertical-align:middle">{{ $donator->email }}</td>
                                    <td style="vertical-align:middle"></td>
                                </tr>
                                <tr role="row" >
                                    <td style="vertical-align:middle">Ваше имя</td>
                                    <td style="vertical-align:middle">{{ $donator->name }}</td>
                                    <td style="vertical-align:middle"><i class="fa fa-pencil" aria-hidden="true"></i> <a href="#win1">Изменить</a></td>
                                    <a href="#x" class="overlay" id="win1"></a>
                                    <div class="popup">
                                      <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ route('user.dashboard.edit')}}" method="POST">
                                          @csrf
                                          <label for="name" class="col-form-label">Ваше имя:</label>
                                          <input type="text" name="name" placeholder="Ваше имя" class="form-control" required="required" value="{{ $donator->name }}">
                                          <input onclick="return confirm ('Изменить имя?')" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Изменить" />
                                      </form>
                                    <a class="close"title="Закрыть" href="#close"></a>
                                    </div>
                                </tr>

                                <tr role="row" >
                                    <td style="vertical-align:middle">Ваш телефон</td>
                                    <td style="vertical-align:middle">{{ $donator->phone }}</td>
                                    <td style="vertical-align:middle"><i class="fa fa-pencil" aria-hidden="true"></i> <a href="#win2">Изменить</a></td>
                                    <a href="#x" class="overlay" id="win2"></a>
                                    <div class="popup">
                                      <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ route('user.dashboard.edit')}}" method="POST">
                                          @csrf
                                          <label for="name" class="col-form-label">Ваш телефон:</label>
                                          <input type="text" name="phone" placeholder="Ваш телефон" class="form-control" required="required" value="{{ $donator->phone }}">
                                          <input onclick="return confirm ('Изменить телефон?')" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Изменить" />
                                      </form>
                                    <a class="close"title="Закрыть" href="#close"></a>
                                    </div>
                                </tr>
                                <tr role="row" >
                                    <td style="vertical-align:middle">Ваш город</td>
                                    <td style="vertical-align:middle">{{ $donator->city }}</td>
                                    <td style="vertical-align:middle"><i class="fa fa-pencil" aria-hidden="true"></i> <a href="#win3">Изменить</a></td>
                                    <a href="#x" class="overlay" id="win3"></a>
                                    <div class="popup">
                                      <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ route('user.dashboard.edit')}}" method="POST">
                                          @csrf
                                          <label for="name" class="col-form-label">Ваш город:</label>
                                          <input type="text" name="city" placeholder="Ваш телефон" class="form-control" required="required" value="{{ $donator->city }}">
                                          <input onclick="return confirm ('Изменить город?')" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Изменить" />
                                      </form>
                                    <a class="close"title="Закрыть" href="#close"></a>
                                    </div>
                                </tr>
                                <tr role="row" >
                                    <td style="vertical-align:middle">Анонимность</td>
                                    <td style="vertical-align:middle">{{ $donator->anonim }}</td>
                                    <td style="vertical-align:middle"><i class="fa fa-pencil" aria-hidden="true"></i> <a href="#win4">Изменить</a></td>
                                    <a href="#x" class="overlay" id="win4"></a>
                                    <div class="popup">
                                      <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ route('user.dashboard.edit')}}" method="POST">
                                          @csrf
                                          <label for="name" class="col-form-label">Анонимность:</label>

                                          <select class="form-control" name="anonim">
                                              <option value="Да">Да</option>
                                              <option value="Нет">Нет</option>
                                          </select>

                                          <input onclick="return confirm ('Изменить анонимность?')" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Изменить" />
                                      </form>
                                    <a class="close"title="Закрыть" href="#close"></a>
                                    </div>
                                </tr>
                                <tr role="row" >
                                    <td style="vertical-align:middle">Количество Чайтаний (бонусных баллов)</td>
                                    <td style="vertical-align:middle">@if ($donator->bonus_points > 0) {{ $donator->bonus_points }} @else 0 @endif</td>
                                    <td style="vertical-align:middle"></td>
                                </tr>


                            </tbody>
                        </table>
                        <p>
                            <a href="{{ url('/password/reset')}}">--Сброс пароля--</a>
                        </p>

                        <h3>Ваши подписки:</h3>
                        <div class="row">
                            <div class="col-sm-12">
                              @if (isset($recurring->id))
                                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">

                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                                Формат участия
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                                Сумма ежемесячного пожертвования
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                                Подписка зарегистрирована
                                            </th>
                                            <th class="action" style="width:200px !important;"></th>
                                            <th class="action" style="width:200px !important;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr role="row" >

                                            <td style="vertical-align:middle">{{ $format->name }}</td>
                                            <td style="vertical-align:middle">{{ $recurring->summ }}</td>
                                            <td style="vertical-align:middle">{{ $recurring->created_at }}</td>
                                            <td style="vertical-align:middle"><i class="fa fa-pencil" aria-hidden="true"></i> <a href="#win11">Изменить</a></td>
                                            <a href="#x" class="overlay" id="win11"></a>
                                            <div class="popup">
                                              <form name="edit" class="form-inline" enctype="multipart/form-data" action="{{ route('user.dashboard.edit')}}" method="POST">
                                                  @csrf
                                                  <label for="name" class="col-form-label" >Выберите формат Вашего участия:</label>
                                                  <select class="form-control" name="format" required="required">
                                                      <option value="" selected>Выберите формат</option>
                                                    @foreach($formates  as $formatt)
                                                      <option value="{{ $formatt->id }}">{{ $formatt->name }} ({{ $formatt->summ }} руб/мес.)</option>
                                                    @endforeach
                                                  </select>
                                                  <input name="consent" type="checkbox" required="required"> &nbsp;Согласен на изменение суммы ежемесячного платежа
                                                  <input onclick="return confirm ('Изменить подписку?')" type="submit" class="form-control btn btn-primary" style="background-color:rgb(106, 180, 62); border-color:rgb(106, 180, 62)" value="Изменить" />
                                              </form>
                                            <a class="close"title="Закрыть" href="#close"></a>
                                            </div>
                                            <td style="vertical-align:middle"><a onclick="return confirm ('Отписаться от этого ежемесячного платежа?')" href="{{ route('admin.recurring.delete', ['id' => $recurring->id]) }}"><i class="icon glyphicon glyphicon-remove"></i> Отменить подписку</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                              @else
                                        <p style="color:green">Подписки отсутствуют.</p>
                              @endif

                            </div>
                        </div>

                        <h3>Ваши платежи:</h3>

                          <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                              <thead>
                                  <tr role="row">
                                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                          Номер чека
                                      </th>

                                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                          Тип платежа
                                      </th>
                                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                          Сумма пожертвования
                                      </th>
                                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                          Дата
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse($payments  as $payment)
                                  <tr role="row" >
                                      <td style="vertical-align:middle">{{ $payment->id }}</td>
                                      <td style="vertical-align:middle">{{ $payment->repeated }}</td>
                                      <td style="vertical-align:middle">{{ $payment->summ }}</td>
                                      <td style="vertical-align:middle">{{ $payment->created_at }}</td>
                                  </tr>
                                  @empty
                                  <tr>
                                      <td>
                                        <p style="color:green">Платежи не найдены</p>
                                      </td>
                                  </tr>

                                  @endforelse
                              </tbody>

                          </table>
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
