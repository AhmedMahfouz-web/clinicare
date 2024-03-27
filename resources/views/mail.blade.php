<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>مرحبا, {{ $name }}</h1>
    <p>شكرا لانضمامك لمنصة كلينيكير للرأي الطبي الثاني، نتمني لكم الشفاء العاجل.</p>
    <p>نرجو فضلاً الضغط علي الرابط لتفعيل عضويتكم و الاستفادة من خدمات المنصة.</p>
    <h2><a href="{{ $link }}">{{ $link }}</a></h2>
    <p>و تقبلوا تحياتنا</p>
    <p>إدارةالمنصة</p>
    <img src="{{ asset('/public/images/logo.png') }}" alt="" style="width: 70px">
</body>

</html>
