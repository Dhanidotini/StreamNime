@php
    $iconsName = [
        'bookmark_border',
        'tune',
        'calendar_month',
        'theater_comedy',
        'download',
        'expand_more',
        'info',
        'menu',
        'new_releases',
        'play_arrow',
        'search',
        'smart_display',
        'star',
        'trophy',
        'category',
        'chevron_left',
        'chevron_right',
        'sort',
        'arrow_back',
        'arrow_forward',
        'equalizer'
    ];
    sort($iconsName);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.svg') }}" data-navigate-track>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&icon_names=@foreach($iconsName as $name){{ $loop->last ? $name : "$name," }}@endforeach&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <style>
        [x-cloack] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ showSearch: false }"
    class="bg-background-light dark:bg-background-dark font-display text-gray-900 dark:text-white antialiased selection:bg-primary selection:text-white">
    {{ $slot }}

    @livewireScripts
</body>

</html>
