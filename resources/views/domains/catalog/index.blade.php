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
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">7</a>
                    </div>
                </div>
                <div class="catalog-section__filters">
                    <div class="filter-group">
                        <label>Фильтр</label>
                        <div class="filter-group__body">
                            <input type="text" placeholder="test">
                            <input type="text" placeholder="test">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label>Фильтр</label>
                        <div class="filter-group__body">
                            <input type="text" placeholder="test">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label>Фильтр</label>
                        <div class="filter-group__body">
                            <select name="#" id="#">
                                <option value="#">filter</option>
                                <option value="#">filter</option>
                                <option value="#">filter</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn">Применить</button>
                </div>
            </div>
        </div>
    </section>
@endsection
