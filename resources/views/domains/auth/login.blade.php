@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="auth-section__form-wrapper">
        <h2 class="auth-section__form-wrapper__title">Авторизация</h2>
        <form action="{{route('loginPost')}}" method="post">
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
                <label>Пароль</label>
                <input type="password" placeholder="*************" name="password"
                       required @class(['error' => $errors->has('password')])>
                @error('password')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <button class="btn" type="submit">Войти</button>
        </form>
    </div>
@endsection
