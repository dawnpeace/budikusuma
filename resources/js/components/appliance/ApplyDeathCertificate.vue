<template>
    <div>
        <h5 class="text-center">Daftar Akta Kematian</h5>
        <hr>
        <form @submit.prevent="submitForm()" class="row" action="" method="post">
    
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No Identitas</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No Identitas</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="formData.identity_card" 
                        placeholder="No Identitas" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.identity_card[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.identity_card[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Lengkap Alm.</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Lengkap Alm.</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="formData.name" 
                        placeholder="Nama Lengkap Alm." 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Jenis Kelamin</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Jenis Kelamin</label>
            </div>
            <div class="col-md-9 col-sm-12">  
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="formData.gender" class="form-control">
                        <option value="laki-laki" selected>Laki - laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.gender[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tempat Lahir</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="formData.birthplace" 
                        placeholder="Tempat Lahir" 
                        type="text"
                        id="birthplace"
                        :class="{'is-invalid': get(this.errors, 'errors.birthplace[0]', false)}" 
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthplace[0]', '')}}</div>
                </div>
            </div>

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
                        v-model="formData.birthdate"
                        placeholder="Tanggal Lahir" 
                        :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthdate[0]', '')}}</div>
                </div>
            </div>

            
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Wafat</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Wafat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <datepicker 
                        input-class="form-control"
                        id="deceased_at"
                        format="dd-MM-yyyy"
                        v-model="formData.deceased_at"
                        placeholder="Tanggal Wafat" 
                        :class="{'is-invalid': get(this.errors, 'errors.deceased_at[0]', false)}"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.deceased_at[0]', '')}}</div>
                </div>
            </div>
          
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Catatan Wafat</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Catatan Wafat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="formData.note" 
                        placeholder="Tempat Lahir" 
                        type="text"
                        id="birthplace"
                        :class="{'is-invalid': get(this.errors, 'errors.note[0]', false)}" 
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.note[0]', '')}}</div>
                </div>
            </div>

            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary mx-1" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import { get, cloneDeep } from 'lodash'
import moment from 'moment'
export default {
    props : [
        "card", "redirect_url", "submit_url"
    ],
    data(){
        return {
            errors : null,
            formData : {
                name : "",
                birthplace : "",
                gender : "laki-laki",
                identity_card : "",
                birthdate : new Date('1990-01-01'),
                deceased_at : new Date(),
                note : ""
            },
            disableSubmit : false,
        }
    },
    computed :{
        form(){
            let birthdate = cloneDeep(this.formData.birthdate);
            let deceasedAt = cloneDeep(this.formData.deceased_at);
            return {
                ...this.formData,
                birthdate : moment(birthdate).format('DD-MM-YYYY'),
                deceased_at : moment(deceasedAt).format('DD-MM-YYYY'),
            }
        }
    },
    methods : {
        get,
        cloneDeep,
        submitForm(){
            axios.post(
                this.submit_url, this.form
            )
            .then (success => {
                swal({
                    title  : 'Data berhasil dimasukkan!',
                    button : 'Ok',
                    icon : 'success'
                }).then( ok => {
                    if(ok) window.location.replace(this.redirect_url);
                    this.disableSubmit = false;
                });
            })
            .catch(e => {
                this.errors = e.response.data;
                this.disableSubmit = false;
            });
        }
    }
}
</script>