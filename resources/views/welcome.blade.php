@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <form action="{{route('logout')}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn">Выйти</button>
            </form>
        @endauth
    </div>
@endsection

