<template>
    <div>
        <h5 class="text-center">Daftar E-KTP</h5>
        <hr>
        <form id="submission" @submit.prevent="submitForm()" class="row" action="">

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Pengajuan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Jenis Pengajuan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.type[0]', false)}" v-model="type" class="form-control">
                        <option value="Baru" selected>Baru</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Hilang">Hilang</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.type[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Pemilik</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Pemilik</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Jenis Kelamin</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Jenis Kelamin</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Tempat Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Tempat Lahir</label>
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
                    v-model="birthdate"
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RT</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">RT</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">RW</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">RW</label>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kelurahan / Desa</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Kelurahan / Desa</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.kelurahan[0]', false)}" v-model="kelurahan"  class="form-control">
                        <option selected value="Desa Sanatab">Desa Sanatab</option>
                        <option value="Sanataban">Sanataban</option>
                        <option value="Sungai Bening">Sungai Bening</option>
                        <option value="Kaliau">Kaliau</option>
                        <option value="Sebunga">Sebunga</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kecamatan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                    v-model="kecamatan"
                    :readonly="true"
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.profession[0]', false)}" v-model="profession"  class="form-control">
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.religion[0]', false)}" v-model="religion"  class="form-control">
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.marriage_status[0]', false)}" v-model="marriage_status" class="form-control">
                        <option selected value="not_married">Belum Kawin</option>
                        <option value="married">Kawin</option>
                        <option value="widower">Duda / Janda</option>
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
                        v-model="nationality"
                        placeholder="Kewarganegaraan"
                        :class="{'is-invalid': get(this.errors, 'errors.nationality[0]', false)}"
                        type="text"
                        :readonly="true"
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.nationality[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Dokumen Pendukung</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none">Dokumen Pendukung</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        @change="assignDocument"
                        placeholder="Dokumen Pendukung"
                        type="file"
                        id="document"
                        ref="document"
                        :class="{'is-invalid': get(this.errors, 'errors.document[0]', false)}"
                        class="form-control">
                    <div class="invalid-feedback">{{get(this.errors, 'errors.document[0]', '')}}</div>
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
            name : '',
            birthplace : '',
            birthdate : new Date('2000-01-01'),
            gender : "laki-laki",
            address : '',
            rt : '',
            rw : '',
            kelurahan : 'Desa Sanatab',
            kecamatan : 'Sajingan Besar',
            religion : "islam",
            marriage_status : "not_married",
            profession : 'Tidak Bekerja',
            nationality : 'WNI',
            submitted : false,
            disableSubmit : false,
            document : '',
            type : 'Baru'
        }
    },
    computed :{
        formData(){
            let data = {
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
                nationality : this.nationality,
                document : this.document,
                type : this.type
            };
            let formData = new FormData();
            for (let dataKey in data) {
                formData.append(dataKey, data[dataKey]);
                console.log(data[dataKey])
            }
            return formData;
        }
    },
    methods : {
        get,
        submitForm(){
            this.disableSubmit = true;
            axios.post(
                this.submit_url,
                this.formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
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
            document.getElementById("document").value = '';
            this.type = '';
        },
        assignDocument(event){
            this.document = event.target.files[0];
        }
    }
}
</script>
