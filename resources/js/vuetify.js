import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';

Vue.use(Vuetify);

export default new Vuetify({
    iconfont: 'mdi',
    theme:{
        themes:{
            dark:{
                primary:'#49D9A0',
                background:'#FAFAFA'
            }
        },
        light:{
            primary:'#49D9A0',
        }
    }
});

