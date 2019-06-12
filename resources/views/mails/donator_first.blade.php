<html>
    <head>
        <title>Уведомление о регистрации</title>
        <meta charset="utf8">
    </head>
    <body>
        <h2>Здравствуйте, {{$data['name']}}!</h2>
        <p>Вы успешно зарегистрированы на сайте http://iskconclub.ru</p>
        <p>Ваш логин: {{$data['email']}} </p>
        <p>Ваш пароль: {{$data['password']}} </p>
    </body>
</html>
