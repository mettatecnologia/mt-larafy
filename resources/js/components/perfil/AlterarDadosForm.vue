<template>
<div>

    <v-card>
        <v-card-text class="pt-1">
                <jb-form v-model="form.valid" ref="form" btn-enviar-text="Atualizar" validar :mensagens="form.mensagens.mensagens" :mensagens-tipo="form.mensagens.tipo" :mensagens-detalhes="form.mensagens.detalhes" @submit="alterarPerfil" :reset-validation="form.resetValidation">
                    <jb-loading v-model="loading.mostrar"></jb-loading>

                    <v-row justify="space-between">
                        <v-col cols="12" class="px-1">
                            <jb-text autofocus v-model="pessoa.nome" name="nome" regras="required" label="Nome" ></jb-text>
                        </v-col>
                    </v-row>

                    <v-row justify="start">
                        <v-col cols="12" md="5" class="px-1">
                            <jb-text-datetime v-model="pessoa.dtanascimento" name="dtanascimento" label="Data de nascimento" regras="required" ></jb-text-datetime>
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
                            <jb-text v-model="pessoa.email" name="email" regras="email|email-unique:url=verificar-email-perfil" label="Email"  ></jb-text>
                        </v-col>
                        <v-col cols="12" md="6" class="px-1">
                            <jb-text v-model="pessoa.telefone" name="telefone" regras="required" label="Telefone" mascara="telefone" ></jb-text>
                        </v-col>
                    </v-row>

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
            pessoa:{id:null,nome:null,email:null,ativo:true,dtanascimento:null,logradouro_tipo:'Rua',logradouro:null,logradouro_numero:null,bairro:null,telefone:null,},
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
        Object.assign(this.pessoa, JSON.parse(this.perfil))
    },
    methods: {
        alterarPerfil(){
            this.loading.mostrar = true

            this.ModelPerfil
                .preparaItem(this.pessoa)
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
