<template>
    <div class="w-100">
        <h5 class="text-center">Tampilan Persyaratan Dokumen</h5>
        <hr>
        <div class="form-group px-5">
            <label>Jenis Dokumen</label>
            <select @change="changeDoc" class="form-control" v-model="docType">
                <option value="E-KTP">E-KTP</option>
                <option value="KK">KK</option>
                <option value="KIA">KIA</option>
                <option value="AKTA_LAHIR">Akta Lahir</option>
                <option value="AKTA_KEMATIAN">Akta Kematian</option>
            </select>

            <froala
                class="my-5"
                :config="froalaConfig"
                v-model="froalaText"/>

            <froalaView class="py-5 border border-dark mb-3" v-model="froalaText"/>
            <div class="d-flex justify-content-center">
                <button @click="submitChange" class="btn btn-sm btn-primary" type="button">Submit</button>
            </div>
        </div>

    </div>
</template>
<script>
import {get} from 'lodash'
import {confirmationModal, errorModal, successModal} from '../../../helper'
export default {
    props : [
        "requirements", "submit_url"
    ],
    data(){
        return {
            docType : 'E-KTP',
            froalaText : get(this.requirements['E-KTP'], 'description', '')
        }
    },
    methods : {
        get,
        changeDoc(){
            this.froalaText = get(this.requirements[this.docType], 'description', '');
        },
        submitChange(){
            confirmationModal()
                .then(ok => {
                    if(ok.isConfirmed){
                        axios.post(this.submit_url, this.formData)
                            .then(response => {
                                successModal({title : 'Data Berhasil Diperbaharui'})
                                    .then(ok => {
                                        if(ok.isConfirmed) location.reload();
                                        if(ok.isDismissed) location.reload();
                                    })
                            })
                            .catch(err => {
                                errorModal();
                            });
                    }
                });
        }
    },
    computed : {
        froalaConfig(){
            return {
                placeholderText : "Deskripsikan Persyaratan Dokumen",
                toolbarButtons : {
                    'moreText': {
                        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
                    },
                    'moreParagraph': {
                        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
                    },
                    'moreRich': {
                        'buttons': [
                            'insertLink', 'insertTable', 'fontAwesome', 'specialCharacters', 'embedly', 'insertHR'
                        ],

                    },
                    'moreMisc': {
                        'buttons': ['fullscreen', 'selectAll'],
                        'align': 'right',
                        'buttonsVisible': 0
                    }
                },
                quickInsertButtons : ["ul", "ol", "hr"],

            };
        },
        formData(){
            return {
                document_type : this.docType,
                description : this.froalaText
            };
        }
    }
}
</script>
