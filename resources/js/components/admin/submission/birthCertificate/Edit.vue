<template>
    <div>
        <h5 class="text-center">Daftar Akta Kelahiran</h5>
        <hr>
        <form @submit.prevent="updateRecord()" class="row" action="" method="post">

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Pengajuan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Jenis Pengajuan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <p class="form-control border-0">{{card.type}}</p>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No Akta</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">No Akta</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.id_card"
                        placeholder="No Akta"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.id_card[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.id_card[0]', '')}}</div>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No KTP Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">No KTP Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.mother_identity_card_number"
                        placeholder="No KTP Ibu"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.mother_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_identity_card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.mother_name"
                        placeholder="Nama Ibu"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.mother_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No KTP Ayah</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">No KTP Ayah</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.father_identity_card_number"
                        placeholder="No KTP Ayah"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.father_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_identity_card_number[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Ayah</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Ayah</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="formData.father_name"
                        placeholder="Nama Ayah"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.father_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_name[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Status Dokumen</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Status Dokumen</label>
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
                <button :disabled="disableSubmit" class="btn btn-primary mx-1" type="submit">Submit</button>
                <a class="btn btn-info btn-sm mx-1" :href="this.media_url">Download Dokumen Pendukung</a>
                <button @click="deleteRecord" class="btn btn-danger mx-1 btn-sm" type="button">Hapus</button>
            </div>
        </form>
    </div>
</template>
<script>
import { get, cloneDeep } from 'lodash'
import moment from 'moment'
import {confirmationModal, errorModal, successModal} from '../../../../helper'
export default {
    props : [
        "card", "redirect_url", "submit_url", "media_url"
    ],
    data(){
        return {
            errors : null,
            formData : {
                ...this.card,
                birthdate : new Date(this.card.birthdate)
            },
            disableSubmit : false,
        }
    },
    computed :{
        form(){
            let birthdate = cloneDeep(this.formData.birthdate);
            return {
                ...this.formData,
                birthdate : moment(birthdate).format('DD-MM-YYYY')
            }
        }
    },
    methods : {
        get,
        cloneDeep,
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
