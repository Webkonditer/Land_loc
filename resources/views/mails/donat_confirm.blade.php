<html>
    <head>
        <title>Уведомление о платеже</title>
        <meta charset="utf8">
    </head>
    <body>
        <h2>Здравствуйте, {{$data['name']}}!</h2>
        {!! $data['text'] !!}
        <p>Ваш бонусный счет сейчас: {{$data['bonus_points']}} Чайтаний.
    </body>
</html>
