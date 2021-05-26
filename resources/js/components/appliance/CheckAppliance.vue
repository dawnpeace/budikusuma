<template>
    <div class="w-inherit">
        <div class="row">
            <h5 class="text-center col-12 mb-5">Periksa Status Permintaan Dokumen</h5>

            <div class="col-md-3 col-sm-12 mb-03">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Dokumen</label>
                    <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Dokumen</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select v-model="document" class="form-control">
                            <option value="E-KTP">E-KTP</option>
                            <option value="KIA">KIA</option>
                            <option value="KK">KK</option>
                            <option value="AKTA_LAHIR">AKTA LAHIR</option>
                            <option value="AKTA_KEMATIAN">AKTA KEMATIAN</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button @click="submit" :disabled="isDisabled" class="btn btn-primary btn-sm">Search</button>
                </div>
        </div>
        
        
        <div :key="key" v-for="(val,key) in data" class="row" :class="key == 0 ? 'mt-5' : 'mt-2'">
            <div class="col-3 mb-2 text-right">
                Nama
            </div>
            <div class="col-9 mb-2">
                {{ val.nama }}
            </div>

            <div class="col-3 mb-2 text-right">
                Tanggal Pengajuan
            </div>
            <div class="col-9 mb-2">
                {{ moment(val.created_at).format('DD-MM-yyyy') }}
            </div>

            <div class="col-3 mb-2 text-right">
                Status
            </div>

            <div class="col-9 mb-2">
                <span class="badge" :class="statusClass(val.status)">{{ statusInfo(val.status) }}</span>
            </div>

            <div class="col-3 mb-2 text-right">
                Keterangan
            </div>

            <div class="col-9 mb-2">
                {{ val.reason ? val.reason : '-' }}
            </div>
            <div class="col-12 px-5 d-flex justify-content-center my-3">
                <div class="w-50 border-bottom"></div>
            </div>
        </div>
       

    </div>
</template>
<script>
import {get, cloneDeep} from 'lodash'
import Swal from 'sweetalert2'

import moment from 'moment'
export default {
    props : [
        "redirect_url", "submit_url"
    ],
    data(){
        return {
            errors : null,
            document : 'E-KTP',
            data : [],
            isDisabled : false

        }
    },
    computed:{
       request() {
           return {
               document : this.document
           }
       }
    },
    methods:{
        moment,
        get,
        cloneDeep,
        submit() {
            axios.post(this.submit_url, this.request)
                .then( response => {
                    this.data = response.data;
                    if(this.data.length == 0) Swal.fire('Data tidak ditemukan', '', 'success');
                })
                .catch( err => {
                    this.err = err.response.data;
                });
        },
        statusClass(status) {
            switch(status) {
                case "00":
                    return "badge-secondary";
                case "01":
                    return "badge-info";
                case "02":
                    return "badge-primary";
                case "03":
                    return "badge-danger";
                case "04":
                    return "badge-success";

            }
        },
        statusInfo(status) {
            switch(status) {
                case "00":
                    return "Tunggu";
                case "01":
                    return "Dalam Proses";
                case "02":
                    return "Diterima";
                case "03":
                    return "Ditolak";
                case "04":
                    return "Selesai";

            }
        }
       
        
    }
}
</script>