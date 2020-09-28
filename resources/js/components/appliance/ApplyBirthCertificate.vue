<template>
    <div>
        <h5 class="text-center">Daftar Akta Kelahiran</h5>
        <hr>
        <form @submit.prevent="submitForm()" class="row" action="" method="post">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Lengkap Anak</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Anak</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="name" 
                        placeholder="Nama Anak" 
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="gender" class="form-control">
                        <option value="laki-laki" selected>Laki - laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.gender[0]', '')}}</div>
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
                        v-model="birthdate"
                        placeholder="Tanggal Lahir" 
                        :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthdate[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tempat Lahir</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="birthplace" 
                    placeholder="Tempat Lahir" 
                    type="text"
                    id="birthplace"
                    :class="{'is-invalid': get(this.errors, 'errors.birthplace[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthplace[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No KTP Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No KTP Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="mother_identity_card_number" 
                        placeholder="No KTP Ibu" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.mother_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_identity_card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="mother_name" 
                        placeholder="Nama Ibu" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.mother_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No KTP Ayah</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No KTP Ayah</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="father_identity_card_number" 
                        placeholder="No KTP Ayah" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.father_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_identity_card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Ayah</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Ayah</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="father_name" 
                        placeholder="Nama Ayah" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.father_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_name[0]', '')}}</div>
                </div>
            </div>

            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import { get } from 'lodash'
import moment from 'moment'
export default {
    props : [
        "redirect_url", "submit_url"
    ],
    data(){
        return {
            errors : null,
            name : null,
            gender : 'laki-laki',
            birthdate : new Date('2000-01-01'),
            birthplace : null,
            mother_identity_card_number : null,
            mother_name : null,
            father_identity_card_number : null,
            father_name : null,
            disableSubmit : false,
        }
    },
    computed :{
        formData(){
            return {
                name : this.name,
                gender : this.gender,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                birthplace : this.birthplace,
                mother_identity_card_number : this.mother_identity_card_number,
                mother_name : this.mother_name,
                father_identity_card_number : this.father_identity_card_number,
                father_name : this.father_name
            }
        }
    },
    methods : {
        get,
        submitForm(){
            this.disableSubmit = true;
            axios.post(
                this.submit_url, this.formData
            ).then(response => {
                swal({
                    title  : 'Data berhasil dimasukkan!',
                    button : 'Ok',
                    icon : 'success'
                }).then( ok => {
                    if(ok) window.location.replace(this.redirect_url);
                    this.resetForm();
                })
            }).catch(e => {
                console.log(e.response.data);
                this.errors = e.response.data;
            });
        },
        resetForm(){
            this.name = null;
            this.gender = 'laki-laki';
            this.birthdate = null;
            this.birthplace = new Date('2000-01-01');
            this.mother_identity_card_number = null;
            this.mother_name = null;
            this.father_identity_card_number = null;
            this.father_name = null;
            this.disableSubmit = false;
        }
    }
}
</script>