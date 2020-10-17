<template>
    <div>
        <h5 class="text-center  mt-3 mb-5">E-KTP Terkualifikasi</h5>
        <div class="table-responsive">
            <table class="table table-sm table-borderless mb-3">
                <tr>
                    <th width="33%" class="text-right">Nomor Identitas</th>
                    <td>{{card.id_card}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Nama</th>
                    <td>{{card.name}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Jenis Kelamin</th>
                    <td class="text-capitalize">{{card.gender}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Alamat</th>
                    <td>{{card.address}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Tempat, Tanggal Lahir</th>
                    <td>{{card.birthplace + ', ' + moment(card.birthdate).format('DD-MM-YYYY')}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">RT/RW</th>
                    <td>{{card.rt + ' / ' +card.rw}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Kecamatan</th>
                    <td>{{card.kecamatan}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Kelurahan</th>
                    <td>{{card.kelurahan}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Agama</th>
                    <td class="text-capitalize">{{card.religion}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Pekerjaan</th>
                    <td>{{card.profession}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Kewarganegaraan</th>
                    <td>{{card.nationality}}</td>
                </tr>
                <tr>
                    <th width="33%" class="text-right">Status Pernikahan</th>
                    <td>{{this.getMarriageStatus(card.marriage_status)}}</td>
                </tr>
            </table>
            <div class="d-flex justify-content-center">
                <button @click="submitArchieve" class="btn btn-sm btn-primary" type="button">Arsipkan Dokumen</button>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
import {confirmationModal, successModal, errorModal} from '../../../../helper'
export default {
    props : [
        "card", "redirect_url", "submit_url"
    ],
    methods: {
        moment,
        getMarriageStatus(status){
            switch(status){
                case 'not_married':
                    return 'Belum kawin';
                case 'married':
                    return 'Kawin';
                case 'widowed':
                    return 'Cerai';
            }
        },
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