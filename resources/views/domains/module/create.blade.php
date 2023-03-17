@extends('layouts.auth')

@section('title', 'Создание модуля')

@section('content')
    <div class="auth-section__form-wrapper">
        <h2 class="auth-section__form-wrapper__title">Создание модуля</h2>
        <form action="{{route('module.createPost')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <label>Заголовок</label>
                <input type="text" placeholder="ProModule" name="title" value="{{old('title')}}" required
                    @class(['error' => $errors->has('title')])>
                @error('title')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Компетенция</label>
                <select
                    name="skill_id"
                    @class(['error' => $errors->has('skill_id')])
                >
                    @foreach($skills as $skill)
                        <option value="{{$skill->id}}">{{$skill->title}}</option>
                    @endforeach
                </select>
                @error('skill_id')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Файл задания</label>
                <input
                    type="file"
                    name="task_file"
                    @class(['error' => $errors->has('task_file')])
                >
                @error('task_file')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group">
                <label>Медиафайлы</label>
                <input
                    type="file"
                    name="media_files[]"
                    multiple
                    @class(['error' => $errors->has('media_files.*')])
                >
                @error('media_files.*')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <button class="btn" type="submit">Создать</button>
        </form>
    </div>
@endsection
