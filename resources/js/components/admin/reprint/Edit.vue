<template>
    <div>
        <h5 class="text-center">Permintaan Cetak Ulang Dokumen</h5>
        <hr>
        <div class="table-responsive my-2">
            <table class="table tabe-sm table-borderless">
                <tbody>
                    <tr>
                        <th width="33%" class="text-right">Nomor Identitas</th>
                        <td>{{ this.document.id_number }}</td>
                    </tr>
                    <tr>
                        <th width="33%" class="text-right">
                            Dokumen
                        </th>
                        <td>
                            {{ documentType }}
                        </td>
                    </tr>
                    <tr>
                        <th width="33%" class="text-right">
                            Nama
                        </th>
                        <td>
                            {{ getName }}
                        </td>
                    </tr>
                    <tr>
                        <th width="33%" class="text-right">
                            Status
                        </th>
                        <td>
                            {{ documentStatus(this.document.status) }}
                        </td>
                    </tr>
                    <tr>
                        <th width="33%" class="text-right">Diajukan Pada</th>
                        <td>
                            {{ createdDate }}
                        </td>
                    </tr>
                    <tr>
                        <th width="33%" class="text-right">Dicetak Pada</th>
                        <td>
                            {{ printedDate }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Jenis Pengajuan</th>
                        <td class="text-capitalize">
                            {{this.document.type}}
                        </td>
                    </tr>
                    <tr v-show="this.document.type === 'hilang'">
                        <th class="text-right">Dokumen Pengantar</th>
                        <td class="text-capitalize">
                            <a :href="`${this.media_url}\\?media_name=pengantar`" class="btn btn-primary btn-sm" target="_blank">Download</a>
                        </td>
                    </tr>
                    <tr v-show="this.document.type === 'hilang'">
                        <th class="text-right">Dokumen Kehilangan</th>
                        <td class="text-capitalize">
                            <a :href="`${this.media_url}\\?media_name=kehilangan`" class="btn btn-primary btn-sm" target="_blank">Download</a>
                        </td>
                    </tr>
                    <tr v-show="this.document.type === 'hilang'">
                        <th class="text-right">Dokumen Pendukung</th>
                        <td class="text-capitalize">
                            <a :href="`${this.media_url}\\?media_name=pendukung`" class="btn btn-primary btn-sm" target="_blank">Download</a>
                        </td>
                    </tr>

                    <tr v-show="this.document.type === 'rusak'">
                        <th class="text-right">Dokumen Pengantar</th>
                        <td class="text-capitalize">
                            <a :href="`${this.media_url}\\?media_name=pengantar`" class="btn btn-primary btn-sm" target="_blank">Download</a>
                        </td>
                    </tr>
                    <tr v-show="this.document.type === 'rusak'">
                        <th class="text-right">Dokumen Rusak</th>
                        <td class="text-capitalize">
                            <a :href="`${this.media_url}\\?media_name=dokumen_rusak`" class="btn btn-primary btn-sm" target="_blank">Download</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div id="datePickModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="status" name="status" class="form-control">
                                <option value="00">Tunggu</option>
                                <option value="01">Dalam Proses</option>
                                <option value="02">Diterima</option>
                                <option value="03">Ditolak</option>
                                <option value="04">Selesai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" v-model="reason">
                        </div>
                        <div v-show="status == '04'" class="form-group">
                            <label>Tanggal Cetak</label>
                            <datepicker
                                input-class="form-control"
                                id="birthdate"
                                format="dd-MM-yyyy"
                                v-model="printDate"
                                placeholder="Tanggal Lahir"
                                :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}"/>
                        </div>
                    </div>
                    <div class="form-group text-right px-3">
                        <button @click="markAsPrinted()" class="btn btn-sm btn-primary mx-1" type="button">Submit</button>
                        <button data-dismiss="modal" data-target="#datePickModal" class="btn btn-sm btn-secondary mx-1" type="button">Batal</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button :disabled="submitDisabled" data-toggle="modal" data-target="#datePickModal" v-show="!this.document.printed_at" class="btn btn-sm btn-primary mx-1" type="button"> Perbaharui</button>
            <button @click="deleteRecord()" class="btn btn-sm btn-danger mx-1" type="button">Hapus</button>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
import {confirmationModal, successModal, errorModal, documentStatus} from '../../../helper'
import {get} from 'lodash'
export default {
    props : [
        "document", "delete_url", "redirect_url", "submit_url", "media_url"
    ],
    data(){
        return {
            printDate : new Date(),
            submitDisabled : false,
            errors : null,
            status : '00',
            reason : ''
        }
    },
    methods : {
        documentStatus,
        get,
        deleteRecord(){
            confirmationModal({icon : 'danger'})
                .then(res => {
                    if(res.isConfirmed){
                        axios.post(this.delete_url)
                            .then(response => {
                                successModal({title : "Data Berhasil Dihapus"})
                                    .then(confirm => {
                                        if(confirm.isConfirmed) location.href = this.redirect_url;
                                        if(confirm.isDismissed) location.href = this.redirect_url;
                                    })
                            })
                    }
                })
                .catch(err => {
                    errorModal();
                });
        },
        markAsPrinted(){
            this.submitDisabled = true;
            axios.post(this.submit_url, this.formData)
                .then( response => {
                    successModal({title : "Data Berhasil Diperbaharui"})
                        .then(confirm => {
                            if(confirm.isConfirmed) location.href = this.redirect_url;
                            this.submitDisabled = false;
                            if(confirm.isDismissed) location.href = this.redirect_url;
                        });
                })
                .catch( err => {
                    errorModal({text : err.response.data.message});
                    this.submitDisabled = false;
                })
        }
    },
    computed :{
        printedDate(){
            if(this.document.printed_at){
                return moment(this.document.printed_at).format('DD-MM-YYYY');
            }
            return "Belum Dicetak";
        },
        createdDate(){
            return moment(this.document.created_at).format('DD-MM-YYYY');
        },
        getName(){
            if(this.document.reprintable.name == undefined){
                return this.document.reprintable.householder;
            }
            return this.document.reprintable.name;
        },
        formData(){
            return {
                printed_at : this.status == '04' ? moment(this.printDate).format('DD-MM-YYYY') : '',
                status : this.status,
                reason : this.reason
            }
        },
        documentType(){
            let doc = '';
            switch(this.document.reprintable_type){
                case 'App\\IdentityCard':
                    doc = 'E-KTP';
                    break;
                case 'App\\ChildIdentityCard':
                    doc = 'KIA';
                    break;
                case 'App\\FamilyCard':
                    doc = 'KK';
                    break;
                case 'App\\BirthCertificate':
                    doc = 'Akta Lahir';
                    break;
            }
            return doc;
        }
    }
}
</script>
