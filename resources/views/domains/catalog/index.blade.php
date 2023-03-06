@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <section class="section catalog-section">
        <div class="container">
            <div class="section__header">
                <h1>Каталог</h1>
            </div>
            <div class="section__body">
                <div class="catalog-section__module-list">
                    {{-- Компетенция Заголовок Автор Теги--}}
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Заголовок</th>
                            <th>Компетенция</th>
                            <th>Автор</th>
                            <th>Теги</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="catalog-section__paginate">
                        @for($i = 1; $i <= $pages; $i++)
                            <a href="{{$modules->url($i)}}"
                                @class([
                                    'active' => $modules->currentPage() === $i
                                ])
                            >{{$i}}</a>
                        @endfor
                    </div>
                </div>
                <div class="catalog-section__filters">
                    <form method="get">
                        @foreach(filters('catalog') as $filter)
                            {!! $filter !!}
                        @endforeach
                        <div class="catalog-section__filters__buttons">
                            <button class="btn" type="submit">Применить</button>
                            <button class="btn outlined" type="reset">Сбросить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('assets/js/resetForm.js')}}"></script>
@endsection
