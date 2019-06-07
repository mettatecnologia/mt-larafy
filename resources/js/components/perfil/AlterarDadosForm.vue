<template>
<div>

    <v-card>
        <v-card-text class="pt-1">
                <jb-form v-model="form.valid" ref="form" btn-enviar-text="Atualizar" validar :mensagens="form.mensagens.mensagens" :mensagens-tipo="form.mensagens.tipo" :mensagens-detalhes="form.mensagens.detalhes" @submit="alterarPerfil" :reset-validation="form.resetValidation">
                    <jb-loading v-model="loading.mostrar"></jb-loading>

                    <v-layout justify-space-between row wrap>
                        <v-flex xs12 md12 class="px-1">
                            <jb-text autofocus v-model="usuario.nome" name="nome" regras="required" label="Nome" ></jb-text>
                        </v-flex>
                    </v-layout>

                    <v-layout justify-start>
                        <v-flex xs12 md5 class="px-1">
                            <jb-text-datetime v-model="usuario.dtanascimento" name="dtanascimento" label="Data de nascimento" regras="required" ></jb-text-datetime>
                        </v-flex>
                    </v-layout>

                    <v-layout row wrap>
                        <v-flex xs12 md2 class="px-1">
                            <jb-cmb-logradourotipo v-model="usuario.logradouro_tipo" name="logradouro_tipo" label="Tipo"></jb-cmb-logradourotipo>
                        </v-flex>
                        <v-flex xs12 md5 class="px-1">
                            <jb-text v-model="usuario.logradouro" name="logradouro" regras="required" label="Logradouro" ></jb-text>
                        </v-flex>
                        <v-flex xs12 md2 class="px-1">
                            <jb-text v-model="usuario.logradouro_numero" name="logradouro_numero" regras="required" mascara='integer' label="Numero" ></jb-text>
                        </v-flex>
                        <v-flex xs12 md3 class="px-1">
                            <jb-text v-model="usuario.logradouro_bairro" name="logradouro_bairro" regras="required" label="Bairro" ></jb-text>
                        </v-flex>
                    </v-layout>

                    <v-layout justify-space-between row wrap>
                        <v-flex xs12 md6 class="px-1">
                            <jb-text v-model="usuario.email" name="email" regras="email|email-unique:verificar-email-perfil" label="Email"  ></jb-text>
                        </v-flex>
                        <v-flex xs12 md6 class="px-1">
                            <jb-text v-model="usuario.telefone" name="telefone" regras="required" label="Telefone" mascara="telefone" ></jb-text>
                        </v-flex>
                    </v-layout>

                </jb-form>
        </v-card-text>
    </v-card>
</div>
</template>

<script>

import Perfil from './Perfil'

export default {
    props: {
        perfil:String,
    },
    data() {return {
            usuario:{id:null,nome:null,email:null,ativo:true,dtanascimento:null,logradouro_tipo:'Rua',logradouro:null,logradouro_numero:null,logradouro_bairro:null,telefone:null,},
            ModelPerfil: new Perfil({}),
            form: {
                valid: false,
                resetValidation:false,
                mensagens:{
                    mensagens:null,
                    tipo:null,
                    detalhes:null,
                },
            },
            loading:{
                mostrar:false
            },
    }},
    created(){
        Object.assign(this.usuario, JSON.parse(this.perfil))
    },
    methods: {
        alterarPerfil(e, validate){
            this.loading.mostrar = true

            this.ModelPerfil
                .preparaItem(this.usuario)
                .createAndSave()
                .then(v => {

                    this.loading.mostrar = false
                    let response = v.__response

                    if(response.erro){
                        this.form.mensagens = this.$criarObjetoMensagensForm(response.mensagens[0], response.mensagens_tipo, response.exception);
                        this.loading.mostrar = false
                    }
                    else {
                        this.$dialog.message.success(response.mensagens.join('-'), {timeout: 5000});
                    }
                });

        }
    },
}

</script>
