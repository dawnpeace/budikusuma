<template>
        <div class="w-inherit">
            <form class="w-inherit" @submit.prevent="submitForm">
                <side-label
                    :error="get(errors, 'errors.id_card[0]', '')" 
                    name="id_card" 
                    title="No KK" 
                    v-model="id_card"
                    placeholder="Nomor KK"/>

                <side-label
                    :error="get(errors, 'errors.householder_id_card[0]', '')"
                    name="householder_id_card"
                    title="NIK Kepala Keluarga"
                    v-model="householder_id_card"
                    placeholder="NIK Kepala Keluarga"/>
                <div class="col-12 text-center">
                    <button :disabled="data" class="btn btn-sm btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <div v-show="data !== null" class="mt-3">
                <hr>
                <h5 class="my-1 text-center mb-4">Data Kartu Keluarga</h5>
                <div class="d-none d-sm-none d-md-block">
                    <div class="row">
                        <div class="col-4 text-right">
                            Nomor KK :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.id_card','')}}
                        </div>
                        <div class="col-4 text-right">
                            Nama Kepala Keluarga :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.householder','')}}
                        </div>

                        <div class="col-4 text-right">
                            NIK Kepala Keluarga :
                        </div>
                        <div class="col-8">
                            {{get(data,'data.householder_id_card','')}}
                        </div>

                        <div class="col-4 text-right">
                            Kode Pos :
                        </div>
                        <div class="col-8">
                            {{get(data,'data.zip_code','')}}
                        </div>

                        <div class="col-4 text-right">
                            Alamat :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.address','')}}                    
                        </div>

                        <div class="col-4 text-right">
                            RT/RW :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.rt','') + "/" + get(data,'data.rw','')}}
                        </div>

                        <div class="col-4 text-right">
                            Kecamatan :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.kecamatan','')}}                    
                        </div>

                        <div class="col-4 text-right">
                            Kelurahan :
                        </div>
                        <div class="col-8 mb-2">
                            {{get(data,'data.kelurahan','')}}                    
                        </div>

                    </div>
                </div>

                <div class="d-sm-block d-md-none d-lg-none">
                    <small>Nomor KK</small>
                    <p>
                        {{get(data,'data.id_card','')}}
                    </p>

                    <small>Nama Kepala Keluarga</small>
                    <p>
                        {{get(data,'data.householder','')}}
                    </p>

                    <small>
                        NIK Kepala Keluarga
                    </small>
                    <p>
                        {{get(data,'data.householder_id_card','')}}
                    </p>

                    <small>
                        Kode Pos
                    </small>
                    <p>
                        {{get(data,'data.zip_code','')}}                    
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
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button @click="confirmationDialog()" type="button" class="btn btn-sm btn-success mx-1">Ajukan Cetak Ulang</button>
                    <button @click="cancel" type="button" class="btn btn-sm btn-secondary mx-1">Batal</button>
                </div>
            </div>
        </div>
</template>

<script>
import {get} from 'lodash'
export default {
    props : [
        "redirect_url", "submit_url", "reprint_url"
    ],
    data(){
        return {
            errors : null,
            id_card : null,
            householder_id_card : null,
            data : null,
            reprinted : false,
        }
    },
    computed :{
        formData(){
            return {
                id_card : this.id_card,
                householder_id_card : this.householder_id_card
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
        },
        confirmationDialog(){
            swal({
                dangerMode : true,
                icon : 'warning',
                title : 'Apakah anda yakin ingin melanjutkan',
                buttons : ["Batal", "OK"],
            }).then((ok) => {
                if(ok) this.submitReprint();
            });
        }
    }
}
</script>