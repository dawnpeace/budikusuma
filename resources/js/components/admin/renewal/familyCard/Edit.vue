<template>
    <form action="" class="w-100 mb-3">
        <div class="card card-body mb-3">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Daftar Kartu Keluarga <span class="text-capitalize">{{card.householder}}</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Status Dokumen</label>
                            <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Status Dokumen</label>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <select :class="{'is-invalid': get(errors, 'errors.status[0]', '')}" v-model="status" class="form-control">
                                    <option value="00">Tunggu</option>
                                    <option value="01">Dalam Proses</option>
                                    <option value="02">Diterima</option>
                                    <option value="03">Ditolak</option>
                                    <option value="04">Selesai</option>
                                </select>
                                <div class="invalid-feedback">{{get(errors, 'errors.status[0]', '')}}}</div>
                                <small class="text-right">*Apabila Dokumen ditandai selesai maka data akan tersinkronisasikan dengan data arsip</small>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Catatan Petugas</label>
                            <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Catatan Petugas</label>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <input :class="{'is-invalid' : get(errors, 'errors.reason[0]')}" type="text" v-model="reason" class="form-control">
                                <div class="invalid-feedback">{{get(errors, 'errors.reason[0]', '')}}}</div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" @click="viewOriginalDoc" class="btn btn-primary btn-sm">Lihat Dokumen Asli</button>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.householder_name[0]', '')"
                        name="householder_name"
                        title="Nama Kepala Keluarga"
                        v-model="householder"
                        placeholder="Nama Kepala Keluarga"
                    />
                </div>

                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.householder_id_card[0]', '')"
                        name="householder_id_card"
                        title="No Identitas Kepala Keluarga"
                        v-model="householder_id_card"
                        placeholder="No Identitas Kepala Keluarga"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.address[0]', '')"
                        name="address"
                        title="Alamat"
                        v-model="address"
                        placeholder="Alamat"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.zipcode[0]', '')"
                        name="zipcode"
                        title="Kode POS"
                        v-model="zipcode"
                        placeholder="Kode POS"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kelurahan</label>
                            <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kelurahan</label>
                        </div>
                        <div class="form-group col-md-9 col-sm-12">
                            <select :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}" v-model="kelurahan"  class="form-control">
                                <option selected value="Desa Sanatab">Desa Sanatab</option>
                                <option value="Sanataban">Sanataban</option>
                                <option value="Sungai Bening">Sungai Bening</option>
                                <option value="Kaliau">Kaliau</option>
                                <option value="Sebunga">Sebunga</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kecamatan[0]', '')"
                        name="kecamatan"
                        title="Kecamatan"
                        v-model="kecamatan"
                        placeholder="Kecamatan"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.rt[0]', '')"
                        name="rt"
                        title="RT"
                        v-model="rt"
                        placeholder="RT"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.rw[0]', '')"
                        name="rw"
                        title="RW"
                        v-model="rw"
                        placeholder="RW"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kabupaten[0]', '')"
                        name="kabupaten"
                        title="Kabupaten / Kota"
                        v-model="kabupaten"
                        readonly="true"
                        placeholder="Kabupaten / Kota"
                    />
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <side-label
                        :error="get(errors, 'errors.provinsi[0]', '')"
                        name="provinsi"
                        title="Provinsi"
                        readonly="true"
                        v-model="provinsi"
                        placeholder="Provinsi"
                    />
                </div>

                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No Kartu</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">No Kartu</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <input
                            placeholder="No Kartu"
                            type="text"
                            readonly="readonly"
                            :value="card.id_card"
                            :class="{'is-invalid': get(this.errors, 'errors.id_card[0]', false)}"
                            class="form-control">
                        <div class="invalid-feedback">{{get(this.errors, 'errors.id_card[0]', '')}}</div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Keterangan</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Keterangan</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        {{note}}
                    </div>
                </div>
            </div>
        </div>

        <div v-for="(family, index) in members" v-bind:key="index" class="card card-body mb-3">
            <div class="d-flex justify-content-end">
                <button v-show="index > 0" @click="removeFamilyMember(index)" class="btn btn-danger btn-sm" type="button">Hapus</button>
            </div>

            <div class="clearfix"></div>
            <h5 class="text-center mb-3">{{defaultLabelling(index, "Kepala Keluarga", "Anggota Keluarga")}}</h5>
            <side-label
                :error="getDynamicError('name', index)"
                name="name"
                :title="defaultLabelling(index, 'Kepala Keluarga', 'Anggota Keluarga')"
                v-model.lazy="family.name"
                :placeholder="defaultLabelling(index, 'Kepala Keluarga', 'Anggota Keluarga')"
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
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Jenis Kelamin</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Jenis Kelamin</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('gender', index)}" v-model="family.gender" class="form-control">
                            <option value="laki-laki" selected>Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('gender', index)}}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Lahir</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Lahir</label>
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
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Agama</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Agama</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('religion', index)}" v-model="family.religion"  id="" class="form-control">
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

            <side-label
                :error="getDynamicError('education', index)"
                name="education"
                title="Pendidikan"
                v-model="family.education"
                placeholder="Pendidikan"
            />

            <side-label
                :error="getDynamicError('profession', index)"
                name="profession"
                title="Pekerjaan"
                v-model="family.profession"
                placeholder="Pekerjaan"
            />


            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Status Hubungan Dalam Keluarga</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Status Hubungan Dalam Keluarga</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('religion', index)}" v-model="family.family_relation"  class="form-control">
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Family Lain">Family Lain</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('religion', index)}}</div>
                    </div>
                </div>
            </div>


        </div>
        <div class="d-flex justify-content-center">
            <button :disabled="hasSubmitted || this.card.status === '04'" @click="submitForm" type="button" class="btn btn-small btn-primary">Perbaharui Permintaan</button>
        </div>

    </form>
