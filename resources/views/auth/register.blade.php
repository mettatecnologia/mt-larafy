@extends('layouts.app')

@section('content')
<v-container fluid fill-height>

    <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">

            <cadastrarusuario-form senha-tam-min="{{ $senha_min }}" nome="{{ old('nome') }}" email="{{ old('email') }}" > </cadastrarusuario-form>

        </v-col>
    </v-row>

</v-container>
@endsection
