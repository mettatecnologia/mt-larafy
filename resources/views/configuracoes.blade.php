@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-layout justify-center row >
        <div class="display-2 primary--text text-center">
            Configurações do Sistema
        </div>
    </v-layout>
</v-container>

<v-container fluid fill-height>
    <v-layout align-start justify-center wrap >
        <v-flex xs10>

            <v-btn :href="'/home'" color="white"> <jb-icon dark color="primary" small class="pr-1"> fas fa-home </jb-icon> Home </v-btn>
            <crud-configuracoes configs="{{json_encode($configs)}}" />

        </v-flex>
    </v-layout>
</v-container>

@endsection
