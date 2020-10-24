<template>
    <div class="w-100">
        <h5 class="text-center mt-3 mb-5">Edit E-KTP</h5>
        <form @submit.prevent="updateRecord" action="" class="row" method="POST">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nomor Kartu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nomor Kartu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                        v-model="formData.id_card" 
                        placeholder="Nomor Kartu" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.id_card[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.id_card[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Pemilik</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Pemilik</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Jenis Kelamin</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Jenis Kelamin</label>
            </div>
            <div class="col-md-9 col-sm-12">  
                <div class="form-group">
                    <select name="gender" :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="formData.gender" id="" class="form-control">
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
                    name="birthdate"
                    v-model="formData.birthdate"
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RT</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">RT</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">RW</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">RW</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kelurahan / Desa</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Kelurahan / Desa</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Kecamatan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Kecamatan</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Pekerjaan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Pekerjaan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input 
                    v-model="formData.profession" 
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="formData.religion"  id="" class="form-control">
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.marriage_status[0]', false)}" v-model="formData.marriage_status"  id="" class="form-control">
                        <option value="not_married">Belum Kawin</option>
                        <option value="married">Kawin</option>
                        <option value="widowed">Duda / Janda</option>
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
                        v-model="formData.nationality" 
                        placeholder="Kewarganegaraan"
                        :class="{'is-invalid': get(this.errors, 'errors.nationality[0]', false)}"
                        type="text"
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.nationality[0]', '')}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Status Dokumen</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Status Dokumen</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.status[0]', false)}" v-model="formData.status"  id="" class="form-control">
                        <option value="00">Tunggu</option>
                        <option value="01">Dalam Proses</option>
                        <option value="02">Diterima</option>
                        <option value="03">Ditolak</option>
                        <option value="04">Selesai</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.status[0]', '')}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-center col-12 pt-3">
                <button :disabled="disableSubmit" class="btn btn-primary mx-1 btn-sm" type="submit">Perbaharui</button>
                <button :disabled="disableDelete" @click="deleteRecord" class="btn btn-danger mx-1 btn-sm" type="button">Hapus</button>
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
        'card', 'submit_url', 'delete_url', 'redirect_url'
    ],
   data(){
       return {
           errors : null,
           disableSubmit : false,
           disableDelete : false,
           formData : {
               id_card : get(this.card, 'id_card', ''),
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
               nationality : get(this.card, 'nationality', ''),
               status : get(this.card, 'status', '00')
           }
       }
   },
   computed :{
       form(){
           return {
               ...this.formData,
               birthdate : this.getLocaleBirthdate(),
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
       deleteRecord(){
           confirmationModal()
            .then(response => {
                this.disableDelete = true;
                if(response.isConfirmed){
                    axios.post(this.delete_url)
                    .then(response => {
                        this.disableSubmit = false;
                        successModal({title : 'Data berhasil dihapus!', showCancelButton : false})
                            .then(response => {
                                location.replace(this.redirect_url) 
                            });
                    })
                    .catch(e => {
                        this.disableDelete = false;
                        console.log(e);
                    });
                }
            });
           
       },
       updateRecord(){
           confirmationModal()
            .then(ok => {
                this.disableSubmit = true;
                if(ok.isConfirmed){
                    axios.post(this.submit_url, this.form)
                        .then(response => {
                            successModal({title : 'Data berhasil diperbaharui!', showCancelButton : false})
                                .then(response => location.replace(this.redirect_url));
                        })
                        .catch(err => {
                            this.errors = err.response.data;
                            this.disableSubmit = false;
                        })
                }
            })
       }
   }
}
</script>