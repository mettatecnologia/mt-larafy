<?php
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet">


</head>
<body>
    <div id="app" style="display: none">
        <v-app ligth>

            @guest
                <jb-barrasuperior titulo="{{ config('app.name', 'Laravel') }}" >
                    <v-spacer></v-spacer>

                    {{-- <v-btn flat small href="{{ route('register') }}">Registrar</v-btn> --}}
                    <v-btn flat small href="{{ route('login') }}">Entre</v-btn>
                </jb-barrasuperior>
            @else
                <jb-barrasuperior titulo="{{ config('app.name', 'Laravel') }}">
                    <v-spacer></v-spacer>
                    <jb-menucircular-usuario titulo="{{ explode(' ', Auth::user()->name)[0] }}" csrf="{{csrf_token()}}" logout-href="{{ route('logout') }}" >

                        <jb-menucircular-usuario-item titulo="Perfil" href="/perfil" icone="fa-id-card"></jb-menucircular-usuario-item>
                        <template v-if="{{json_encode($User->papel=='ADM')}}">
                            <jb-menucircular-usuario-item titulo="Configurações" href="/configs" icone="fa-cogs"></jb-menucircular-usuario-item>
                        </template>

                    </jb-menucircular-usuario>

                </jb-barrasuperior>

            @endguest

            <v-content>
                @yield('content')
            </v-content>

            <v-footer app></v-footer>

        </v-app>
    </div>

    <!-- CDNs -->


    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Styles -->
    <!-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> -->


    <link href="{{ asset('public/css/vuetify.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/vuetify-dialog.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/global.css') }}" rel="stylesheet">
</body>
</html>
