<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Edit KIA</h5>
        <form @submit.prevent="updateRecord" action="" class="row" method="POST">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Pengajuan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Jenis Pengajuan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <p class="form-control border-0">{{card.type}}</p>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nomor Kartu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nomor Kartu</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Lengkap Anak</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Anak</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Tempat Lahir</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Tanggal Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Tanggal Lahir</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Kelamin</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Jenis Kelamin</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No. Kartu Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">No. Kartu Keluarga</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Kepala Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Kepala Keluarga</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nomor Akta Kelahiran</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nomor Akta Kelahiran</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Agama</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Agama</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="formData.religion" class="form-control">
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kewarganegaraan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kewarganegaraan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.citizenship"
                        placeholder="Kewarganegaraan"
                        :readonly="true"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.birth_certificate_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.birth_certificate_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Alamat</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Alamat</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RT</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">RT</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RW</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">RW</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kelurahan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kelurahan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <div class="form-group">
                        <select :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}" v-model="formData.kelurahan"  class="form-control">
                            <option selected value="Desa Sanatab">Desa Sanatab</option>
                            <option value="Sanataban">Sanataban</option>
                            <option value="Sungai Bening">Sungai Bening</option>
                            <option value="Kaliau">Kaliau</option>
                            <option value="Sebunga">Sebunga</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kelurahan[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kecamatan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.kecamatan"
                        placeholder="Kecamatan"
                        :readonly="true"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.kecamatan[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kecamatan[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Status Dokumen</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Status Dokumen</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.status[0]', false)}" v-model="formData.status" class="form-control">
                        <option value="00">Tunggu</option>
                        <option value="01">Dalam Proses</option>
                        <option value="02">Diterima</option>
                        <option value="03">Ditolak</option>
                        <option value="04">Selesai</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.status[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Keterangan </label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Keterangan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.reason"
                        placeholder="Keterangan"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.reason[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.reason[0]', '')}}</div>
                </div>
            </div>

            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary mx-1 btn-sm" type="submit">Perbaharui</button>
                <a class="btn btn-info btn-sm mx-1" :href="this.media_url">Download Dokumen Pendukung</a>
                <button @click="deleteRecord" class="btn btn-danger mx-1 btn-sm" type="button">Hapus</button>
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
                citizenship : get(this.card, 'citizenship', 'WNI'),
                rt : get(this.card, 'rt', ''),
                rw : get(this.card, 'rw', ''),
                kelurahan : get(this.card, 'kelurahan', ''),
                kecamatan : get(this.card, 'kecamatan', ''),
                religion : get(this.card, 'religion', ''),
                nationality : get(this.card, 'nationality', ''),
                status : get(this.card, 'status', '00'),
                reason : get(this.card, 'reason', '00'),
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
       deleteRecord(){
           confirmationModal()
            .then(response => {
                if(response.isConfirmed){
                    axios.post(this.delete_url)
                    .then(response => {
                        successModal({title : 'Data berhasil dihapus!', showCancelButton : false})
                            .then(response => {
                                location.replace(this.redirect_url)
                            });
                    })
                    .catch(e => {
                        console.log(e);
                    });
                }
            });

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
