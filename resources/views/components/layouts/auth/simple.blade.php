<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body>
        {{ $slot }}
        {{-- <div>
            {{-- <div class="w-full">
            </div> --}}
        {{-- </div> --}}
        @fluxScripts
    </body>
</html>
