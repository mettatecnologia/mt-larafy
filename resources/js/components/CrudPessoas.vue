<template>
<div>

    <jb-datatable-crud
        titulo-novo="Nova Pessoa"
        titulo-editar="Editar Pessoa"

        :items="datatable.itens"
        :headers="datatable.headers"
        :pagination="datatable.pagination"
        disable-initial-sort

        dialog-persistent

        :vueapiquery-model="ModelPessoa"
        v-model="pessoa"

    >
        <template slot="form">
            <jb-loading v-model="loading.mostrar"></jb-loading>

            <v-layout justify-space-between row wrap>
                <v-flex xs12 md12 class="px-1">
                    <jb-text autofocus v-model="pessoa.nome" name="nome" regras="required" label="Nome" ></jb-text>
                </v-flex>
            </v-layout>

            <v-layout justify-start>
                <v-flex xs12 md4 class="px-1">
                    <jb-text-datetime v-model="pessoa.dtanascimento" name="dtanascimento" tipo="date" label="Data de nascimento" regras="required" ></jb-text-datetime>
                </v-flex>
            </v-layout>

            <v-layout row wrap>
                <v-flex xs12 md2 class="px-1">
                    <jb-cmb-logradourotipo v-model="pessoa.logradouro_tipo" name="logradouro_tipo" label="Tipo"></jb-cmb-logradourotipo>
                </v-flex>
                <v-flex xs12 md5 class="px-1">
                    <jb-text v-model="pessoa.logradouro" name="logradouro" regras="required" label="Logradouro" ></jb-text>
                </v-flex>
                <v-flex xs12 md2 class="px-1">
                    <jb-text v-model="pessoa.logradouro_numero" name="logradouro_numero" regras="required" mascara='integer' label="Numero" ></jb-text>
                </v-flex>
                <v-flex xs12 md3 class="px-1">
                    <jb-text v-model="pessoa.bairro" name="bairro" regras="required" label="Bairro" ></jb-text>
                </v-flex>
            </v-layout>

            <v-layout justify-space-between row wrap>
                <v-flex xs12 md6 class="px-1">
                    <jb-text v-model="pessoa.email" name="email" regras="email-unique" label="Email" ></jb-text>
                </v-flex>
                <v-flex xs12 md6 class="px-1">
                    <jb-text v-model="pessoa.telefone" name="telefone" regras="required" label="Telefone" mascara="telefone" ></jb-text>
                </v-flex>
            </v-layout>

            <v-layout justify-end>
                <v-flex xs12 md2>
                    <v-switch v-model="pessoa.ativo" name="ativo" :label="pessoa.ativo?'Ativo':'Inativo'"></v-switch>
                </v-flex>
            </v-layout>
        </template>

        <template v-slot:actionsExtra="{datatable_props}">
            <jb-icon small :color="dadosActionIconeUsuario(datatable_props.item)['cor']" :tt-text="datatable_props.item.tem_usuario ? 'Alterar usuario' : 'Conceder usuario'" @click="abrirAcesso(datatable_props)" > {{dadosActionIconeUsuario(datatable_props.item)['icone']}}  </jb-icon>
        </template>

    </jb-datatable-crud>

    <jb-dialog v-model="usuario.dialog.mostrar" persistent @fechar="fecharAcesso" titulo="Gerenciar Acesso">
        <jb-loading v-model="usuario.loading.mostrar"></jb-loading>

        <jb-form v-model="usuario.form.valid" ref="form" validar :mensagens="usuario.form.mensagens.mensagens" :mensagens-tipo="usuario.form.mensagens.tipo" :mensagens-detalhes="usuario.form.mensagens.detalhes" @submit="alterarAcesso" :resetValidation="usuario.form.reset_validation">

                <jb-select v-model="usuario.form.campos.papel" :items="usuario.form.papeis" regras="required" label="Papel" ></jb-select>

                <jb-text
                    v-model="usuario.form.campos.email"
                    name="email"
                    regras="required|email"
                    label="Email"
                    :disabled="usuario.form.campos.email"
                ></jb-text>

                <jb-text-password
                    v-if="usuario.form.exibir_password"
                    v-model="usuario.form.campos.password"
                    name="password"
                    :regras="'required|min:4|match:password_confirmation'"
                    label="Senha"
                ></jb-text-password>

                <jb-text-password
                    v-if="usuario.form.exibir_password"
                    v-model="usuario.form.campos.password_confirmation"
                    name="password_confirmation"
                    regras="required|match:password"
                    label="Confimar Senha"
                ></jb-text-password>

                <v-layout justify-end>
                    <v-flex xs12 md2>
                        <v-switch v-model="usuario.form.campos.ativo" name="ativo" :label="usuario.form.campos.ativo?'Ativo':'Inativo'"></v-switch>
                    </v-flex>
                </v-layout>

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
            pessoa:{id:null,nome:null,email:null,ativo:true,dtanascimento:null,logradouro_tipo:'Rua',logradouro:null,logradouro_numero:null,bairro:null,telefone:null,},
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
                    { text: '#', value: 'id', align:'center' },
                    { text: 'Nome', value: 'nome', align:'center' },
                    { text: 'Email', value: 'email', align:'center' },
                    { text: 'Ativo', value: 'ativo', align:'center' },
                    { text: 'Ações', value: 'acoes', align:'center', sortable:false, onlyheader:true },
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
                    campos:{
                        pessoa_id:null,
                        papel:'USR',
                        email:null,
                        password:null,
                        password_confirmation:null,
                        ativo:1,
                    },

                },
                loading:{
                    mostrar:false
                },
            },
        }
    },
    created () {
        this.datatable.itens = JSON.parse(this.pessoas)
        this.usuario.form.papeis = JSON.parse(this.papeis)

    },
    watch:{
        'form.cidade'(cidade){
            this.pessoa.cidade_cod = cidade
        },
    },
    methods:{
        dadosActionIconeUsuario(item){
            let cor = 'grey'
            let icone = 'fa-user-shield'
            if(item.tem_usuario){
                if(item.usuario.ativo){
                    cor = 'green'
                }
                else {
                    cor = 'red'
                    icone = 'fa-user-times'
                }
            }
            else {
                cor = 'grey lighten-1'
                icone = 'fa-user-plus'
            }
            return {
                cor:cor,
                icone:icone
            }
        },
        abrirAcesso(itens){
            this.usuario.form.exibir_password = !itens.item.tem_usuario
            this.usuario.index = itens.index

            if(itens.item.tem_usuario){
                this.usuario.form.campos.papel = itens.item.usuario.papel
                this.usuario.form.campos.ativo = itens.item.usuario.ativo
            }

            this.usuario.form.campos.pessoa_id = itens.item.id
            this.usuario.form.campos.email = itens.item.email
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
        alterarAcesso(e){
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
                        this.datatable.itens[this.usuario.index].tem_usuario = true
                        this.datatable.itens[this.usuario.index].usuario = response.dados
                        this.fecharAcesso()
                    }

                });
        }
    },
}
</script>
