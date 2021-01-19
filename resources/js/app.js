import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import vSelect from 'vue-select'
import VueSelectImage from 'vue-select-image'
import 'vue-select/dist/vue-select.css';
import imageCropper from 'vue-image-crop-upload';
import { ToggleButton } from 'vue-js-toggle-button'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import './custom.scss'

import draggable from 'vuedraggable'

require('vue-select-image/dist/vue-select-image.css')
require('./bootstrap');
window.Vue = require('vue');




Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.component('draggable', require('./components/ExampleComponent.vue').default);


Vue.component('example-component', draggable);
Vue.component('field-table', require('./components/FieldTable.vue').default);
Vue.component('form-view', require('./components/FormView.vue').default);
Vue.component('form-fields', require('./components/FormFields/Index').default);
Vue.component('options-table', require('./components/OptionsTable.vue').default);
Vue.component('v-select', vSelect)
Vue.component('vue-select-image', VueSelectImage)
Vue.component('image-crop', imageCropper)
Vue.component('ToggleButton', ToggleButton)












const app = new Vue({
    el: '#main',
    components: { VueSelectImage }
});
