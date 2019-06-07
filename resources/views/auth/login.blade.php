@extends('layouts.app')

@section('content')
<v-container fluid fill-height>

    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>

            <login-form esqueci-senha-href="{{ route('password.request') }}" registrar-href="{{ route('register') }}"></login-form>

        </v-flex>
    </v-layout>

</v-container>
@endsection
