<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="http://kurs.prostofood.online/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="http://kurs.prostofood.online/css/app.css" rel="stylesheet">
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
        <a href="https://prostofood.online" >Приобрести курс</a>
        </li>
        <li class="">
        <a href="https://kurs.prostofood.online" >Выбрать курс</a>
        </li>
        <li class="">
        <a href="https://kurs.prostofood.online" >ВКонтакте</a>
        </li>
        <li class="">
        <a href="https://kurs.prostofood.online" >Instagram</a>
        </li>
                </ul>

                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Start main-content -->
    <section>
<br><br><br><br>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Войдите, используя регистрационные данные из письма</h3>
  </div>
  <div class="panel-body">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif    

    <form method="POST" action="{{ route('login') }}">
        @csrf
          <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail адрес</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>
              </div>
              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
              </div>
              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>

          <div class="checkbox">
              <div class="row">
              <div class="col-md-8 offset-md-4">
              <label>
                  <input class="form-check-input" type="checkbox" name="remember" id="remember">
                  Запомнить меня
              </label>
           </div>
          </div>
          </div>


          <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      Войти
                  </button>

                  <a class="btn btn-link" href="{{ route('password.reset') }}">
                      Забыли пароль?
                  </a>
              </div>
          </div>
    </form>
</div>
  </div>
</div>
</div>


    </section>
        <!-- end main-content -->
<br><br><br><br>
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
