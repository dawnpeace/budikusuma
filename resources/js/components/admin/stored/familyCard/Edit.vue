<template>
    <form action="" class="w-100 mb-3">
        <div class="card card-body mb-3">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Edit Arsip Kartu Keluarga</h5>
                    <hr>
                </div>

                <div class="d-none d-md-block d-sm-none col-12 mb-5 px-5">
                    <div class="form-group">
                        <label class="text-center w-100">Nomor Kartu Keluarga</label>
                        <input v-model="formData.id_card" type="text" class="form-control">
                    </div>
                </div>

                <div class="d-sm-block d-md-none col-12">
                    <div class="form-group">
                        <label>Nomor Kartu Keluarga</label>
                        <input v-model="formData.id_card" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.householder[0]', '')"
                        name="householder"
                        title="Nama Kepala Keluarga"
                        v-model="formData.householder"
                        placeholder="Nama Kepala Keluarga"
                    />
                </div>

                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.householder_id_card[0]', '')"
                        name="householder_id_card"
                        title="No Identitas Kepala Keluarga"
                        v-model="formData.householder_id_card"
                        placeholder="No Identitas Kepala Keluarga"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.address[0]', '')"
                        name="address"
                        title="Alamat"
                        v-model="formData.address"
                        placeholder="Alamat"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.zip_code[0]', '')"
                        name="zip_code"
                        title="Kode POS"
                        v-model="formData.zip_code"
                        placeholder="Kode POS"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kelurahan[0]', '')"
                        name="kelurahan"
                        title="Desa / Kelurahan"
                        v-model="formData.kelurahan"
                        placeholder="Desa / Kelurahan"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kecamatan[0]', '')"
                        name="kecamatan"
                        title="Kecamatan"
                        v-model="formData.kecamatan"
                        placeholder="Kecamatan"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.rt[0]', '')"
                        name="rt"
                        title="RT"
                        v-model="formData.rt"
                        placeholder="RT"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.rw[0]', '')"
                        name="rw"
                        title="RW"
                        v-model="formData.rw"
                        placeholder="RW"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kabupaten[0]', '')"
                        name="kabupaten"
                        title="Kabupaten / Kota"
                        v-model="formData.kabupaten"
                        placeholder="Kabupaten / Kota"
                    />
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <side-label
                        :error="get(errors, 'errors.provinsi[0]', '')"
                        name="provinsi"
                        title="Provinsi"
                        v-model="formData.provinsi"
                        placeholder="Provinsi"
                    />
                </div>
            </div>
        </div>

        <div v-for="(family, index) in formData.members" v-bind:key="index" class="card card-body mb-3">
            <div class="d-flex justify-content-end">
                <button v-show="index > 0" @click="removeFamilyMember(index)" class="btn btn-danger btn-sm" type="button">Hapus</button>
            </div>

            <div class="clearfix"></div>
            <h5 class="text-center mb-3">Anggota Keluarga</h5>
            <side-label
                :error="getDynamicError('name', index)"
                name="name"
                title="Anggota Keluarga"
                v-model.lazy="family.name"
                placeholder="Anggota Keluarga"
                />

            <side-label
                :error="getDynamicError('id_card', index)"
                name="Nomor KTP"
                title="NIK"
                v-model="family.id_card"
                placeholder="Nomor Identitas"
                />

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" >Jenis Kelamin</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" >Jenis Kelamin</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('gender', index)}" v-model="family.gender"  class="form-control">
                            <option value="laki-laki" selected>Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('gender', index)}}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" >Tanggal Lahir</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" >Tanggal Lahir</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <datepicker
                        input-class="form-control"
                        format="dd-MM-yyyy"
                        v-model="family.birthdate"
                        placeholder="Tanggal Lahir"
                        :class="{'is-invalid':getDynamicError('birthdate', index)}"
                        ></datepicker>
                        <div class="invalid-feedback">{{getDynamicError('birthdate', index)}}</div>
                    </div>
                </div>
            </div>

            <side-label
                :error="getDynamicError('birthplace', index)"
                name="birthplace"
                title="Tempat Lahir"
                v-model="family.birthplace"
                placeholder="Tempat Lahir"
                />
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" >Agama</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" >Agama</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('religion', index)}" v-model="family.religion"   class="form-control">
                            <option value="islam">Islam</option>
                            <option value="kristen protestan">Kristen Protestan</option>
                            <option value="kristen katolik">Kristen Katolik</option>
                            <option value="buddha">Buddha</option>
                            <option value="hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('religion', index)}}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Pendidikan</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Pendidikan</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('education', index)}" v-model="family.education" class="form-control">
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/K">SMA/K</option>
                            <option value="Strata I">Strata I</option>
                            <option value="Strata II">Strata II</option>
                            <option value="Strata III">Strata III</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('education', index)}}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Pekerjaan</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Pekerjaan</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('profession', index)}" v-model="family.profession"  class="form-control">
                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                            <option value="Petani / Berkebun">Petani / Berkebun</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                            <option value="TNI">TNI</option>
                            <option value="POLRI">POLRI</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('profession', index)}}</div>
                    </div>
                </div>
            </div>

            <side-label
                :error="getDynamicError('family_relation', index)"
                name="family_relation"
                title="Status Hubungan Dalam Keluarga"
                v-model="family.family_relation"
                placeholder="Status Hubungan Dalam Keluarga"
                />


        </div>
        <div class="d-flex justify-content-center">
            <button :disabled="hasSubmitted" @click="submitForm" type="button" class="btn btn-small btn-primary mx-1">Perbaharui Data</button>
            <a class="btn btn-info btn-sm mx-1" :href="this.media_url">Download Dokumen Pendukung</a>
        </div>

    </form>
