<div class="notification">
    <div class="notification__icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
            <path
                d="M12 7C9.23858 7 7 9.23858 7 12C7 13.3613 7.54402 14.5955 8.42651 15.4972C8.77025 15.8484 9.05281 16.2663 9.14923 16.7482L9.67833 19.3924C9.86537 20.3272 10.6862 21 11.6395 21H12.3605C13.3138 21 14.1346 20.3272 14.3217 19.3924L14.8508 16.7482C14.9472 16.2663 15.2297 15.8484 15.5735 15.4972C16.456 14.5955 17 13.3613 17 12C17 9.23858 14.7614 7 12 7Z"
                stroke-width="2"/>
            <path d="M12 4V3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 6L19 5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M20 12H21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4 12H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5 5L6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 17H14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <p class="notification__text">

    </p>
    <div class="notification__close">
        <p>Закрыть</p>
    </div>
</div>

<script src="{{asset('assets/js/app.js')}}"></script>

@if($notification = flash()->get())
    <script defer>
        setTimeout(() => {
            showNotification('{{$notification->getMessage()}}', '{{$notification->getType()}}')
        }, 500)
    </script>
@endif
