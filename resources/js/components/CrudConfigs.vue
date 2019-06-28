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
        dialog-max-width="500px"

        :vueapiquery-model="ModelConfig"
        v-model="config"

        :pre-novo="preNovo"
        :pre-editar="preEditar"

    >
        <template slot="form">
            <v-layout>
                <v-flex v-if="form.mostrar_campo_nome" xs12 md12>
                    <jb-text v-model="config.nome" name="nome" regras="required" label="Nome" :hint="'Nome interno: ' + (config.nome_interno || '')" persistent-hint ></jb-text>
                </v-flex>
                <v-flex v-else xs12 md12  class="mb-3 font-weight-bold">
                    <span>Nome: {{config.nome}}</span>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex xs12 md12>
                    <jb-textarea v-model="config.descricao" name="descricao" label="Descrição" rows="3" ></jb-textarea>
                </v-flex>
            </v-layout>

            <v-layout> <span class="title font-italic grey--text">Valores</span>  </v-layout>

            <template v-for="(item, key) in config.valores">
                <v-layout :key="key">
                    <v-flex xs12 md10>
                        <jb-text v-model="config.valores[key]" name="valor" label="Valor" regras="required" />
                    </v-flex>
                    <v-flex xs12 md1>
                        <v-btn small color="primary" @click="addValor(key)"><v-icon small>add</v-icon></v-btn>
                    </v-flex>
                    <v-flex xs12 md1>
                        <v-btn v-if="config.valores.length>1" small color="red" dark @click="remValor(key)"><v-icon small>remove</v-icon></v-btn>
                    </v-flex>
                </v-layout>
            </template>


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
        config:{id:null,nome:null,nome_interno:null,descricao:null, ativo:true, valores:[null]},
        ModelConfig: new Config({}),
        loading:{
            mostrar:false
        },
        form:{
            valid:false,
            mostrar_campo_nome:true,
        },
        datatable:{
            search:'',
            pagination: { sortBy: 'nome', },
            itens:[],
            headers: [
                { text: 'Nome', value: 'nome', align:'center' },
                { text: 'Valores', value: 'valores', align:'center', metodo: v => {
                    let result = v.filter(function (el) { return el != null;});
                    return result.length > 0 ? v.join(', ') : null
                }},
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
    },
    methods:{
        preEditar(item){
            this.form.mostrar_campo_nome = false
            return item
        },
        preNovo(){
            this.config.valores = ['']
            this.form.mostrar_campo_nome = true
        },
        addValor(index){
            this.config.valores.splice(index+1, 0,'')
        },
        remValor(index){
            this.config.valores.splice(index, 1)
        },

    }
}
</script>
