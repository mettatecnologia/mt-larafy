<template>
<div>

    <jb-datatable-crud
        titulo-novo="Nova Config"
        titulo-editar="Editar Config"

        :items="datatable.itens"
        :headers="datatable.headers"

        :pagination="datatable.pagination"

        dialog-persistent

        :vueapiquery-model="ModelConfig"
        v-model="config"

        :pre-novo="preNovo"
        :pre-editar="preEditar"

    >
        <template v-slot:form>
            <!-- <v-row justify="end">
                <v-col cols="12" md="2">
                    <v-checkbox v-model="config.multiplo" name="multiplo" label="Múltiplo"></v-checkbox>
                </v-col>
            </v-row> -->

            <v-row>
                <v-col v-if="form.mostrar_campo_nome" cols="12">
                    <jb-text v-model="config.nome" name="nome" regras="required" label="Nome" :hint="'Nome interno: ' + (config.nome_interno || '')" persistent-hint ></jb-text>
                </v-col>
                <v-col v-else cols="12" class="mb-3 font-weight-bold">
                    <span>Nome: {{config.nome}}</span>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12">
                    <jb-textarea v-model="config.descricao" name="descricao" label="Descrição" rows="3" ></jb-textarea>
                </v-col>
            </v-row>

            <v-row> <span class="title font-italic grey--text">Valores</span>  </v-row>

            <v-row justify="end">
                <v-col cols="12" md="2" class="pt-0">
                    <v-checkbox v-model="config.multiplo" name="multiplo" label="Múltiplos" hide-details></v-checkbox>
                </v-col>
            </v-row>

            <template v-for="(item, key) in config.valores">
                <v-row :key="key" no-gutters>
                    <v-col cols="12" md="10">
                        <jb-text v-model="config.valores[key]" name="valor" label="Valor" regras="required" />
                    </v-col>
                    <template v-if="config.multiplo">
                        <v-col cols="12" md="1">
                            <v-btn small color="primary" min-width="30px" @click="addValor(key)"><v-icon small>add</v-icon></v-btn>
                        </v-col>
                        <v-col cols="12" md="1" >
                            <v-btn v-if="config.valores.length>1" small color="red" min-width="30px" dark @click="remValor(key)"><v-icon small>remove</v-icon></v-btn>
                        </v-col>
                    </template>
                </v-row>
            </template>


            <v-row justify="end">
                <v-col cols="12" md="2">
                    <v-switch v-model="config.ativo" name="ativo" :label="config.ativo?'Ativo':'Inativo'"></v-switch>
                </v-col>
            </v-row>

            <jb-loading v-model="loading.mostrar"></jb-loading>

        </template>
    </jb-datatable-crud>

</div>
</template>


<script>

import Config from '@/models/Config'

export default {

    props:{
        configs:Array,
    },
    data() { return {
        config:{id:null,nome:null,nome_interno:null,descricao:null,multiplo:false,ativo:true, valores:[null]},
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
                { text: 'Ações', value: 'actions', align:'center', sortable:false, onlyheader:true },
            ],
        },
    }},
    created () {
        this.datatable.itens = this.configs
    },
    watch:{
        'config.nome'(v){
            if(v){
                v = v.trim().split(' ').join('_').toLowerCase()
                v = this.$removerAcentos(v)
            }
            this.config.nome_interno = v
        },
        'config.multiplo'(v){
            if( ! v){
                let primeiro = this.config.valores[0];
                this.config.valores = []
                this.config.valores.push(primeiro)
            }

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
