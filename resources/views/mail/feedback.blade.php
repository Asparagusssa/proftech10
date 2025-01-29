<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Связь по почте</title>
</head>
<body>
<p><strong>ФИО:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
@if(isset($data['comment']))
    <p><strong>Сообщение:</strong> {{ $data['comment'] }}</p>
@else
    <p><strong>Сообщения нет</strong></p>
@endif
</body>
</html>
