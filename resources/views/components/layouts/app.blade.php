<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($title) && !empty($title))
            {{ $title }} - {{ config('app.name', 'Laravel') }}
        @elseif(View::hasSection('title'))
            @yield('title') - {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>
<body class="min-h-full flex flex-col font-sans antialiased bg-slate-950 text-slate-100">
    {{-- ヘッダー --}}
    @include('layouts.header')

    {{-- メインコンテンツ --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if( Route::is('top') || Route::is('other') || Route::is('link'))
            {{-- Blade + Alpine.js --}}
            <fieldset class="border rounded">
                <legend class="ml-3">Livewireなし + Alpine.jsでセッションとイベント両対応のメッセージ表示</legend>
                <x-message />
            </fieldset>
        @endif

        {{ $slot ?? '' }}
        @yield('content')

        @if( Route::is('top') || Route::is('other') || Route::is('link'))
            {{-- Livewire + Alpine.js --}}
            <fieldset class="border rounded">
                <legend class="ml-3">Livewireで表示内容作成 + Alpine.jsにイベント送信してメッセージ表示</legend>
                <livewire:livewire.message />
            </fieldset>
            <div class="mt-10"></div>
            {{-- Livewire(no event) + Alpine.js --}}
            <fieldset class="border rounded">
                <legend class="ml-3">Livewireで表示内容作成 + Alpine.jsのinitでメッセージ表示</legend>
                <livewire:livewire.not_resend_event />
            </fieldset>
        @endif
    </main>

    {{-- フッター --}}
    @include('layouts.footer')

    @stack('scripts')
    @livewireScripts
</body>
</html>

