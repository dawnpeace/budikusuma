<template>
        <div class="w-inherit">
            <form class="w-inherit" @submit.prevent="submitForm">
                <side-label
                    :error="get(errors, 'errors.card_number[0]', '')" 
                    name="card_number" 
                    title="No KIA" 
                    v-model="card_number"
                    placeholder="Nomor KIA"/>

                <side-label
                    :error="get(errors, 'errors.family_card_number[0]', '')" 
                    name="family_card_number" 
                    title="No KK" 
                    v-model="family_card_number"
                    placeholder="Nomor KK"/>
                <div class="col-12 text-center">
                    <button :disabled="data" class="btn btn-sm btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <div v-show="data !== null" class="mt-3">
                <hr>
                <h5 class="my-1 text-center mb-4">Data KTP</h5>
                <div class="d-none d-sm-none d-md-block">
                    <div class="row">
                        <div class="col-3 text-right">
                            Nama Anak :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.name','')}}
                        </div>

                        <div class="col-3 text-right">
                            Nama Kepala Keluarga :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.householder_name','')}}
                        </div>

                        <div class="col-3 text-right">
                            Nomor Kartu :
                        </div>
                        <div class="col-9">
                            {{get(data,'data.card_number','')}}
                        </div>

                        <div class="col-3 text-right">
                            Jenis Kelamin :
                        </div>
                        <div class="col-9  mb-2 text-capitalize">
                            {{get(data,'data.gender','')}}
                        </div>

                        <div class="col-3 text-right">
                            Alamat :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.address','')}}                    
                        </div>
                        
                        <div class="col-3 text-right">
                            RT/RW :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.rt','') + "/" + get(data,'data.rw','')}}
                        </div>

                        <div class="col-3 text-right">
                            Kecamatan :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.kecamatan','')}}                    
                        </div>

                        <div class="col-3 text-right">
                            Kelurahan :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.kelurahan','')}}                    
                        </div>

                        <div class="col-3 text-right">
                            Agama :
                        </div>
                        <div class="col-9 mb-2 text-capitalize">
                            {{get(data,'data.religion','')}}                    
                        </div>
                    </div>
                </div>

                <div class="d-sm-block d-md-none d-lg-none">
                    <small>Nama Anak</small>
                    <p>
                        {{get(data,'data.name','')}}
                    </p>

                    <small>Nama Kepala Keluarga</small>
                    <p>
                        {{get(data,'data.householder_name','')}}
                    </p>

                    <small>
                        Nomor Kartu :
                    </small>
                    <p>
                        {{get(data,'data.card_number','')}}
                    </p>

                    <small>
                        Jenis Kelamin :
                    </small>
                    <p class=" text-capitalize">
                        {{get(data,'data.gender','')}}
                    </p>

                    <small>
                        Alamat :
                    </small>
                    <p>
                        {{get(data,'data.address','')}}                    
                    </p>

                    <small>
                        RT/RW :
                    </small>
                    <p>
                        {{get(data,'data.rt','') + "/" + get(data,'data.rw','')}}
                    </p>

                    <small>
                        Kecamatan :
                    </small>
                    <p>
                        {{get(data,'data.kecamatan','')}}                    
                    </p>

                    <small>
                        Kelurahan :
                    </small>
                    <p>
                        {{get(data,'data.kelurahan','')}}                    
                    </p>

                    <small>
                        Agama :
                    </small>
                    <p class="text-capitalize">
                        {{get(data,'data.religion','')}}                    
                    </p>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button :disabled="reprint" @click="submitReprint" type="button" class="btn btn-sm btn-success mx-1">Ajukan Cetak Ulang</button>
                    <button @click="cancel" type="button" class="btn btn-sm btn-secondary mx-1">Batal</button>
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
            family_card_number : null,
            data : null,
            reprinted : false,

        }
    },
    computed :{
        formData(){
            return {
                family_card_number : this.family_card_number,
                card_number : this.card_number,
            }
        }
    },
    methods : {
        get,
        submitForm(){
            axios.post(this.submit_url, this.formData)
                .then(response =>{
                    this.data = response;
                    this.errors = null;
                })
                .catch(e => {
                    let message = e.response.data.message;
                    this.data = null;
                    switch(e.response.status){
                        case 404 :
                            swal("Data tidak ditemukan", "Pastikan data benar dan telah terdaftar di Sanatab!", "error");
                            break;
                        case 422 : 
                            this.errors = e.response.data;
                            break;
                        case 500 :
                            swal("Terjadi Kesalahan !", "Tolong coba beberapa saat lagi!", "error");
                            break;
                    }
                });
        },
        cancel(){
            this.data = null;
        },
        submitReprint(){
            axios.post(this.reprint_url, this.formData)
                .then(response => {
                    this.reprint = true;
                    swal("Permintaan Berhasil Disimpan!", "", "success").then(value => { window.location.replace(this.redirect_url) });
                })
                .catch(e => {
                    let message = e.response.data.message;
                    this.data = null;
                    switch(e.response.status){
                        case 404 :
                            swal("Data tidak ditemukan", "Pastikan data benar dan telah terdaftar di Sanatab!", "error");
                            break;
                        case 400 : 
                            swal("Permintaan Ditolak", message, "error");
                            break;
                        case 500 :
                            swal("Terjadi Kesalahan !", "Tolong coba beberapa saat lagi!", "error");
                            break;
                    }
                });
        }
    }
}
</script>