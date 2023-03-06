@extends('layouts.app')

@section('title', "Модуль {$module->title}")

@section('content')
    <!--lib uses jszip-->
    <link rel="stylesheet" href="{{asset('assets/css/libs/docx-preview.css')}}">
    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="{{asset('assets/js/libs/docx-preview.min.js')}}"></script>
    <script>
        fetch('{{$fileLink}}')
            .then((res) => res.blob())
            .then(blob => {
                docx.renderAsync(blob, document.querySelector(".module-section__task"), null, {
                    ignoreWidth: true,
                    inWrapper: false
                })
                    .then(x => console.log("docx: finished"));
            })
    </script>

    <section class="section module-section">
        <div class="container">
            <div class="section__header">
                <h1>Модуль: {{ $module->title }}</h1>
                <div class="module-section__header-info">
                    @each('domains.module.partials.tag', $module->tags, 'tag')
                    <p class="module-section__module-author module-section__header-info__tag">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 32 32">
                            <path
                                d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z"/>
                        </svg>
                        <a href="#">{{ $module->user->bio->name }}</a>
                    </p>
                    <p class="module-section__module-clock module-section__header-info__tag">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             fill="none">
                            <path
                                d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                stroke-width="2"/>
                            <path d="M12 7L12 11.5L12 11.5196C12 11.8197 12.15 12.1 12.3998 12.2665V12.2665L15 14"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>2 часа</span>
                    </p>
                </div>
            </div>
            <div class="section__body">
                <div class="module-section__task-wrapper">
                    <div class="module-section__task">

                    </div>
                </div>
                <div class="module-section__right">
                    <div class="module-section__send">
                        <form class="module-section__send-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <label class="btn">
                                <input type="file" name="file">
                                Загрузить решение
                            </label>
                        </form>
                        <div class="module-section__chat-wrapper">
                            <p>История решений</p>
                            <div class="module-section__chat">

                            </div>
                            <div class="module-section__chat-form-wrapper">
                                <form class="module-section__chat-form" method="post">
                                    @csrf
                                    <input type="text" placeholder="Введите сообщение" name="message">
                                    <button type="submit" class="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M20.33 3.66996C20.1408 3.48213 19.9035 3.35008 19.6442 3.28833C19.3849 3.22659 19.1135 3.23753 18.86 3.31996L4.23 8.19996C3.95867 8.28593 3.71891 8.45039 3.54099 8.67255C3.36307 8.89471 3.25498 9.16462 3.23037 9.44818C3.20576 9.73174 3.26573 10.0162 3.40271 10.2657C3.5397 10.5152 3.74754 10.7185 4 10.85L10.07 13.85L13.07 19.94C13.1906 20.1783 13.3751 20.3785 13.6029 20.518C13.8307 20.6575 14.0929 20.7309 14.36 20.73H14.46C14.7461 20.7089 15.0192 20.6023 15.2439 20.4239C15.4686 20.2456 15.6345 20.0038 15.72 19.73L20.67 5.13996C20.7584 4.88789 20.7734 4.6159 20.7132 4.35565C20.653 4.09541 20.5201 3.85762 20.33 3.66996ZM4.85 9.57996L17.62 5.31996L10.53 12.41L4.85 9.57996ZM14.43 19.15L11.59 13.47L18.68 6.37996L14.43 19.15Z"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="module-section__mediafiles-block">
                        <h3>Медиафайлы</h3>
                        <div class="module-section__mediafiles">
                            @foreach($module->mediaFiles as $file)
                                <a href="{{$file->link}}" download>{{$file->title}} ({{$file->size}})</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
