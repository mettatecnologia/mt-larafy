<template>
<div>

    <jb-datatable-crud
        titulo-novo="Nova Pessoa"
        titulo-editar="Editar Pessoa"

        :items="datatable.itens"
        :headers="datatable.headers"

        :pagination="datatable.pagination"

        dialog-persistent

        :vueapiquery-model="ModelPessoa"
        v-model="pessoa"

        ref="jb-datatable-crud"

    >
        <template v-slot:form>
            <jb-loading v-model="loading.mostrar"></jb-loading>

            <v-row justify="space-between">
                <v-col cols="12" class="px-1">
                    <jb-text autofocus v-model="pessoa.nome" regras="required" label="Nome" name="nome" ></jb-text>
                </v-col>
            </v-row>

            <v-row justify="start">
                <v-col cols="12" md="4" class="px-1">
                    <jb-text-datetime v-model="pessoa.dtanascimento" name="dtanascimento" label="Data de nascimento" regras="required" historic></jb-text-datetime>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="2" class="px-1">
                    <jb-cmb-logradourotipo v-model="pessoa.logradouro_tipo" name="logradouro_tipo" label="Tipo"></jb-cmb-logradourotipo>
                </v-col>
                <v-col cols="12" md="5" class="px-1">
                    <jb-text v-model="pessoa.logradouro" name="logradouro" regras="required" label="Logradouro" ></jb-text>
                </v-col>
                <v-col cols="12" md="2" class="px-1">
                    <jb-text v-model="pessoa.logradouro_numero" name="logradouro_numero" regras="required" mascara='integer' label="Numero" ></jb-text>
                </v-col>
                <v-col cols="12" md="3" class="px-1">
                    <jb-text v-model="pessoa.bairro" name="bairro" regras="required" label="Bairro" ></jb-text>
                </v-col>
            </v-row>

            <v-row justify="space-between">
                <v-col cols="12" md="6" class="px-1">
                    <jb-text-email v-model="pessoa.email" regras="required" :unique="{ignore_id: pessoa.id}" ></jb-text-email>
                </v-col>
                <v-col cols="12" md="6" class="px-1">
                    <jb-text v-model="pessoa.telefone" name="telefone" regras="required" label="Telefone" mascara="telefone" ></jb-text>
                </v-col>
            </v-row>

            <v-row justify="end">
                <v-col cols="12" md="2">
                    <v-switch v-model="pessoa.ativo" name="ativo" :label="pessoa.ativo?'Ativo':'Inativo'"></v-switch>
                </v-col>
            </v-row>
        </template>

        <template v-slot:item.prepend-actions="{ item, header, value }" >
            <jb-icon small :color="dadosActionIconeUsuario(item)['cor']" :tt-text="item.usuario.id ? 'Alterar usuario' : 'Conceder usuario'" @click="abrirAcesso(item)" > {{dadosActionIconeUsuario(item)['icone']}}  </jb-icon>
        </template>

    </jb-datatable-crud>

    <jb-dialog v-model="usuario.dialog.mostrar" persistent titulo="Gerenciar Acesso" max-width="500px">
        <jb-loading v-model="usuario.loading.mostrar"></jb-loading>

        <jb-form v-model="usuario.form.valid" ref="form" validar :pode-limpar="false" :mensagens="usuario.form.mensagens.mensagens" :mensagens-tipo="usuario.form.mensagens.tipo" :mensagens-detalhes="usuario.form.mensagens.detalhes" @submit="alterarAcesso" :resetValidation="usuario.form.reset_validation">

                <jb-select v-model="usuario.form.campos.papel" :items="usuario.form.papeis" regras="required" label="Papel" ></jb-select>

                <jb-text
                    v-model="usuario.form.campos.email"
                    name="email"
                    regras="required|email"
                    label="Email"
                    :disabled="!!usuario.form.campos.email"
                ></jb-text>

                <jb-text-password
                    v-if="usuario.form.exibir_password"
                    v-model="usuario.form.campos.password"
                    name="senha"
                    :regras="['required',{min:4}]"
                    label="Senha"
                ></jb-text-password>

                <jb-text-password
                    v-if="usuario.form.exibir_password"
                    v-model="usuario.form.campos.password_confirmation"
                    name="senha_confirmacao"
                    :regras="['required',{match:'senha'}]"
                    label="Confimar Senha"
                ></jb-text-password>

                <v-row justify="end">
                    <v-col cols="12" md="3">
                        <v-switch v-model="usuario.form.campos.ativo" name="ativo" :label="usuario.form.campos.ativo?'Ativo':'Inativo'"></v-switch>
                    </v-col>
                </v-row>

        </jb-form>

    </jb-dialog>

