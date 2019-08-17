/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

window.Vue = require('vue');
let Vue = window.Vue

import '@fortawesome/fontawesome-free/css/all.css'

//============== VUETIFY
import 'vuetify/dist/vuetify.min.css'
import Vuetify from 'vuetify'
import pt from 'vuetify/lib/locale/pt'
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify)

const vuetify_opts = {
    lang: {
        locales: { 'pt': pt },
        current: 'pt'
    },
    theme: {
        light: true,
        themes:{
            light:{
                primary: colors.blue.darken2,
                secondary: colors.grey.darken3,
                accent: colors.blue.darken2,
                error: colors.red.accent2,
                warning: colors.amber.base,
                info: colors.blue.base,
                success: colors.green.base
            }
        }
    }
}

const vuetify = new Vuetify(vuetify_opts);

//============== VUETIFY-DIALOG
import VuetifyDialog from "vuetify-dialog";
import "vuetify-dialog/dist/vuetify-dialog.min.css";
Vue.use(VuetifyDialog, { context: {  vuetify } });
window.Vue.$_vuetifydialog_installed = true


/**
 ================= COMPONENTES
 */
require('./../../metta/js/components'); //ativar quando for desenvolver os componentes da metta
// require('@/registros/metta');
require('@/registros/_partes');
require('@/registros/perfil');
require('@/registros/outros');

/**
 * Uncomment below when compiling to production
 */
Vue.config.devtools = false
Vue.config.debug = false
Vue.config.silent = true

const app = new Vue({
    el: '#app',
    vuetify,
    mounted() {
        document.getElementById('app').style.display = "block"
    },
})
