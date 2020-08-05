<template>
    <form action="" class="w-100">
        <div class="card card-body mb-3">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Daftar Kartu Keluarga</h5>
                    <hr>
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.householder_name[0]', '')" 
                        name="householder_name" 
                        title="Nama Kepala Keluarga" 
                        v-model="householder_name"
                        placeholder="Nama Kepala Keluarga"
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
                        :error="get(errors, 'errors.householder_id_card[0]', '')" 
                        name="householder_id_card" 
                        title="No Identitas Kepala Keluarga" 
                        v-model="householder_id_card"
                        placeholder="No Identitas Kepala Keluarga"
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
                        :error="get(errors, 'errors.zipcode[0]', '')" 
                        name="zipcode" 
                        title="Kode POS" 
                        v-model="zipcode"
                        placeholder="Kode POS"
                    />
                </div>
                <div class="col-md-6 col-sm-12">
                    <side-label
                        :error="get(errors, 'errors.kelurahan[0]', '')" 
                        name="kelurahan" 
                        title="Desa / Kelurahan" 
                        v-model="kelurahan"
                        placeholder="Desa / Kelurahan"
                    />
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
                        :error="get(errors, 'errors.kabupaten[0]', '')" 
                        name="kabupaten" 
                        title="Kabupaten / Kota" 
                        v-model="kabupaten"
                        placeholder="Kabupaten / Kota"
                    />
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <side-label
                        :error="get(errors, 'errors.provinsi[0]', '')" 
                        name="provinsi" 
                        title="Provinsi" 
                        v-model="provinsi"
                        placeholder="Provinsi"
                    />
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
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Status Perkawinan</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Status Perkawinan</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('marriage_status', index)}" v-model="family.marriage_status"  id="" class="form-control">
                            <option value="not_married">Belum Kawin</option>
                            <option value="married">Kawin</option>
                            <option value="widowed">Duda / Janda</option>
                        </select>
                        <div class="invalid-feedback">{{getDynamicError('marriage_status', index)}}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Jenis Kelamin</label>
                    <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Jenis Kelamin</label>
                </div>
                <div class="col-md-9 col-sm-12">  
                    <div class="form-group">
                        <select :class="{'is-invalid': getDynamicError('gender', index)}" v-model="family.gender" id="" class="form-control">
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
            
            <side-label
                :error="getDynamicError('family_relation', index)" 
                name="family_relation" 
                title="Status Hubungan Dalam Keluarga" 
                v-model="family.family_relation"
                placeholder="Status Hubungan Dalam Keluarga"
                />
        </div>
        <div class="d-flex justify-content-center mb-3">
            <button @click="addFamilyMember" type="button" class="btn btn-small btn-secondary">Tambah Anggota Keluarga</button>
        </div>
        <div class="d-flex justify-content-center">
            <button :disabled="hasSubmitted" @click="submitForm" type="button" class="btn btn-small btn-primary">Masukkan Data KK</button>
        </div>
        
    </form>
</template>
<script>

import {get, cloneDeep} from 'lodash'
import moment from 'moment'
export default {
    props : [
        "redirect_url", "submit_url"
    ],
    data(){
        return {
            hasSubmitted : false,
            errors : null,
            householder_name : null,
            address : null,
            rt : null,
            rw : null,
            zipcode : null,
            kecamatan : null,
            kabupaten : null,
            kelurahan : null,
            provinsi : null,
            householder_id_card : null,
            members : [
               {
                    name : this.houseHolderName,
                    marriage_status : 'not_married',
                    gender : 'laki-laki',
                    id_card : null,
                    birthdate : new Date('1990-01-01'),
                    birthplace : null,
                    religion : 'islam',
                    education : null,
                    profession : null,
                    family_relation : 'Kepala Keluarga'
                }
            ]

        }
    },
    methods : {
        get,
        cloneDeep,
        addFamilyMember(){
            let family = {
                name : null,
                marriage_status : 'not_married',
                gender : 'laki-laki',
                birthdate : new Date('1990-01-01'),
                birthplace : null,
                religion : 'islam',
                education : null,
                profession : null,
                family_relation : null
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
            axios.post(this.submit_url, this.formData)
                .then(response => {
                    console.log(response);
                })
                .catch(e => {
                    console.log(e);
                    this.errors = e.response.data;
                    this.hasSubmitted = false;
                });
        },
        getDynamicError(attribute, index){
            return get(this.errors, ['errors','members.' + index + '.' +attribute, 0], '');
        }
    },
    computed : {
        houseHolderName(){
            return this.householder_name;
        },
        houseHolderIdCard(){
            return this.householder_id_card;
        },
        computedMember(){
            let data = cloneDeep(this.members);
            data.forEach((item, index) =>{
                data[index].birthdate = moment(data[index].birthdate).format('DD-MM-YYYY').toString();
            });
            return data;
        },
        formData(){
            return {
                householder_name : this.householder_name,
                address : this.address,
                rt : this.rt,
                rw : this.rw,
                zipcode : this.zipcode,
                kecamatan : this.kecamatan,
                kabupaten : this.kabupaten,
                kelurahan : this.kelurahan,
                provinsi : this.provinsi,
                members : this.computedMember,
                householder_id_card : this.householder_id_card
            };
        }
    },
    watch : {
        houseHolderName(){
            this.members[0].name = this.householder_name;
        },
        houseHolderIdCard(){
            this.members[0].id_card = this.householder_id_card;
        }
    }
}
</script>
