<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
@include('website::partials.head')
</head>
<body>

@include('website::partials.cursor')
@include('website::partials.auth-modal')
@include('website::partials.nav')

<main>
@yield('content')
</main>

@include('website::partials.footer')
@include('website::partials.scripts')
</body>
</html>
