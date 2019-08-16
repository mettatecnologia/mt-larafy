<template>
<div>

    <v-card>
        <v-card-text class="py-2">
            <jb-form v-model="form.valid" ref="form" validar :mensagens="form.mensagens.mensagens" :mensagens-tipo="form.mensagens.tipo" :mensagens-detalhes="form.mensagens.detalhes" @submit="mudarSenha" :reset-validation="form.resetValidation">
                <jb-loading v-model="loading.mostrar"></jb-loading>

                <jb-text-password
                    v-model="form.senha_atual"
                    name="senha"
                    label="Senha Atual"
                    :regras="'required'"
                ></jb-text-password>

                <jb-text-password
                    v-model="form.senha_nova"
                    name="senha_nova"
                    :regras="'required|match:senha_confirmacao|min:'+senhaTamMin+'|max:'+senhaTamMax"
                    label="Nova Senha"
                ></jb-text-password>

                <jb-text-password
                    v-model="form.senha_nova_confirmacao"
                    name="senha_confirmacao"
                    regras="required|match:senha_nova"
                    label="Confimar Nova Senha"
                ></jb-text-password>

            </jb-form>
        </v-card-text>
    </v-card>
</div>
</template>

<script>

import Auth from './Perfil'

export default {
    props: {
        senhaTamMin:{type:Number, default:0},
        senhaTamMax:{type:Number, default:0},
    },
    data: function () {
        return {
            ModelAuth: new Auth({}),
            form: {
                valid: false,
                resetValidation:false,
                mensagens:{
                    mensagens:null,
                    tipo:null,
                    detalhes:null,
                },
                senha_atual:null,
                senha_nova:null,
                senha_nova_confirmacao:null,
            },
            loading:{
                mostrar:false
            },
        }
    },
    methods: {
         mudarSenha(){
            this.loading.mostrar = true

            this.ModelAuth
                .mudarSenha(this.form.senha_atual, this.form.senha_nova, this.form.senha_nova_confirmacao)
                .then(v => {

                    this.loading.mostrar = false
                    let response = v.__response

                    if(response.erro){
                        this.form.mensagens = this.$criarObjetoMensagensForm(response.mensagens[0], response.mensagens_tipo);
                        this.loading.mostrar = false
                        this.$dialog.message.error(response.mensagens.join('-'), {timeout: 5000});
                    }
                    else {
                        this.form.senha_atual = null
                        this.form.senha_nova = null
                        this.form.senha_nova_confirmacao = null

                        this.form.resetValidation = true;

                        this.$dialog.message.success(response.mensagens.join('-'), {timeout: 5000});
                    }
                });

        }
    },
    mounted(){

    }
}

</script>
