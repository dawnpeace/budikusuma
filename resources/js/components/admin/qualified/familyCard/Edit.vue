<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Kartu Keluarga Terkualifikasi</h5>
        <div class="table-responsive">
            <table class="table table-sm table-borderless mb-5">
                <tr>
                    <th class="text-right" width="33%">
                        Nomor Kartu
                    </th>
                    <td>
                        {{ card.id_number }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        Nama Kepala Keluarga
                    </th>
                    <td>
                        {{ card.householder }}
                    </td>
                </tr>

                <tr>
                    <th class="text-right" width="33%">
                        No. KTP Kepala Keluarga
                    </th>
                    <td>
                        {{ card.householder_id_card }}
                    </td>
                </tr>


                <tr>
                    <th class="text-right" width="33%">
                        Kode Pos
                    </th>
                    <td>
                        {{ card.zipcode }}
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

                <tr>
                    <th class="text-right" width="33%">
                        Provinsi
                    </th>
                    <td>
                        {{ card.provinsi }}
                    </td>
                </tr>
            </table>
        </div>
        
        <h5 class="text-center w-100">Anggota Keluarga</h5>

        <div class="table-responsive px-5">
            <table class="table table-sm table-bordered">
                <thead>
                    <th>Nama</th>
                    <th>No Identitas</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Hubungan Keluarga</th>
                </thead>
                <tbody>
                    <tr v-for="member in card.members" v-bind:key="member.id">
                        <td>{{ member.name }}</td>
                        <td>{{ member.id_card }}</td>
                        <td class="text-capitalize">{{ member.gender }}</td>
                        <td>{{ member.birthplace }}</td>
                        <td>{{ member.birthdate ? moment(member.birthdate).format('DD-MM-YYYY') : '' }}</td>
                        <td class="text-capitalize">{{ member.religion }}</td>
                        <td>{{ member.education }}</td>
                        <td>{{ member.profession }}</td>
                        <td>{{ member.family_relation }}</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button @click="submitArchieve" class="btn btn-sm btn-primary" type="button">Arsipkan Dokumen</button>
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