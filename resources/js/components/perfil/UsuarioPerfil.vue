<template>
<div>

    <v-tabs v-model="tabs.index" color="primary" dark grow >
        <v-tab> <v-icon class="mr-1">fa-id-card</v-icon> Dados </v-tab>
        <v-tab> <v-icon class="mr-1">fa-lock</v-icon> Senha </v-tab>

        <v-tabs-slider color="yellow"></v-tabs-slider>
    </v-tabs>

    <v-tabs-items v-model="tabs.index" style="border:1px solid #EEE">
        <v-tab-item>
            <v-layout justify-center>
                <v-flex xs12 md12>
                    <alterardados-form
                        :perfil="perfil"
                    > </alterardados-form>
                </v-flex>
            </v-layout>
        </v-tab-item>


        <v-tab-item class="pa-3">

            <v-layout justify-center>
                <v-flex xs12 md8>
                    <alterarsenha-form senha-tam-min = 4 > </alterarsenha-form>
                </v-flex>
            </v-layout>

        </v-tab-item>
    </v-tabs-items>

</div>
</template>


<script>

export default {

    props:{
        perfil:String,
    },
    data() {return {
        tabs: {
            index: 0
        },
    }},
}
</script>
