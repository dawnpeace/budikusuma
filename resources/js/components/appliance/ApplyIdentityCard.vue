<template>
    <div>
        <h5 class="text-center">Daftar E-KTP</h5>
        <hr>
        <form id="submission" @submit.prevent="submitForm()" class="row" action="">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Pemilik</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Pemilik</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="name" 
                        placeholder="Nama Pemilik" 
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
                    <select name="gender" :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="gender" id="" class="form-control">
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Lahir</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <datepicker 
                    input-class="form-control"
                    id="birthdate"
                    format="dd-MM-yyyy"
                    name="birthdate"
                    v-model="birthdate"
                    placeholder="Tanggal Lahir" 
                    :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}" 
                    ></datepicker>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthdate[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Alamat</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Alamat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="address" 
                    placeholder="Alamat" 
                    name="alamat"
                    type="text" 
                    :class="{'is-invalid': get(this.errors, 'errors.address[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.address[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RT</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">RT</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="rt" 
                    placeholder="RT"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.rt[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rt[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RW</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">RW</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="rw" 
                    placeholder="RW" 
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.rw[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rw[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kelurahan / Desa</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Kelurahan / Desa</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="kelurahan" 
                    placeholder="Kelurahan / Desa" 
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kelurahan[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kecamatan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="kecamatan" 
                    placeholder="Kecamatan" 
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.kecamatan[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kecamatan[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Pekerjaan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Pekerjaan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="profession" 
                    placeholder="Pekerjaan" 
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.profession[0]', false)}" 
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.profession[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Agama</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Agama</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="religion"  id="" class="form-control">
                        <option selected value="islam">Islam</option>
                        <option value="kristen protestan">Kristen Protestan</option>
                        <option value="kristen katolik">Kristen Katolik</option>
                        <option value="buddha">Buddha</option>
                        <option value="hindu">Hindu</option>
                        <option value="konghucu">Konghucu</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.religion[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Status Perkawinan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Status Perkawinan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.marriage_status[0]', false)}" v-model="marriage_status"  id="" class="form-control">
                        <option selected value="not_married">Belum Kawin</option>
                        <option value="married">Kawin</option>
                        <option value="widower">Duda / Janda</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.marriage_status[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kewarganegaraan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Kewarganegaraan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="nationality" 
                        placeholder="Kewarganegaraan"
                        :class="{'is-invalid': get(this.errors, 'errors.nationality[0]', false)}"
                        type="text"
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.nationality[0]', '')}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import {get} from 'lodash'
import moment from 'moment'

export default {
    props : [
        "submit_url", "redirect_url"
    ],
    data() {
        return {
            errors : null,
            name : null,
            birthplace : null,
            birthdate : new Date('2000-01-01'),
            gender : "laki-laki",
            address : null,
            rt : null,
            rw : null,
            kelurahan : null,
            kecamatan : null,
            religion : "islam",
            marriage_status : "not_married",
            profession : null,
            nationality : null,
            submitted : false,
            disableSubmit : false
        }
    },
    computed :{
        formData(){
            return {
                name : this.name,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                birthplace : this.birthplace,
                gender : this.gender,
                address : this.address,
                rt : this.rt,
                rw : this.rw,
                kelurahan : this.kelurahan,
                kecamatan : this.kecamatan,
                religion : this.religion,
                marriage_status : this.marriage_status,
                profession : this.profession,
                nationality : this.nationality
            };
        }
    },
    methods : {
        get,
        submitForm(){
            this.disableSubmit = true;
            axios.post(
                this.submit_url, this.formData
            ).then(response => {
                this.disableSubmit = false;
                this.resetForm();
                swal({
                    icon : "success",
                    title : "Data berhasil dimasukkan",
                    button : "Ok"
                }).then((ok) => {
                    if(ok) window.location.replace(this.redirect_url);
                    this.disableSubmit = false;
                })
            }).catch(e => {
                this.errors = e.response.data;
                this.disableSubmit = false;
            });
        },
        resetForm(){
            this.name = '';
            this.birthdate = new Date('2000-01-01');
            this.birthplace = '';
            this.gender = "laki-laki",
            this.address = '';
            this.rt = '';
            this.rw = '';
            this.kelurahan = '';
            this.kecamatan = '';
            this.religion = "islam";
            this.marriage_status = "not_married";
            this.profession = '';
            this.nationality = '';
        }
    }
}
</script>