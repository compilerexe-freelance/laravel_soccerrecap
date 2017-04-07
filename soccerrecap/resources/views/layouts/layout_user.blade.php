<!DOCTYPE html>
<html>
    @include('layouts.components.header')
    <body>
    @yield('navbar')

    <div class="container animated fadeIn">
        <div class="row">
            @yield('content')
        </div>
    </div>

    </body>
</html>