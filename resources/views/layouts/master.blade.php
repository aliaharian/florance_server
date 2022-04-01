<!doctype html>
<html>
<head>
    @include('includes.headLinks')

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"--}}
{{--          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="--}}
{{--          crossorigin="anonymous" referrerpolicy="no-referrer"/>--}}
    {{--    favicons--}}

    <link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/smanifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    {{--    favicons--}}


    {{--    seo part--}}


    <meta name="keywords"
          content="کالیگرافی,نفاشیخط,نقاشی خط,خط نقاشی,خطنقاشی,خط نگاره,هنرمند,آرتیست,خوشنویسی,خوش نویسی,نقاش"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="fa-IR">


    <meta name="msapplication-navbutton-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">

    <meta name="format-detection" content="telephone=no">


    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Arts of nasirzadeh">


    <link rel="apple-touch-icon" href="/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon-precomposed" href="/icons/apple-icon-57x57.png">




    <link rel="apple-touch-startup-image" href="/icons/apple-icon-57x57.png">
    <link rel="mask-icon" href="/icons/apple-icon-57x57.png" color="#ffffff">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="mobile-web-app-capable" content="yes">
    <meta name="google" value="notranslate">

    @yield('headSection')
</head>
<body>
<div class="resBgFixed"></div>
@include('includes.header')
@yield('bodySection')
@include('includes.footer')
@include('includes.footerLinks')
@yield('scriptsSection')


</body>

</html>