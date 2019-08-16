@extends('layouts.app')

@section('content')
<v-container fluid fill-height>

    <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="6">

            <resetarsenha-form token="{{$token}}"></resetarsenha-form>

        </v-col>
    </v-row>

</v-container>
@endsection

