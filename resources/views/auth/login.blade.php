@extends('layouts.app')

@section('content')
<v-container fluid fill-height>

    <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">

            <login-form esqueci-senha-href="{{ route('password.request') }}" registrar-href="{{ route('register') }}"></login-form>

        </v-col>
    </v-row>

</v-container>
@endsection
