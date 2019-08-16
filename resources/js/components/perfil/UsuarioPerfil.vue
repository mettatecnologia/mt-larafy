<template>
<div>

    <v-tabs v-model="tabs.index" background-color="primary" grow >
        <v-tab> <v-icon class="mr-1">fa-id-card</v-icon> Dados </v-tab>
        <v-tab> <v-icon class="mr-1">fa-lock</v-icon> Senha </v-tab>

        <v-tabs-slider color="yellow"></v-tabs-slider>
    </v-tabs>

    <v-tabs-items v-model="tabs.index" style="border:1px solid #EEE">

        <v-tab-item>
            <v-row justify="center">
                <v-col cols="12" md="11">
                    <alterardados-form :perfil="perfil"> </alterardados-form>
                </v-col>
            </v-row>
        </v-tab-item>


        <v-tab-item class="pa-3">

            <v-row justify="center">
                <v-col cols="12" md="8">
                    <alterarsenha-form senha-tam-min = 4 > </alterarsenha-form>
                </v-col>
            </v-row>

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
