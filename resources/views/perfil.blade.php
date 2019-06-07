@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-layout justify-center row >
        <div class="display-2 primary--text text-center">
            Perfil
        </div>
    </v-layout>
</v-container>

<v-container fluid fill-height>

    <v-layout  justify-center>
        <v-flex xs12 sm8 md6>
            <v-btn :href="'/home'" color="white"> <jb-icon dark color="primary" small class="pr-1"> fas fa-home </jb-icon> Home </v-btn>

            <usuario-perfil perfil="{{json_encode($perfil)}}" />

        </v-flex>
    </v-layout>
</v-container>

@endsection