</template>
<script>

import {get, cloneDeep} from 'lodash'
import moment from 'moment'
import { confirmationModal, successModal } from '../../../../helper'

export default {
    props : [
        "redirect_url", "submit_url", "card", "delete_url", "media_url"
    ],
    data(){
        return {
            hasSubmitted : false,
            errors : null,
            formData : {
                householder : get(this.card, 'householder', ''),
                address : get(this.card, 'address', ''),
                rt : get(this.card, 'rt', ''),
                rw : get(this.card, 'rw', ''),
                zip_code : get(this.card, 'zip_code', ''),
                kecamatan : get(this.card, 'kecamatan', ''),
                kabupaten : get(this.card, 'kabupaten', ''),
                kelurahan : get(this.card, 'kelurahan', ''),
                provinsi : get(this.card, 'provinsi', ''),
                householder_id_card : get(this.card, 'householder_id_card', ''),
                status : get(this.card, 'status', ''),
                members : [
                    ...this.card.members
                ],
                id_card : get(this.card, 'id_card', ''),
            }
        }
    },
    methods : {
        get,
        cloneDeep,
        submitForm(){
            this.hasSubmitted = true;
            confirmationModal()
                .then(ok => {
                    if(ok.isConfirmed){
                        axios.post(this.submit_url, this.computedMember)
                            .then(response => {
                                swal({
                                    icon : 'success',
                                    title : 'Data berhasil dimasukkan',
                                    button : 'Ok'
                                }).then((ok) => {
                                    if(ok) location.replace(this.redirect_url);
                                    this.resetForm();
                                })
                            })
                            .catch(e => {
                                console.log(e);
                                this.errors = e.response.data;
                                this.hasSubmitted = false;
                            });
                    } else {
                        this.hasSubmitted = false;
                    }
                })
                .catch(dismiss => this.hasSubmitted = false)

        },
        getDynamicError(attribute, index){
            let message = get(this.errors, ['errors','members.' + index + '.' +attribute, 0], '');
            return message.replace(/.[0-9]./, " ");
        },
    },
    computed : {
        houseHolderName(){
            return this.householder_name;
        },
        houseHolderIdCard(){
            return this.householder_id_card;
        },
        computedMember(){
            let data = cloneDeep(this.formData);
            let members = data.members;
            members.forEach((item, index) =>{
                members[index].birthdate = moment(members[index].birthdate).format('DD-MM-YYYY').toString();
            });
            data.members = members;
            console.log(data);
            return data;
        },
    }
}
</script>
