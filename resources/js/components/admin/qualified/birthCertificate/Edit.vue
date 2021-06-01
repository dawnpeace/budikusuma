<template>
    <div>
        <h5 class="text-center mt-3 mb-5">Akta Kelahiran Terkualifikasi</h5>
        <div class="table-responsive">
            <table class="table table-sm table-borderless">
                <tr>
                    <th class="text-right" width="33%">
                        No. Akta
                    </th>
                    <td>
                        {{ card.id_card }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nama Anak
                    </th>
                    <td>
                        {{ card.name }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Jenis Kelamin
                    </th>
                    <td class="text-capitalize">
                        {{ card.gender }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Tempat Lahir
                    </th>
                    <td class="text-capitalize">
                        {{ card.birthplace }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Tanggal Lahir
                    </th>
                    <td>
                        {{ moment(card.birthdate).format('DD-MM-YYYY') }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        No KTP Ibu
                    </th>
                    <td class="text-capitalize">
                        {{ card.mother_identity_card_number }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nama Ibu
                    </th>
                    <td class="text-capitalize">
                        {{ card.mother_name }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        No KTP Ayah
                    </th>
                    <td class="text-capitalize">
                        {{ card.father_identity_card_number }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nama Ayah
                    </th>
                    <td class="text-capitalize">
                        {{ card.father_name }}
                    </td>
                </tr>

            </table>
            <div class="d-flex justify-content-center">
                <button @click="submitArchieve" class="btn btn-sm btn-primary" type="button">Arsipkan Dokumen</button>
                <a class="btn btn-info btn-sm mx-1" :href="this.media_url">Download Dokumen Pendukung</a>
            </div>
        </div>
    </div>
</template>
<script>
import { get, cloneDeep } from 'lodash'
import moment from 'moment'
import {confirmationModal, errorModal, successModal} from '../../../../helper'
export default {
    props : [
        "card", "redirect_url", "submit_url", "media_url"
    ],
    data(){
        return {
            errors : null,
            formData : {
                ...this.card,
                birthdate : new Date(this.card.birthdate)
            },
            disableSubmit : false,
        }
    },
    computed :{
        form(){
            let birthdate = cloneDeep(this.formData.birthdate);
            return {
                ...this.formData,
                birthdate : moment(birthdate).format('DD-MM-YYYY')
            }
        }
    },
    methods : {
        get,
        cloneDeep,
        moment,
       submitArchieve(){
            confirmationModal()
                .then(ok => {
                    if(ok.isConfirmed){
                        axios.post(this.submit_url)
                            .then(response => {
                                successModal({
                                    title : "Data berhasil diarsipkan",
                                    onClose : () => {
                                        location.replace(this.redirect_url);
                                    }
                                });
                            })
                            .catch(err => {
                                let statusCode = err.response.status;
                                switch(statusCode){
                                    case 400 :
                                        errorModal({title : err.response.data});
                                        break;
                                    case 401:
                                    case 403:
                                        errorModal({title : "Terjadi Kesalahan"});
                                        break;
                                    case 500:
                                        errorModal({title : "Internal Server Error"});
                                        break;
                                }
                            });
                    }
                })

        }
    }
}
</script>
