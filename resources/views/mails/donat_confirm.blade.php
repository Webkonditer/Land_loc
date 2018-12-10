<html>
    <head>
        <title>Уведомление о получении оплаты</title>
        <meta charset="utf8">
    </head>
    <body>
        <h2>Здравствуйте, {{$data['name']}}!</h2>
        <p>Благодарим Вас за оплату курса!</p>
        <p>Ссылка на страницу курса: <a href="http://kurs.prostofood.online/course/{{$data['course']}}">http://kurs.prostofood.online/course/{{$data['course']}}</a></p>
        <p>Ваш логин: {{$data['email']}}</p>
        <p>Ваш пароль: {{$data['password']}}</p>
        <p>Пароль будет действовать в течение 90 дней.</p>
        <p>Вы можете использовать этот пароль на двух компьютерах и одном мобильном устройстве.</p>
        <p> </p>
        <p>С уважением, администрация школы prostofood.online</p>

    </body>
</html>
