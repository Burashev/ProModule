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
                                    <td>{{$module->title}}</td>
                                    <td>{{$module->skill->title}}</td>
                                    <td>{{$module->user->bio->name}}</td>
                                    <td>Теги</td>
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
                    <form action="#">
                        @foreach(filters('catalog') as $filter)
                            {!! $filter !!}
                        @endforeach
{{--                        <div class="filter-group">--}}
{{--                            <label>Фильтр</label>--}}
{{--                            <div class="filter-group__body">--}}
{{--                                <input type="text" placeholder="test">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="filter-group">--}}
{{--                            <label>Фильтр</label>--}}
{{--                            <div class="filter-group__body">--}}
{{--                                <select name="#" id="#">--}}
{{--                                    <option value="#">filter</option>--}}
{{--                                    <option value="#">filter</option>--}}
{{--                                    <option value="#">filter</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <button class="btn" type="submit">Применить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
