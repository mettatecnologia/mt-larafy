<template>
<div>
    
    <jb-datatable-crud
        titulo-novo="Nova Config"
        titulo-editar="Editar Config"

        :items="datatable.itens"
        :headers="datatable.headers"
        :pagination="datatable.pagination"
        disable-initial-sort

        dialog-persistent
        dialog-mostrar
        dialog-max-width="500px"

        :vueapiquery-model="ModelConfig"
        v-model="config"

    >
        <template slot="form">
            <v-layout>
                <v-flex xs12 md12>
                    <jb-text v-model="config.nome" name="nome" regras="required" label="Nome" :hint="'Nome interno: ' + (config.nome_interno || '')" persistent-hint ></jb-text>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex xs12 md12>
                    <jb-text v-model="config.valor" name="valor" regras="required" label="Valor" ></jb-text>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex xs12 md12>
                    <jb-textarea v-model="config.descricao" name="descricao" label="Descrição" ></jb-textarea>
                </v-flex>
            </v-layout>
            
            <v-layout justify-end>
                <v-flex xs12 md2>
                    <v-switch v-model="config.ativo" name="ativo" :label="config.ativo?'Ativo':'Inativo'"></v-switch>
                </v-flex>
            </v-layout>

            <jb-loading :esta-carregando="loading.mostrar"></jb-loading>

        </template>
    </jb-datatable-crud>

</div>
</template>


<script>

import Config from '@/models/Config'

export default {
    
    props:{
        configs:Array,
        mensagens:String, mensagensTipo:String,
    },
    data() { return {
        config:{id:null,nome:null,nome_interno:null,descricao:null,valor:null,ativo:true},
        ModelConfig: new Config(this.config),
        loading:{
            mostrar:false
        },
        form:{
            valid:false,
        },
        datatable:{
            search:'',
            pagination: { sortBy: 'nome', },
            itens:[],
            headers: [
                { text: 'Nome', value: 'nome', align:'center' },
                { text: 'Nome interno', value: 'nome_interno', align:'center' },
                { text: 'Valor', value: 'valor', align:'center' },
                { text: 'Ações', value: 'acoes', align:'center', sortable:false, onlyheader:true },
            ],
        },
    }},
    created () {
        this.datatable.itens = JSON.parse(this.configs)
    },
    watch:{
        'config.nome'(v){
            if(v){
                v = v.trim().split(' ').join('_').toLowerCase()
                v = this.$removerAcentos(v)
            }
            this.config.nome_interno = v   
        }
    }
}
</script>
