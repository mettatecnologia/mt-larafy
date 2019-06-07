@extends('layouts.app')

@section('content')
<v-container fluid fill-height>
    
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6>
                
            <resetarsenha-form token="{{$token}}"></resetarsenha-form>
            
        </v-flex>
    </v-layout>
    
</v-container>
@endsection

