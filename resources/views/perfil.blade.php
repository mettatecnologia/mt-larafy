@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-row justify="center" row >
        <div class="display-2 primary--text text-center">
            Perfil
        </div>
    </v-row>
</v-container>

<v-container fluid>

    <v-row  justify="center">
        <v-col cols="12" sm="8" md="6" >
            <v-btn :href="'/home'" color="white" class="mb-2"> <jb-icon dark color="primary" small class="pr-1"> fas fa-home </jb-icon> Home </v-btn>

            <usuario-perfil :perfil="{{json_encode($perfil)}}" />

        </v-col>
    </v-row>
</v-container>

@endsection
