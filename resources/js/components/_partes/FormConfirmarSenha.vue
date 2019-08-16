<template>
<div>
    <jb-loading v-model="loading.mostrar"></jb-loading>
    <v-card>
        <v-card-title> <span class="headline">{{titulo}}</span> </v-card-title>

        <jb-alerta v-model="vmodel.alerta.mensagens" :tipo="vmodel.alerta.color" :tooltip="vmodel.alerta.detalhes" />

        <v-card-text>

            <jb-form v-model="form.valid" ref="form" validar :resetValidation="form.reset_validation" cancelar-submit>
                <v-row>
                    <v-col cols="12" class="px-1 mr-3">
                        <jb-text type="password" autofocus v-model="vmodel.senha" label="Senha" ></jb-text>
                    </v-col>
                </v-row>

                <v-card-actions slot="botoes">
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="fechar()">Cancelar</v-btn>
                    <v-btn color="primary" text @click="confirmarSenha()" :disabled="!vmodel.senha">Confirmar</v-btn>
                </v-card-actions>

            </jb-form>

        </v-card-text>

    </v-card>


</div>
</template>


<script>

import axios from 'axios'

export default {

    props:{
        value:Object,
        titulo:{type:String, default:'Digite sua senha'},
    },
    created () {
    },
    data() {
        return {
            dados:{
                senha:null,
                pessoa_id:null,
                abrir:false,
                senhaconfirmada:null,
                alerta:{
                    mensagens:[],
                    color:null,
                    detalhes:null,
                }
            },
            form:{
                valid:null,
                reset_validation:false
            },
            loading:{
                mostrar:false
            }

        }
    },
    computed: {
        vmodel(){
            return this.value || this.dados
        }
    },
    methods:{
        fechar(){
            this.vmodel.abrir = false
        },
        confirmarSenha(){
            this.loading.mostrar = true

            let dados = {
                pessoa_id: this.vmodel.pessoa_id,
                senha: this.vmodel.senha,
            }

            axios.post(`validar-senha`,dados)
            .then(v => {
                let response = v.data.__response

                this.vmodel.senhaconfirmada = false
                if(response.erro){
                    this.$dialog.error({
                        title: 'Alerta!',
                        text: 'Falha ao validar a senha, entre em contato com a FideliCred',
                        actions: [{
                            text: 'Ok'
                        }]
                    });
                }
                else {
                    this.vmodel.senha = null
                    if(response.dados.senha_certa){
                        this.vmodel.senhaconfirmada = true
                    }
                    else {
                        this.$dialog.error({
                            title: 'Alerta!',
                            text: 'A senha digitada está incorreta',
                            actions: [{
                                text: 'Ok'
                            }]
                        });

                    }
                }
            })
            .finally(() => (this.loading.mostrar = false))
        },

    },
    watch:{
        'vmodel.abrir'(abrir){
            if( ! abrir ){
                this.vmodel.senha = null
            }
        }
    },
    mounted(){
    }
}
</script>