</template>
<script>

import {get, cloneDeep} from 'lodash'
import moment from 'moment'

export default {
    props : [
        "redirect_url", "submit_url", "card", "submit_url", "stored_url"
    ],
    data(){
        return {
            hasSubmitted : false,
            errors : '',
            householder : this.card.householder,
            address : this.card.address,
            rt : this.card.rt,
            rw : this.card.rw,
            zipcode : this.card.zip_code,
            kecamatan : this.card.kecamatan,
            kabupaten : this.card.kabupaten,
            kelurahan : this.card.kelurahan,
            provinsi : this.card.provinsi,
            householder_id_card : this.card.householder_id_card,
            members : [
                ...this.card.members
            ],
            status : this.card.status,
            note : this.card.note,
            reason : this.card.reason
        }
    },
    methods : {
        get,
        cloneDeep,
        addFamilyMember(){
            let family = {
                name : '',
                gender : 'laki-laki',
                birthdate : new Date('1990-01-01'),
                birthplace : '',
                religion : 'islam',
                education : '',
                profession : '',
                family_relation : 'Kepala Keluarga'
            };
            this.members.push(family);
        },
        removeFamilyMember(index){
            swal({
                title : "Konfirmasi Aksi",
                text : "Anda yakin ingin menghapus Data ?",
                icon : "warning",
                buttons : true,
                dangerMode : true,
            })
                .then( willDelete => {
                    if(index > 0) this.members.splice(index,1);
                });
        },
        defaultLabelling(index, mainLabel, secondaryLabel){
            return index === 0 ? mainLabel : secondaryLabel;
        },
        submitForm(){
            this.hasSubmitted = true;
            axios.post(
                this.submit_url,
                this.formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
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
                    this.errors = e.response.data;
                    this.hasSubmitted = false;
                });
        },
        getDynamicError(attribute, index){
            let message = get(this.errors, ['errors','members.' + index + '.' +attribute, 0], '');
            return message.replace(/.[0-9]./, " ");
        },
        assignDocument(event){
            this.document = event.target.files[0];
        },
        viewOriginalDoc(){
            window.open(this.stored_url, '_blank');
        }
    },
    computed : {
        computedMember(){
            let data = cloneDeep(this.members);
            data.forEach((item, index) =>{
                data[index].birthdate = moment(data[index].birthdate).format('DD-MM-YYYY').toString();
            });
            return data;
        },
        formData(){
            let mainData =  {
                householder : this.householder,
                address : this.address,
                rt : this.rt,
                rw : this.rw,
                zip_code : this.zipcode,
                kecamatan : this.kecamatan,
                kabupaten : this.kabupaten,
                kelurahan : this.kelurahan,
                provinsi : this.provinsi,
                householder_id_card : this.householder_id_card,
                reason : this.reason,
                status : this.status
            };
            let membersData = this.computedMember;

            let form = new FormData();
            for (let mainDataKey in mainData) {
                form.append(mainDataKey, mainData[mainDataKey]);
            }
            membersData.forEach(function (value, index) {
                for (let valueKey in value) {
                    form.append(`members[${index}][${valueKey}]`, value[valueKey]);
                }
            });
            // form.append('document', this.document);

            return form;
        }
    }
}
</script>
