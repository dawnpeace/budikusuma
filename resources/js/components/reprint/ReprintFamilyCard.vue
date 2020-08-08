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
                <h5 class="my-1 text-center mb-4">Data KTP</h5>
                <div class="d-none d-sm-none d-md-block">
                    <div class="row">
                        <div class="col-3 text-right">
                            Nama :
                        </div>
                        <div class="col-9 mb-2">
                            {{get(data,'data.name','')}}
                        </div>

                        <div class="col-3 text-right">
                            NIK :
                        </div>
                        <div class="col-9">
                            {{get(data,'data.identity_card_number','')}}
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
                    <small>Nama</small>
                    <p>
                        {{get(data,'data.name','')}}
                    </p>

                    <small>
                        NIK :
                    </small>
                    <p>
                        {{get(data,'data.identity_card_number','')}}
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
                    <button @click="submitReprint" type="button" class="btn btn-sm btn-success mx-1">Ajukan Cetak Ulang</button>
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
            data : null
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
                .then(response => {
                    this.data = response;
                })
                .catch(e => {
                    switch(e.response.status){
                        case 404 :
                            swal("Data tidak ditemukan", "Pastikan data benar dan telah terdaftar di Sanatab!", "error");
                            this.data = null;
                            break;
                        case 422 : 
                            this.errors = e.response.data;
                            this.data = null;
                            break;
                        case 500 :
                            swal("Terjadi Kesalahan !", "Tolong coba beberapa saat lagi!", "error");
                            this.data = null;
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
                    console.log(response.data);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }
}
</script>