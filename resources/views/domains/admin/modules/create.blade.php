@extends('layouts.auth')

@section('title', 'Создание модуля')

@section('content')
    <div class="auth-section__form-wrapper">
        <h2 class="auth-section__form-wrapper__title">Создание модуля</h2>
        <form action="{{route('admin.modules.createPost')}}" method="post" enctype="multipart/form-data">
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
                <label>Время выполнения в минутах</label>
                <input type="number" placeholder="120" name="time" value="{{old('time')}}" required min="0"
                    @class(['error' => $errors->has('time')])>
                @error('time')
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
            <div class="input-group">
                <label>Теги</label>
                <select name="tag_ids[]" id="tags_select" multiple>
                    @foreach($tagTypes as $tagType)
                        <optgroup label="{{$tagType->title}}">
                            @foreach($tagType->tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->title}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('tag_ids.*')
                <p class="input-error">{{$message}}</p>
                @enderror
            </div>
            <button class="btn" type="submit">Создать</button>
        </form>
    </div>

    <script type="text/javascript">

        $("#tags_select").select2({
            width: '100%',
            placeholder: "Выберите теги",
            allowClear: true
        });
    </script>
@endsection
