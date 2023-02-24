@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="auth-section__form-wrapper">
        <h2 class="auth-section__form-wrapper__title">Регистрация</h2>
        <form action="{{route('registerPost')}}" method="post">
            @csrf
            <div class="input-group">
                <label>Почта</label>
                <input type="email" placeholder="email@gmail.com" name="email" value="{{old('email')}}" required
                    @class(['error' => $errors->has('email')])>
                @error('email')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Роль</label>
                <select name="role_id" required @class(['error' => $errors->has('role_id')])>
                    <option value="1">Участник</option>
                    <option value="2">Эксперт</option>
                </select>
                @error('sex')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>ФИО</label>
                <input type="text" placeholder="Александр Сергеевич Пушкин" name="name" value="{{old('name')}}"
                       required @class(['error' => $errors->has('name')])>
                @error('name')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Пол</label>
                <select name="sex" required @class(['error' => $errors->has('sex')])>
                    <option value="Мужчина">Мужчина</option>
                    <option value="Женщина">Женщина</option>
                </select>
                @error('sex')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Город</label>
                <input type="text" placeholder="Казань" name="city" required @class(['error' => $errors->has('city')]) value="{{old('city')}}">
                @error('city')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Учебное учреждение</label>
                <input type="text" placeholder="МЦК-КТИТС" name="institution" value="{{old('institution')}}"
                       required @class(['error' => $errors->has('institution')])>
                @error('institution')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Тип учебного учреждения</label>
                <input type="text" placeholder="Университет" name="institution_type" value="{{old('institution_type')}}"
                       required @class(['error' => $errors->has('institution_type')])>
                @error('institution_type')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Пароль</label>
                <input type="password" placeholder="*************" name="password"
                       required @class(['error' => $errors->has('password')])>
                @error('password')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Повторите пароль</label>
                <input type="password" placeholder="*************" name="password_confirmation"
                       required @class(['error' => $errors->has('password_confirmation')])>
                @error('password_confirmation')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <button class="btn" type="submit">Зарегистрироваться</button>
        </form>
    </div>
@endsection
