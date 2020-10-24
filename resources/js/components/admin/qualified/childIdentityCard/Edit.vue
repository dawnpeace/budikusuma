<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Kartu Identitas Anak Terkualifikasi</h5>
        <div class="table-responsive">
            <table class="table table-sm table-borderless">
                <tr>
                    <th class="text-right" width="33%">
                        Nomor Kartu
                    </th>
                    <td>
                        {{ card.card_number }}
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
                        Tempat Lahir
                    </th>
                    <td>
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
                        Jenis Kelamin
                    </th>
                    <td class="text-capitalize">
                        {{ card.gender }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nomor Kartu Keluarga
                    </th>
                    <td>
                        {{ card.family_card_number }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Kepala Keluarga
                    </th>
                    <td>
                        {{ card.householder_name }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nomor Akta Kelahiran
                    </th>
                    <td>
                        {{ card.birth_certificate_number }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Alamat
                    </th>
                    <td>
                        {{ card.address }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        RT/RW
                    </th>
                    <td>
                        {{ card.rt + ' / ' + card.rw }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Kelurahan
                    </th>
                    <td>
                        {{ card.kelurahan }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Kecamatan
                    </th>
                    <td>
                        {{ card.kecamatan }}
                    </td>
                </tr>
            </table>
            <div class="d-flex justify-content-center">
                <button @click="submitArchieve" class="btn btn-sm btn-primary" type="button">Arsipkan Dokumen</button>
            </div>
        </div>
    </div>

</template>

<script>
import {get, cloneDeep} from 'lodash'
import moment from 'moment'
import {confirmationModal, errorModal, successModal} from '../../../../helper'
export default {
    props : [
        'card', 'submit_url', 'delete_url', 'redirect_url'
    ],
    data(){
        return {
            errors : null,
            disableSubmit : false,
            formData : {
                card_number : get(this.card, 'card_number', ''),
                name : get(this.card, 'name', ''),
                gender : get(this.card, 'gender', 'laki-laki'),
                address : get(this.card, 'address', ''),
                birthplace : get(this.card, 'birthplace', ''),
                birthdate : new Date(get(this.card, 'birthdate', null)),
                family_card_number : get(this.card, 'family_card_number', ''),
                householder_name : get(this.card, 'householder_name', ''),
                birth_certificate_number : get(this.card, 'birth_certificate_number', ''),
                citizenship : get(this.card, 'citizenship', ''),
                rt : get(this.card, 'rt', ''),
                rw : get(this.card, 'rw', ''),
                kelurahan : get(this.card, 'kelurahan', ''),
                kecamatan : get(this.card, 'kecamatan', ''),
                citizenship : get(this.card, 'citizenship', ''),
                religion : get(this.card, 'religion', ''),
                nationality : get(this.card, 'nationality', ''),
                status : get(this.card, 'status', '00')
            }
       }
   },
   computed :{
       form(){
           return {
               ...this.formData,
               birthdate : moment(this.formData.birthdate).format('DD-MM-YYYY')
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