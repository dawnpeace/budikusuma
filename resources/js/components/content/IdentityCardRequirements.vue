<template>
    <div>
        <h5>Deskripsikan Persyaratan Dokument E-KTP</h5>
        <hr>
        <form @submit.prevent="submitForm">
            <froala :tag="'textarea'" :config="config" v-model="editor"></froala>
            <div class="d-flex justify-content-end mt-3">
                <button :click="submitForm" class="btn btn-sm btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import VueFroala from 'vue-froala-wysiwyg'
import get from 'lodash'
export default {
    props : [
        "submit_url", "redirect_url", "current_data"
    ],
    data(){
        return {
            config : {
                placeholderText : "Deskripsikan Persyaratan Dokumen",
                pluginsEnabled: ["lists"]
            },
            editor : this.current_data ?? ""
        }
    },
    methods : {
        submitForm(){
            axios.post(
                this.submit_url, this.formData
            ).then(response => {
                window.location.replace(this.redirect_url);
            }).catch(e => {
                console.log(e);
            });
        }
    },
    computed : {
        formData(){
            return {
                data : this.editor
            }
        }
    }
}
</script>