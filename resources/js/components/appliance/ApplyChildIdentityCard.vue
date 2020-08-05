<template>
    <div>
        <h5 class="text-center">Daftar Kartu Identitas Anak</h5>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No. Kartu Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No. Kartu Keluarga</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="family_card_number" 
                        placeholder="No. Kartu Keluarga" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.family_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.family_card_number[0]', '')}}</div>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No KTP Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No KTP Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="mother_identity_card_number" 
                        placeholder="Nama Anak" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.mother_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_identity_card_number[0]', '')}}</div>
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
                        placeholder="Nama Anak" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.father_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_identity_card_number[0]', '')}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-center col-12 pt-3">
                <button class="btn btn-primary" type="submit">Submit</button>
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
            family_card_number : null,
            birthdate : new Date('2000-01-01'),
            mother_identity_card_number : null,
            father_identity_card_number : null,
        }
    },
    computed :{
        formData(){
            return {
                errors : null,
                name : this.name,
                gender : this.gender,
                family_card_number : this.family_card_number,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                mother_identity_card_number : this.mother_identity_card_number,
                father_identity_card_number : this.family_card_number
            }
        }
    },
    methods : {
        get,
        submitForm(){
            axios.post(
                this.submit_url, this.formData
            ).then(response => {
                console.log(response);
                window.location.replace = this.redirect_url;
            }).catch(e => {
                console.log(e.response.data);
                this.errors = e.response.data;
            });
        }
    }
}
</script>