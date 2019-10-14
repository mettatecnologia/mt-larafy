<template>
<div>
    <jb-loading v-model="loading.mostrar"></jb-loading>

    <jb-form v-model="form.valid" ref="form" validar :pode-limpar="false" :mensagens="form.mensagens.mensagens" :mensagens-tipo="form.mensagens.tipo" :mensagens-detalhes="form.mensagens.detalhes" @submit="alterarAcesso" :resetValidation="form.reset_validation">

            <jb-select v-model="dados.papel" :items="papeis" regras="required" label="Papel" ></jb-select>

            <jb-text-email
                v-model="email"
                regras="required"
                :disabled="!!email"
                unique
            ></jb-text-email>

            <jb-text-password
                v-if="exibir_password"
                v-model="dados.password"
                name="senha"
                :regras="['required',{min:4}]"
                label="Senha"
            ></jb-text-password>

            <jb-text-password
                v-if="exibir_password"
                v-model="dados.password_confirmation"
                name="senha_confirmacao"
                :regras="['required',{match:'senha'}]"
                label="Confimar Senha"
            ></jb-text-password>

            <v-row justify="end">
                <v-col cols="12" md="3">
                    <v-switch v-model="dados.ativo" name="ativo" :label="dados.ativo?'Ativo':'Inativo'"></v-switch>
                </v-col>
            </v-row>

    </jb-form>

</div>
</template>


<script>

import Pessoa from '@/models/Pessoa'

export default {

    props:{
        value: Number,
        pessoa_id: Number,
        papeis: Array,
        email: String,
    },
    data() { return {
        ModelPessoa: new Pessoa({}),
        exibir_password:true,
        id:this.value,
        dados:{
            papel:'USR',
            pessoa_id:null,
            password:null,
            password_confirmation:null,
            ativo:1,
        },
        loading:{
            mostrar:false
        },
        form:{
            valid: false,
            reset_validation:false,
            mensagens:{
                mensagens:null,
                tipo:null,
                detalhes:null,
            },
        },
    }},
    created(){
        this.dados.pessoa_id = this.pessoa_id
    },
    methods:{
        emitInput(v){
            this.$emit('input',v)
        },
        alterarAcesso(){
            this.loading.mostrar = true

            this.ModelPessoa
                .alterarAcesso(this.dados)
                .then(v => {

                    this.loading.mostrar = false
                    let response = v.__response

                    if(response.erro){
                        this.form.mensagens = this.$criarObjetoMensagensForm(response.mensagens[0], response.mensagens_tipo);
                        this.emitInput(null)
                    }
                    else {
                        this.$dialog.message.success(response.mensagens.join('-'), {timeout: 5000});
                        this.emitInput(response.dados.id)
                    }
                });
        }
    },


}
</script>
