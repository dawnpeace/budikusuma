<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Edit Arsip E-KTP</h5>
        <form @submit.prevent="updateRecord" action="" class="row" method="POST">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nomor Kartu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nomor Kartu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.identity_card_number"
                        placeholder="Nomor Kartu"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.identity_card_number[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Pemilik</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Pemilik</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.name"
                        placeholder="Nama Pemilik"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.name[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Kelamin</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Jenis Kelamin</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select name="gender" :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="formData.gender" class="form-control">
                        <option value="laki-laki" selected>Laki - laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.gender[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Tempat Lahir</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Tanggal Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Tanggal Lahir</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <datepicker
                    input-class="form-control"
                    id="birthdate"
                    format="dd-MM-yyyy"
                    name="birthdate"
                    v-model="formData.birthdate"
                    placeholder="Tanggal Lahir"
                    :class="{'is-invalid': get(this.errors, 'errors.birthdate[0]', false)}"
                    ></datepicker>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birthdate[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Alamat</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Alamat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="formData.address"
                    placeholder="Alamat"
                    name="alamat"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.address[0]', false)}"
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.address[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RT</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">RT</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="formData.rt"
                    placeholder="RT"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.rt[0]', false)}"
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rt[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RW</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">RW</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="formData.rw"
                    placeholder="RW"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.rw[0]', false)}"
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rw[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kelurahan / Desa</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Kelurahan / Desa</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="formData.kelurahan"
                    placeholder="Kelurahan / Desa"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}"
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kelurahan[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kecamatan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="formData.kecamatan"
                    placeholder="Kecamatan"
                    type="text"
                    :class="{'is-invalid': get(this.errors, 'errors.kecamatan[0]', false)}"
                    class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kecamatan[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Pekerjaan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Pekerjaan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.profession[0]', false)}" v-model="formData.profession"  class="form-control">
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                        <option value="Petani / Berkebun">Petani / Berkebun</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                        <option value="TNI">TNI</option>
                        <option value="POLRI">POLRI</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.profession[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Agama</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Agama</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="formData.religion" class="form-control">
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Status Perkawinan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Status Perkawinan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.marriage_status[0]', false)}" v-model="formData.marriage_status"  class="form-control">
                        <option value="not_married">Belum Kawin</option>
                        <option value="married">Kawin</option>
                        <option value="widowed">Duda / Janda</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.marriage_status[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kewarganegaraan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Kewarganegaraan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.nationality"
                        placeholder="Kewarganegaraan"
                        :class="{'is-invalid': get(this.errors, 'errors.nationality[0]', false)}"
                        type="text"
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.nationality[0]', '')}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary mx-1 btn-sm" type="submit">Perbaharui</button>
                <a class="btn btn-info btn-sm mx-1" :href="this.media_url">Download Dokumen Pendukung</a>

            </div>
        </form>
    </div>

</template>

<script>
import {get, cloneDeep} from 'lodash'
import moment from 'moment'
import {confirmationModal, errorModal, successModal} from '../../../../helper'
export default {
    props : [
        'card', 'submit_url', 'redirect_url', 'media_url'
    ],
   data(){
       return {
           errors : null,
           disableSubmit : false,
           formData : {
               identity_card_number : get(this.card, 'identity_card_number', ''),
               name : get(this.card, 'name', ''),
               gender : get(this.card, 'gender', 'laki-laki'),
               address : get(this.card, 'address', ''),
               birthplace : get(this.card, 'birthplace', ''),
               birthdate : this.getBirthdate(),
               rt : get(this.card, 'rt', ''),
               rw : get(this.card, 'rw', ''),
               kelurahan : get(this.card, 'kelurahan', ''),
               kecamatan : get(this.card, 'kecamatan', ''),
               religion : get(this.card, 'religion', ''),
               marriage_status : get(this.card, 'marriage_status', 'not_married'),
               profession : get(this.card, 'profession', ''),
               nationality : get(this.card, 'nationality', '')
           }
       }
   },
   computed :{
       form(){
           return {
               identity_card_number : this.formData.identity_card_number,
               name : this.formData.name,
               gender : this.formData.gender,
               address : this.formData.address,
               birthplace : this.formData.birthplace,
               birthdate : this.getLocaleBirthdate(),
               rt : this.formData.rt,
               rw : this.formData.rw,
               kelurahan : this.formData.kelurahan,
               kecamatan : this.formData.kecamatan,
               religion : this.formData.religion,
               marriage_status : this.formData.marriage_status,
               profession : this.formData.profession,
               nationality : this.formData.nationality,
           }
       }
   },
   methods : {
       get,
       cloneDeep,
       confirmationModal,
       successModal,
       getLocaleBirthdate(){
           let birthdate = get(this.card ,'birthdate', null);
           let date = new Date(this.cloneDeep(birthdate));
           return moment(date).format('DD-MM-YYYY');
       },
       getBirthdate(){
           return new Date(this.card.birthdate);
       },
       updateRecord(){
           confirmationModal()
            .then(ok => {
                if(ok.isConfirmed){
                    axios.post(this.submit_url, this.form)
                        .then(response => {
                            successModal({title : 'Data berhasil diperbaharui!', showCancelButton : false})
                                .then(response => location.replace(this.redirect_url));
                        })
                        .catch(err => {
                            this.errors = err.response.data;
                        })
                }
            })
       }
   }
}
</script>
