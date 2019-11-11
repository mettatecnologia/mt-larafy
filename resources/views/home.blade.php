@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-row justify="center" row >
        <div class="display-2 primary--text text-center">
            Bem-vindo ao <span class="font-weight-bold font-italic">{{ config('app.name', 'Laravel') }}</span>,  {{ explode(' ', Auth::user()->nome)[0] }}
        </div>
    </v-row>

</v-container>

<v-container fluid >

    <jb-menublocos :itens="{{json_encode($blocos_menu)}}">
        <div slot="cargas" style="width: 600px">
            <div class="body-1"> Escolha uma opção: </div>
            <v-row>
                <v-col cols="6">
                    <div>
                        <jb-bloco action="cargas/programacao-api" color="orange" icone="fas fa-box">
                            <div class="display-1 font-weight-bold mt-4 pt-3">-</div>
                            <div class="subtitle-1">Programação de API</div>
                        </jb-bloco>
                    </div>
                </v-col>
                <v-col cols="6">
                    <div>
                        <jb-bloco action="cargas/integracao-arquivos" color="blue" icone="fas fa-file-alt">
                            <div class="display-1 font-weight-bold mt-4 pt-3">-</div>
                            <div class="subtitle-1">Integração de arquivos</div>
                        </jb-bloco>
                    </div>
                </v-col>
            </v-row>
        </div>

    </jb-menublocos>

</v-container>




@endsection
