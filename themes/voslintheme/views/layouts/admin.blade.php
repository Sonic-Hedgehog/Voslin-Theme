<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Software build by https://paymenter.org -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin - ' . $title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    @if (config('settings::app_logo'))
        <link rel="icon" href="{{ asset(config('settings::app_logo')) }}" type="image/png">
    @else
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        window.addEventListener('keydown', function(e) {
            var ctrlDown = true;
            var ctrlKey = 17,
                enterKey = 13;
            $(document).keydown(function(e) {
                if (e.keyCode == ctrlKey) ctrlDown = true;
                if (e.keyCode == enterKey && ctrlDown) {
                    if ($('#submit').length) {
                        $('#submit').click();
                    }
                }
            }).keyup(function(e) {
                if (e.keyCode == ctrlKey) ctrlDown = false;
            });
        });
    </script>
    <style>
        body {
            background-image: url("{{ config('settings::theme:bg-url', '#') }}");
            background-size: center;
            background-repeat: no-repeat; 
        }
        :root {
            --secondary-50: {{ config('settings::theme:secondary-50', '#ffffff') }};
            --secondary-100: {{ config('settings::theme:secondary-100', '#fafcff') }};
            --secondary-200: {{ config('settings::theme:secondary-200', '#ebeef3') }};
            --secondary-300: {{ config('settings::theme:secondary-300', '#bbbfd2') }};
            --secondary-400: {{ config('settings::theme:secondary-400', '#808498') }};
            --secondary-500: {{ config('settings::theme:secondary-500', '#606372') }};
            --secondary-600: {{ config('settings::theme:secondary-600', '#4d4f60') }};
            --secondary-700: {{ config('settings::theme:secondary-700', '#353741') }};
            --secondary-800: {{ config('settings::theme:secondary-800', '#1c1c20') }};
            --secondary-900: {{ config('settings::theme:secondary-900', '#000000') }};

            --primary-50: {{ config('settings::theme:primary-50', '#EDF0FF') }};
            --primary-100: {{ config('settings::theme:primary-100', '#C6DBFF') }};
            --primary-200: {{ config('settings::theme:primary-200', '#9BBEFB') }};
            --primary-300: {{ config('settings::theme:primary-300', '#799CD8') }};
            --primary-400: {{ config('settings::theme:primary-400', '#5270FD') }};
        }

        .dark {
            --secondary-50: {{ config('settings::theme:secondary-50-dark', '#0B0613') }};
            --secondary-100: {{ config('settings::theme:secondary-100-dark', '#170A24') }};
            --secondary-200: {{ config('settings::theme:secondary-200-dark', '#2F0C4B') }};
            --secondary-300: {{ config('settings::theme:secondary-300-dark', '#361254') }};
            --secondary-400: {{ config('settings::theme:secondary-400-dark', '#A1A1A1') }};
            --secondary-500: {{ config('settings::theme:secondary-500-dark', '#BDBDBD') }};
            --secondary-600: {{ config('settings::theme:secondary-600-dark', '#D1D1D1') }};
            --secondary-700: {{ config('settings::theme:secondary-700-dark', '#DEDEDE') }};
            --secondary-800: {{ config('settings::theme:secondary-800-dark', '#E3E3E3') }};
            --secondary-900: {{ config('settings::theme:secondary-900-dark', '#FAFAFA') }};
        }
    </style>
</head>

<body class="font-sans bg-secondary-100 dark:bg-secondary-50 text-secondary-700">
    <div id="app" class="min-h-screen">
        <x-paymenter-update />
        @if (config('settings::sidebar') == 1)
            @include('layouts.adminnavigation')
        @else
            @include('layouts.adminnavigation')
        @endif
        <main class="grow">
            @if (!request()->routeIs('admin.index') && !request()->routeIs('admin.settings*'))
                <div class="py-12">
                    <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                        <div class="overflow-hidden content">
                            <div class="content-box">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{ $slot }}
            @endif
        </main>

        <x-footer />
    </div>
    <x-success />
</body>

</html>
