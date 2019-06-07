@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-layout justify-center row >
        <div class="display-2 primary--text text-center">
            Bem-vindo ao <span class="font-weight-bold font-italic">{{ config('app.name', 'Laravel') }}</span>,  {{ explode(' ', Auth::user()->nome)[0] }}
        </div>
    </v-layout>

</v-container>

<v-container fluid >

    <jb-menubloco itens="{{json_encode($blocos_menu)}}"></jb-menubloco>

</v-container>




@endsection
