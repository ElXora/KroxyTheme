<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'Pterodactyl') }}</title>

        @section('meta')
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <!-- meta data -->

            <meta name="theme-color" content="{{ $siteConfiguration['kroxy']['meta_color'] }}"/>
            <link rel="icon" type="image/x-icon" href="{{ $siteConfiguration['kroxy']['meta_favicon'] }}">

            <meta name="title" content="{{ $siteConfiguration['kroxy']['meta_title'] }}" />
            <meta name="description" content="{{ $siteConfiguration['kroxy']['meta_description'] }}" />

            <meta property="og:type" content="website" />
            <meta property="og:url" content="{{config('app.url', 'https://localhost')}}" />
            <meta property="og:title" content="{{ $siteConfiguration['kroxy']['meta_title'] }}" />
            <meta property="og:description" content="{{ $siteConfiguration['kroxy']['meta_description'] }}" />
            <meta property="og:image" content="{{ $siteConfiguration['kroxy']['meta_image'] }}" />

            <meta property="twitter:card" content="summary_large_image" />
            <meta property="twitter:url" content="{{config('app.url', 'https://localhost')}}" />
            <meta property="twitter:title" content="{{ $siteConfiguration['kroxy']['meta_title'] }}" />
            <meta property="twitter:description" content="{{ $siteConfiguration['kroxy']['meta_description'] }}" />
            <meta property="twitter:image" content="{{ $siteConfiguration['kroxy']['meta_image'] }}" />

            <!-- PWA -->
            <link rel="manifest" href="/manifest.json">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
            <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Pterodactyl') }}">
            <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">

            <!-- meta data -->
            <!--
            <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png?v=%%__USER__%%">
            <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
            <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
            <link rel="manifest" href="/favicons/manifest.json">
            <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
            <link rel="shortcut icon" href="/favicons/favicon.ico">
            <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        -->
        @show

        @section('user-data')
            @if(!is_null(Auth::user()))
                <script>
                    window.PterodactylUser = {!! json_encode(Auth::user()->toVueObject()) !!};
                </script>
            @endif
            @if(!empty($siteConfiguration))
                <script>
                    window.SiteConfiguration = {!! json_encode($siteConfiguration) !!};
                </script>
            @endif
        @show
        <style>
            @import url('{{
                    [
                        'poppins' => '//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
                        'dm_sans' => '//fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap',
                        'roboto' => '//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap',
                        'sciencegothic' => '//fonts.googleapis.com/css2?family=Science+Gothic:wght@300;400;500;700&display=swap',
                        'inter' => '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
                        'montserrat' => '//fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap',
                        'open_sans' => '//fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap',
                        'lato' => '//fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap',
                        'nunito' => '//fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap',
                        'oswald' => '//fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;700&display=swap',
                        'playfair' => '//fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap',
                        'source_sans' => '//fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap',
                        'quicksand' => '//fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap',
                        'manrope' => '//fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap',
                        'space_grotesk' => '//fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
                    ][$siteConfiguration['kroxy']['font']] ?? ''
                }}');
                
            @import url('//fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap');
            @import url('//fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:500&display=swap');
            
            :root{
                <?php if ($siteConfiguration['kroxy']['borderInput'] === 'true') {
                    echo '--borderInput: 1px solid;
';  
                }?>
                --radiusBox: {{ $siteConfiguration['kroxy']['radiusBox'] }}px;
                --radiusInput: {{ $siteConfiguration['kroxy']['radiusInput'] }}px;

                --fontFamily: '{{
                    [
                        'poppins' => 'Poppins',
                        'dm_sans' => 'IBM Plex Sans',
                        'roboto' => 'Roboto',
                        'sciencegothic' => 'Science Gothic',
                        'inter' => 'Inter',
                        'montserrat' => 'Montserrat',
                        'open_sans' => 'Open Sans',
                        'lato' => 'Lato',
                        'nunito' => 'Nunito',
                        'oswald' => 'Oswald',
                        'playfair' => 'Playfair Display',
                        'source_sans' => 'Source Sans Pro',
                        'quicksand' => 'Quicksand',
                        'manrope' => 'Manrope',
                        'space_grotesk' => 'Space Grotesk',
                    ][$siteConfiguration['kroxy']['font']] ?? ''
                }}';
            }

            <?php if ($siteConfiguration['kroxy']['defaultMode'] === 'darkmode') {
                echo ':root';
            } else {
                echo '.lightmode';
            }?>{
                --image: url({{ $siteConfiguration['kroxy']['backgroundImage'] }});
                --primary: {{ $siteConfiguration['kroxy']['primary'] }};
                --onPrimary: #0a0a0a;

                --successText: {{ $siteConfiguration['kroxy']['successText'] }};
                --successBorder: {{ $siteConfiguration['kroxy']['successBorder'] }};
                --successBackground: {{ $siteConfiguration['kroxy']['successBackground'] }};

                --dangerText: {{ $siteConfiguration['kroxy']['dangerText'] }};
                --dangerBorder: {{ $siteConfiguration['kroxy']['dangerBorder'] }};
                --dangerBackground: {{ $siteConfiguration['kroxy']['dangerBackground'] }}; 

                --secondaryText: {{ $siteConfiguration['kroxy']['secondaryText'] }};
                --secondaryBorder: {{ $siteConfiguration['kroxy']['secondaryBorder'] }};
                --secondaryBackground: {{ $siteConfiguration['kroxy']['secondaryBackground'] }};

                --gray50: {{ $siteConfiguration['kroxy']['gray50'] }};
                --gray100: {{ $siteConfiguration['kroxy']['gray100'] }};
                --gray200: {{ $siteConfiguration['kroxy']['gray200'] }};
                --gray300: {{ $siteConfiguration['kroxy']['gray300'] }};
                --gray400: {{ $siteConfiguration['kroxy']['gray400'] }};
                --gray500: {{ $siteConfiguration['kroxy']['gray500'] }};
                --gray600: {{ $siteConfiguration['kroxy']['gray600'] }};
                --gray700: color-mix(in srgb, {{ $siteConfiguration['kroxy']['gray700'] }} {{ $siteConfiguration['kroxy']['backdropPercentage'] }}%, transparent);
                --gray800: {{ $siteConfiguration['kroxy']['gray800'] }};
                --gray900: {{ $siteConfiguration['kroxy']['gray900'] }};

                --gray700-default: {{ $siteConfiguration['kroxy']['gray700'] }};
                --fallBackGray: color-mix(in srgb, {{ $siteConfiguration['kroxy']['gray700'] }} {{ $siteConfiguration['kroxy']['backdropPercentage'] }}%, transparent);
            }
            <?php if ($siteConfiguration['kroxy']['defaultMode'] !== 'darkmode') {
                echo ':root';
            } else {
                echo '.lightmode';
            }?>{
                --image: url({{ $siteConfiguration['kroxy']['backgroundImageLight'] }});
                --primary: {{ $siteConfiguration['kroxy']['lightmode_primary'] }};
                --onPrimary: #ffffff;

                --successText: {{ $siteConfiguration['kroxy']['lightmode_successText'] }};
                --successBorder: {{ $siteConfiguration['kroxy']['lightmode_successBorder'] }};
                --successBackground: {{ $siteConfiguration['kroxy']['lightmode_successBackground'] }};

                --dangerText: {{ $siteConfiguration['kroxy']['lightmode_dangerText'] }};
                --dangerBorder: {{ $siteConfiguration['kroxy']['lightmode_dangerBorder'] }};
                --dangerBackground: {{ $siteConfiguration['kroxy']['lightmode_dangerBackground'] }}; 

                --secondaryText: {{ $siteConfiguration['kroxy']['lightmode_secondaryText'] }};
                --secondaryBorder: {{ $siteConfiguration['kroxy']['lightmode_secondaryBorder'] }};
                --secondaryBackground: {{ $siteConfiguration['kroxy']['lightmode_secondaryBackground'] }};

                --gray50: {{ $siteConfiguration['kroxy']['lightmode_gray50'] }};
                --gray100: {{ $siteConfiguration['kroxy']['lightmode_gray100'] }};
                --gray200: {{ $siteConfiguration['kroxy']['lightmode_gray200'] }};
                --gray300: {{ $siteConfiguration['kroxy']['lightmode_gray300'] }};
                --gray400: {{ $siteConfiguration['kroxy']['lightmode_gray400'] }};
                --gray500: {{ $siteConfiguration['kroxy']['lightmode_gray500'] }};
                --gray600: {{ $siteConfiguration['kroxy']['lightmode_gray600'] }}; 
                --gray700: color-mix(in srgb, {{ $siteConfiguration['kroxy']['lightmode_gray700'] }} {{ $siteConfiguration['kroxy']['backdropPercentage'] }}%, transparent);
                --gray800: {{ $siteConfiguration['kroxy']['lightmode_gray800'] }};
                --gray900: {{ $siteConfiguration['kroxy']['lightmode_gray900'] }};

                --gray700-default: {{ $siteConfiguration['kroxy']['lightmode_gray700'] }};
            }

            <?php if ($siteConfiguration['kroxy']['backdrop'] === 'true') {
                echo '.backdrop{border:1px solid;border-color:var(--gray600)!important;backdrop-filter:blur(16px);}';
            }?>

            .privacy .privacy-blur:not(:focus){
                color: transparent !important;
                text-shadow: 0 0 5px color-mix(in srgb, var(--gray200) 50%, transparent) !important;
            }
        </style>

        @yield('assets')

        @include('layouts.scripts')
    </head>
    <body class="{{ $css['body'] ?? 'bg-neutral-50' }}">
        @section('content')
            @yield('above-container')
            @yield('container')
            @yield('below-container')
        @show
        @section('scripts')
            {!! $asset->js('main.js') !!}
        @show

        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then((registration) => {
                            console.log('SW registered:', registration.scope);
                        })
                        .catch((error) => {
                            console.log('SW registration failed:', error);
                        });
                });
            }
        </script>
    </body>
</html>