</div>
</template>


<script>

import Pessoa from '@/models/Pessoa'

export default {

    props:{
        pessoas:Array,
        papeis:Array,
    },
    data() {
        return {
            pessoa:{id:null,nome:null,email:null,ativo:true,dtanascimento:null,logradouro_tipo:'Rua',logradouro:null,logradouro_numero:null,bairro:null,telefone:null,papel:'USR', usuario:[]},
            ModelPessoa: new Pessoa({}),
            loading:{
                mostrar:false
            },
            form:{
                valid:false,
                reset_validation:false,
                logradourotipo:'Rua',
                uf: null,
                cidade:160005,
            },
            datatable:{
                search:'',
                pagination: { sortBy: 'nome_razao', },
                itens:[],
                headers: [
                    { text: '#', value: 'id', align:'center', class:'text-center' },
                    { text: 'Nome', value: 'nome', align:'center', class:'text-center' },
                    { text: 'Nascimento', value: 'dtanascimento', align:'center', class:'text-center', formato:'date' },
                    { text: 'Email', value: 'email', align:'center', class:'text-center' },
                    { text: 'Ativo', value: 'ativo', align:'center', class:'text-center' },
                    { text: 'Ações', value: 'actions', align:'center', class:'text-center', sortable:false, onlyheader:true },
                ],
            },
            usuario:{
                index:null,
                dialog:{
                    mostrar:false
                },
                form: {
                    papeis:[],
                    exibir_password:true,
                    valid: false,
                    reset_validation:false,
                    mensagens:{
                        mensagens:null,
                        tipo:null,
                        detalhes:null,
                    },
                    campos:{pessoa_id:null, papel:'USR', email:null, password:null, password_confirmation:null, ativo:1},

                },
                loading:{
                    mostrar:false
                },
            },
        }
    },
    created () {
        this.datatable.itens = this.pessoas
        this.usuario.form.papeis = this.papeis
    },
    watch:{
        'form.cidade'(cidade){
            this.pessoa.cidade_cod = cidade
        },
    },
    methods:{
        dadosActionIconeUsuario(item){
            let cor = 'grey'
            let icone = 'mdi-account-check'
            if(item.usuario.id){
                if(item.usuario.ativo){
                    cor = 'green'
                }
                else {
                    cor = 'red'
                }
            }
            else {
                cor = 'grey lighten-1'
                icone = 'mdi-account-plus'
            }
            return {
                cor:cor,
                icone:icone
            }
        },
        abrirAcesso(item){
            this.usuario.index = this.$buscarItemDatatable(this.datatable.itens, item.id, 'id').index
            this.usuario.form.exibir_password = !item.usuario.id

            if(item.usuario.id){
                this.usuario.form.campos.papel = item.papel
                this.usuario.form.campos.ativo = item.usuario.ativo
            }

            this.usuario.form.campos.pessoa_id = item.id
            this.usuario.form.campos.email = item.email
            this.usuario.dialog.mostrar = true


        },
        fecharAcesso(){
            this.usuario.index = null
            this.usuario.form.reset_validation = true

            this.usuario.form.campos.pessoa_id = null
            this.usuario.form.campos.papel = 'USR'
            this.usuario.form.campos.email = null
            this.usuario.form.campos.password = null
            this.usuario.form.campos.password_confirmation = null

            this.usuario.dialog.mostrar = false
        },
        alterarAcesso(){
            this.usuario.loading.mostrar = true

            this.ModelPessoa
                .alterarAcesso(this.usuario.form.campos)
                .then(v => {

                    this.usuario.loading.mostrar = false
                    let response = v.__response

                    if(response.erro){
                        this.form.mensagens = this.$criarObjetoMensagensForm(response.mensagens[0], response.mensagens_tipo);
                        this.loading.mostrar = false
                    }
                    else {
                        this.$dialog.message.success(response.mensagens.join('-'), {timeout: 5000});
                        this.datatable.itens[this.usuario.index].usuario.id = response.dados ? response.dados.id : null
                        this.datatable.itens[this.usuario.index].usuario = response.dados
                        this.fecharAcesso()
                    }

                });
        }
    },
}
</script>
