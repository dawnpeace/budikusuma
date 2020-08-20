<template>
        <div class="w-inherit">
            <form class="w-inherit" @submit.prevent="submitForm">
                <side-label
                    :error="get(errors, 'errors.mother_identity_card_number[0]', '')" 
                    name="mother_identity_card_number" 
                    title="NIK Ibu" 
                    v-model="mother_identity_card_number"
                    placeholder="NIK Ibu"/>

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
                    <button :disabled="data || isLoading" class="btn btn-sm btn-primary" type="submit">Submit</button>
                </div>
            </form>
            <div v-show="data !== null" class="mt-3">
                <hr>
                <h5 class="my-1 text-center mb-4">Data Kartu Keluarga</h5>
                <div v-for="(child, idx) in data" :key="idx" class="border w-100 py-2 rounded mb-3">
                    <div class="d-none d-sm-none d-md-block">
                        <div class="row">
                            <div class="col-4 text-right">
                                NIK Ibu :
                            </div>
                            <div class="col-8">
                                {{child.mother_identity_card_number}}
                            </div>

                            <div class="col-4 text-right">
                                Nama Anak :
                            </div>
                            <div class="col-8">
                                {{child.name}}
                            </div>

                            <div class="col-4 text-right">
                                Jenis Kelamin :
                            </div>
                            <div class="col-8 text-capitalize">
                                {{child.gender}}
                            </div>

                            <div class="col-4 text-right">
                                Tanggal Lahir :
                            </div>
                            <div class="col-8 mb-2">
                                {{formatDate(child.birthdate)}}
                            </div>

                        </div>
                    </div> 
                    <div class="d-sm-block d-md-none d-lg-none px-4 pt-4">
                        <small>NIK Ibu :</small>
                        <p>
                            {{child.mother_identity_card_number}}
                        </p>

                        <small>Nama Anak</small>
                        <p>
                            {{child.name}}
                        </p>

                        <small>
                            Jenis Kelamin :
                        </small>
                        <p class="text-capitalize">
                            {{child.gender}}
                        </p>

                        <small>
                            Tanggal Lahir :
                        </small>
                        <p>
                            {{formatDate(child.birthdate)}}                    
                        </p>

                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button @click="confirmationForm(child.id)" type="button" class="btn btn-sm btn-success mx-1">Ajukan Cetak Ulang</button>
                    </div>
                </div>

                <div class="d-flex justify-content-center my-3">
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
            mother_identity_card_number : null,
            birthdate : new Date('1990-01-01'),
            data : null,
            isLoading : false
        }
    },
    computed :{
        formData(){
            return {
                mother_identity_card_number : this.mother_identity_card_number,
                birthdate :  moment(this.birthdate).format('DD-MM-YYYY')
            }
        }
    },
    methods : {
        get,
        confirmationForm(id){
            swal({
                title : "Apakah anda yakin ingin melanjutkan ?",
                icon : "info",
                buttons : ["Batal", "Ok"]
            })
            .then((value) => { if(value) this.submitReprint(id);})
        },
        submitForm(){
            this.isLoading = true;
            axios.post(this.submit_url, this.formData)
                .then(response =>{
                    this.data = response.data;
                    this.errors = null;
                    this.isLoading = false;
                })
                .catch(e => {
                    let message = e.response.data.message;
                    this.isLoading = false;
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
        submitReprint(id){
            let data = {
                id : id,
                birthdate : moment(new Date(this.birthdate)).format('DD-MM-YYYY'),
                mother_identity_card_number : this.mother_identity_card_number,
            };
            console.log(data.mother_identity_card_number);
            axios.post(this.reprint_url, data)
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
        formatDate(birthdate){
            return birthdate ? moment(new Date(birthdate)).format('DD-MM-YYYY') : '';
        }
    }
}
</script>