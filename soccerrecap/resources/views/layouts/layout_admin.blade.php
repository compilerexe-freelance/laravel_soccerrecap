<!DOCTYPE html>
<html>
@include('layouts.components.admin.header')
<body>
@yield('navbar')

<div class="container">
    <div class="row">
        @yield('content')
    </div>
</div>

</body>
</html>