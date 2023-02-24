@extends('layouts.auth')

@section('title', 'Подтверждение почты')

@section('content')
    <div class="auth-section__form-wrapper email-verify">
        <h2 class="auth-section__form-wrapper__title">Подтверждение почты</h2>
        <form action="{{route('verification.send')}}" method="post">
            @csrf
            <button class="btn" type="submit">Отправить</button>
        </form>
    </div>
@endsection
