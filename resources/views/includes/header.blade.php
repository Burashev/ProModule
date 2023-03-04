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
                @guest
                    <a href="{{route('register')}}" class="btn">Вступить</a>
                @elseauth
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn">Выйти</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</header>
