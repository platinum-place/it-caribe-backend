<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>IT - Insurance Tech</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <!-- Aqui se cargaran el css que se utilicen en las vistas -->
    @yield('css')

    <style>
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    @yield('content')

    <!-- Aqui se cargaran el js que se utilicen en las vistas -->
    @yield('js')
</body>

</html>