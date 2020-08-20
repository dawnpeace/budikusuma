/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

// froala
import 'froala-editor/js/plugins.pkgd.min.js';
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';
import 'froala-editor/css/froala_editor.pkgd.min.css';
import VueFroala from 'vue-froala-wysiwyg'
import Datepicker from 'vuejs-datepicker'
Vue.use(VueFroala)
require('./bootstrap');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('side-label', require('./components/base/SideLabelInput.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('requirement-content', require('./components/QueueRequirementContent.vue').default);

Vue.component('content-identity-card', require('./components/content/IdentityCardRequirements.vue').default);
Vue.component('content-family-card', require('./components/content/FamilyCardRequirements.vue').default);
Vue.component('content-child-identity-card', require('./components/content/ChildIdentityCardRequirements.vue').default);
Vue.component('content-birth-certificate', require('./components/content/BirthCertificateRequirements.vue').default);

Vue.component('apply-child-id-card', require('./components/appliance/ApplyChildIdentityCard.vue').default);
Vue.component('apply-birth-certificate', require('./components/appliance/ApplyBirthCertificate.vue').default);
Vue.component('apply-family-card', require('./components/appliance/ApplyFamilyCard.vue').default);
Vue.component('apply-id-card', require('./components/appliance/ApplyIdentityCard.vue').default);

Vue.component('reprint-id-card', require('./components/reprint/ReprintIdentityCard.vue').default);
Vue.component('reprint-family-card', require('./components/reprint/ReprintFamilyCard.vue').default);
Vue.component('reprint-birth-certificate', require('./components/reprint/ReprintBirthCertificate.vue').default);
Vue.component('reprint-child-id-card', require('./components/reprint/ReprintChildIdentityCard.vue').default);

Vue.component('reprint-check', require('./components/reprint/CheckReprint.vue').default);

Vue.component('datepicker', Datepicker);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


var app = new Vue({
    el: '#app',
});
