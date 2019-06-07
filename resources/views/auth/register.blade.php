@extends('layouts.app')

@section('content')
<v-container fluid fill-height>

    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>

            <cadastrarusuario-form senha-tam-min="{{ $senha_min }}" nome="{{ old('nome') }}" email="{{ old('email') }}" > </cadastrarusuario-form>

        </v-flex>
    </v-layout>
    
</v-container>
@endsection
