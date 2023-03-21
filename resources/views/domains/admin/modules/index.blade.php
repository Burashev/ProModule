@extends('layouts.admin')

@section('title', 'Админ панель')

@section('content')
    <div class="table__wrapper">
        <div class="table__header">
            <form method="get" class="admin-section__search-form">
                <input type="text" placeholder="Поиск..." name="search" value="{{request('search')}}">
                <button type="submit" class="btn btn-icon admin-section__search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill="white" fill-rule="evenodd"
                              d="M4 9a5 5 0 1110 0A5 5 0 014 9zm5-7a7 7 0 104.2 12.6.999.999 0 00.093.107l3 3a1 1 0 001.414-1.414l-3-3a.999.999 0 00-.107-.093A7 7 0 009 2z"/>
                    </svg>
                </button>
            </form>
            <a href="{{route('admin.modules.create')}}" class="btn">Создать</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Компетенция</th>
                <th>Автор</th>
                <th>Теги</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{$module->getKey()}}</td>
                    <td><a href="{{route('module', $module->slug)}}">{{$module->title}}</a></td>
                    <td>{{$module->skill->title}}</td>
                    <td>{{$module->user->bio->name}}</td>
                    <td>
                        @each('domains.catalog.partials.tag', $module->tags, 'tag')
                    </td>
                    <td class="table-action-td">
                        <a href="#" class="table-action">Редактировать</a>
                        <form action="{{route('admin.modules.delete', $module->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="table-action table-action-delete">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="paginate">
            @for($i = 1; $i <= $pages; $i++)
                <a href="{{$modules->url($i)}}"
                    @class([
                        'active' => $modules->currentPage() === $i
                    ])
                >{{$i}}</a>
            @endfor
        </div>
    </div>
@endsection
