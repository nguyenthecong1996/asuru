<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('components.meta')
</head>
<body>
    @include('components.preloader')

    <div id="main-wrapper">
        @include('components.topbar')
        @include('components.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="align-self-center">
                    @yield('breadcrumb')
                </div>
            </div>
            <div class="container-fluid">
                <div class="wrap-content">
                    @yield('content')
                </div>
            </div>
            @include('components.footer')
        </div>
    </div>    
</body>
    @include('components.script')
</html>