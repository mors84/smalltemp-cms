<!DOCTYPE html>
<html lang="pl">
<head>

    {{-- Metadata --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>{{trans('admin.adminPanel')}} | {{config('app.name')}}</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{asset('css/admin/vendors.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/app.css')}}">

    {{-- JS Files --}}
    <script src="{{asset('js/admin/vendors.js')}}"></script>
    <script src="{{asset('js/admin/app.js')}}"></script>

</head>
<body class="md-skin fixed-nav no-skin-config">

    <div id="wrapper">

        {{-- Add sidebar - left menu --}}
        @include('admin.includes.sidebar')

        <div id="page-wrapper" class="gray-bg">

            {{-- Add navbar - top menu --}}
            @include('admin.includes.navbar')

            @yield('content')

            {{-- Add footer --}}
            @include('admin.includes.footer')

        </div>

    </div>

    @yield('scripts')

</body>
</html>
