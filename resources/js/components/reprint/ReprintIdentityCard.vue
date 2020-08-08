<template>
        <div class="w-inherit">
            <form class="w-inherit" @submit.prevent="submitForm">
                <side-label
                    :error="get(errors, 'errors.identity_card_number[0]', '')" 
                    name="identity_card_number" 
                    title="No KTP" 
                    v-model="identity_card_number"
                    placeholder="Nomor KTP"/>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Lahir</label>
                        <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Lahir</label>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <datepicker 
                                input-class="form-control"
                                id="birthdate"
                                format="dd-MM-yyyy"
                                v-model="birthdate"
                                placeholder="Tanggal Lahir" 
                                :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}"/>
                            <div class="invalid-feedback">{{get(this.errors, 'errors.birthdate[0]', '')}}</div>
                        </div>
                    </div>
                </div>
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
            identity_card_number : null,
            birthdate : new Date('1990-01-01'),
            data : null,
            reprinted : false,

        }
    },
    computed :{
        formData(){
            return {
                identity_card_number : this.identity_card_number,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
            }
        },
        reprintData(){
            return {
                identity_card_number : this.identity_card_number,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
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
            axios.post(this.reprint_url, this.reprintData)
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