<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>@yield('title', env('APP_NAME'))</title>
</head>
<body>
@include('includes.header')
@include('includes.notification')
<section class="section admin-section">
    <div class="container">
        <div class="section__header">
            <h1>Админ-панель</h1>
        </div>
        <div class="section__body">
            <div class="admin-section__menu">
                @foreach($adminMenu->all() as $item)
                    <a @class(['active' => $item->isActive(), 'admin-section__menu-item'])href="{{$item->url}}">{{$item->title}}</a>
                @endforeach
            </div>
            @yield('content')
        </div>
    </div>
</section>
</body>
</html>
