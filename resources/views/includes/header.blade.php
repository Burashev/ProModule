<header class="header">
    <div class="container">
        <div class="header__body">
            <div class="logo">
                <h2>{{env('APP_NAME')}}</h2>
            </div>
            <ul class="header__menu">
                @foreach($menu->all() as $item)
                    <li>
                        <a href="{{$item->url}}" @class(['active' => $item->isActive()])>{{$item->title}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="header__auth-menu">
                <a href="{{route('register')}}" class="btn">Вступить</a>
            </div>
        </div>
    </div>
</header>
