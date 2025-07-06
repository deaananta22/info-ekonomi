<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head.head')
</head>
<body>
    @include('layouts.navbar.navbar')
    @yield('content')
</body>
    @include('layouts.script.script')
</html>