<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Edit Arsip KIA</h5>
        <form @submit.prevent="updateRecord" action="" class="row" method="POST">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nomor Kartu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nomor Kartu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.card_number"
                        placeholder="Nomor Kartu"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Lengkap Anak</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Anak</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.name"
                        placeholder="Nama Anak"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Tempat Lahir</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.birthplace"
                        placeholder="Tempat Lahir"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.birthplace[0]', false)}"
                        class="form-control"/>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No. Kartu Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No. Kartu Keluarga</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.family_card_number"
                        placeholder="No. Kartu Keluarga"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.family_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.family_card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Kepala Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Kepala Keluarga</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.householder_name"
                        placeholder="Nama Kepala Keluarga"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.householder_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.householder_name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nomor Akta Kelahiran</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nomor Akta Kelahiran</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.birth_certificate_number"
                        placeholder="Nomor Akta Kelahiran"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.birth_certificate_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birth_certificate_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Agama</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Agama</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="formData.religion"  id="" class="form-control">
                        <option value="islam">Islam</option>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kewarganegaraan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Kewarganegaraan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.citizenship"
                        placeholder="Kewarganegaraan"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.citizenship[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.citizenship[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Alamat</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Alamat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.address"
                        placeholder="Alamat"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.address[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.address[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RT</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">RT</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.rt"
                        placeholder="RT"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.rt[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rt[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RW</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">RW</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.rw"
                        placeholder="RW"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.rw[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.rw[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kelurahan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Kelurahan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.kelurahan"
                        placeholder="Kelurahan"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kelurahan[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kecamatan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.kecamatan"
                        placeholder="Kecamatan"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.kecamatan[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kecamatan[0]', '')}}</div>
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
        'card', 'submit_url', 'delete_url', 'redirect_url', 'media_url'
    ],
    data(){
        return {
            errors : null,
            disableSubmit : false,
            formData : {
                card_number : get(this.card, 'card_number', ''),
                name : get(this.card, 'name', ''),
                gender : get(this.card, 'gender', 'laki-laki'),
                address : get(this.card, 'address', ''),
                birthplace : get(this.card, 'birthplace', ''),
                birthdate : new Date(get(this.card, 'birthdate', null)),
                family_card_number : get(this.card, 'family_card_number', ''),
                householder_name : get(this.card, 'householder_name', ''),
                birth_certificate_number : get(this.card, 'birth_certificate_number', ''),
                rt : get(this.card, 'rt', ''),
                rw : get(this.card, 'rw', ''),
                kelurahan : get(this.card, 'kelurahan', ''),
                kecamatan : get(this.card, 'kecamatan', ''),
                citizenship : get(this.card, 'citizenship', ''),
                religion : get(this.card, 'religion', ''),
                nationality : get(this.card, 'nationality', ''),
                status : get(this.card, 'status', '00')
            }
       }
   },
   computed :{
       form(){
           return {
               ...this.formData,
               birthdate : moment(this.formData.birthdate).format('DD-MM-YYYY')
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
