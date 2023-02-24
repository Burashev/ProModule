<header class="header">
    <div class="container">
        <div class="header__body">
            <div class="logo">
                <h2>{{env('APP_NAME')}}</h2>
            </div>
            <ul class="header__menu">
                <li>
                    <a href="#" class="active">Menu 1</a>
                </li>
                <li>
                    <a href="#">Menu 2</a>
                </li>
                <li>
                    <a href="#">Menu 3</a>
                </li>
            </ul>
            <div class="header__auth-menu">
                <a href="{{route('register')}}" class="btn">Вступить</a>
            </div>
        </div>
    </div>
</header>
