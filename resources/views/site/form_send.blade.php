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

        <!-- Start main-content -->
        <div class="main-content">
            <section>


                <div id="register" class="panel panel-default col-md-12">
                  <p><h3 class="widget-title line-bottom">Отправка формы</h3></p>
					        <p></p>
                  <p>Автоматическое перенаправление на платежный шлюз...</p>

                    <div class="col-md-6">

                      <form id="payform" action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST>
                         <input type=hidden name=MrchLogin value="{{$mrh_login}}">
                         <input type=hidden name=OutSum value="{{$out_summ}}">
                         <input type=hidden name=InvId value="{{$inv_id}}">
                         <input type=hidden name=Desc value='"{{$inv_desc}}"'>
                         <input type=hidden name=SignatureValue value="{{$crc}}">
                         <input type=hidden name=Email value="{{$Email}}">
                         <input type=hidden name=Receipt value={{$Receipt}}>
                         <input type=hidden name=Culture value="ru">
                         <input type=hidden name=IsTest value="{{$IsTest}}">
                         <input type=submit value='Перейти на платежный шлюз вручную'>
                         </form>
                         <script type="text/javascript">
                              setTimeout(function() {
                              	var form = document.getElementById('payform');
                              	form.submit();
                              }, 1);
                         </script>
                    </div>
                </div>
        </div>
    </div>
    </section>
    </div>
    <!-- end main-content -->

</body>

</html>
