<template>
        <div class="w-inherit">
            <form class="w-inherit mb-3" @submit.prevent="submitForm">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Dokumen</label>
                        <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Jenis Dokumen</label>
                    </div>
                    <div class="form-group col-md-9 col-sm-12 mb-3">
                        <select v-model="document_type" name="document_type" class="form-control">
                            <option value="ktp">Kartu Tanda Pengenal</option>
                            <option value="kia">Kartu Identitas Anak</option>
                            <option value="kk">Kartu Keluarga</option>
                            <option value="aktea-lahir">Akta Kelahiran</option>
                        </select>
                        <div class="invalid-feedback">{{get(errors,'errors.document_type[0]')}}</div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nomor Kartu</label>
                        <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nomor Kartu</label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <input
                                v-model="card_number"
                                name="card_number"
                                placeholder="Nomor Kartu"
                                type="text"
                                :class="{'is-invalid': get(errors, 'errors.card_number[0]')}"
                                class="form-control"/>
                            <div class="invalid-feedback">{{get(errors, 'errors.card_number[0]')}}</div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button :disabled="data" class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            <div v-show="data !== null" class="w-100">
                <hr>
                <h5 class="text-center">Data Permintaan</h5>
                <div class="w-inherit d-none d-md-block d-sm-none d-xs-none px-5 mb-3">
                    <div class="row">
                        <div class="col-3 text-right">
                            Tanggal Pengajuan :
                        </div>
                        <div class="col-9">
                            {{requestedAt}}
                        </div>
                    </div>
                </div>
                <div class="d-sm-block d-xs-block d-md-none d-lg-none">
                    <small>Tanggal Pengajuan</small>
                    <p>{{requestedAt}}</p>
                </div>

                <div class="w-inherit d-none d-md-block d-sm-none d-xs-none px-5 mb-3">
                    <div class="row">
                        <div class="col-3 text-right">
                            Jenis Dokumen :
                        </div>
                        <div class="col-9">
                            {{documentType}}
                        </div>
                    </div>
                </div>
                <div class="d-sm-block d-xs-block d-md-none d-lg-none">
                    <small>Jenis Dokumen</small>
                    <p>{{documentType}}</p>
                </div>

                <div class="w-inherit d-none d-md-block d-sm-none d-xs-none px-5 mb-3">
                    <div class="row">
                        <div class="col-3 text-right">
                            Status Dokumen :
                        </div>
                        <strong :class="get(data, 'data.printed_at', false) ? 'text-success' : 'text-danger'" class="col-9">
                            {{printed}}
                        </strong>
                    </div>
                </div>
                <div class="d-sm-block d-xs-block d-md-none d-lg-none">
                    <small>Status Dokumen</small>
                    <strong class="d-block" :class="get(data, 'data.printed_at', false) ? 'text-success' : 'text-secondary'">{{printed}}</strong>
                </div>

                <div class="mb-3 row">
                    <div class="col-12 text-center">
                        <button @click="cancel()" class="btn btn-sm btn-secondary px-1">Batal</button>
                    </div>
                </div>

            </div>
        </div>
</template>

<script>
import {get} from 'lodash'
import moment from 'moment'
export default {
    props : [
        "redirect_url", "submit_url", "reprint_url"
    ],
    data(){
        return {
            errors : null,
            card_number : null,
            document_type : 'ktp',
            data : null,
            reprinted : false,

        }
    },
    computed :{
        formData(){
            return {
                 document_type : this.document_type,
                card_number : this.card_number,
            }
        },
        documentType(){
            let type = '';
            if(this.data !== null){
                switch(this.data.reprintable_type){
                    case 'App\\IdentityCard':
                        type = 'Kartu Tanda Pengenal';
                        break;
                    case 'App\\BirthCertificate':
                        type = 'Akta Kelahiran';
                        break;
                    case 'App\\FamilyCard':
                        type = 'Kartu Keluarga';
                        break;
                    case 'App\\ChildIdentityCard':
                        type = 'Kartu Identitas Anak';
                        break;
                }
            }
            return type;
        },
        requestedAt(){
            if(this.data !== null){
                return this.data.created_at ? moment(new Date(this.data.created_at)).format('DD-MM-YYYY') : '';
            }
            return '';
        },
        printed(){
            if(this.data !== null){
                return this.data.printed_at ? 'Dokumen Telah Tercetak' : 'Dokumen Dalam Proses';
            }
        }

    },
    methods : {
        get,
        submitForm(){
            axios.post(this.submit_url, this.formData)
                .then(response =>{
                    this.data = response.data;
                    this.errors = null;
                })
                .catch(e => {
                    let message = e.response.data.message;
                    this.data = null;
                    switch(e.response.status){
                        case 400 :
                            swal("Data tidak ditemukan", "", "error");
                            break;
                        case 500 :
                            swal("Terjadi Kesalahan !", "Tolong coba beberapa saat lagi!", "error");
                            break;
                    }
                });
        },
        cancel(){
            this.data = null;
            this.document_type = 'ktp';
        }
    }
}
</script>
