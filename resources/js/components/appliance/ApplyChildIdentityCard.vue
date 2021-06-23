<template>
    <div>
        <h5 class="text-center">Daftar Kartu Identitas Anak</h5>
        <hr>
        <form @submit.prevent="submitForm()" class="row" action="" method="post">
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Nama Lengkap Anak</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Nama Anak</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="name"
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
                        v-model="birthplace"
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
                        v-model="birthdate"
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
                    <select :class="{'is-invalid': get(this.errors, 'errors.gender[0]', false)}" v-model="gender" class="form-control">
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
                        v-model="family_card_number"
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
                        v-model="householder_name"
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
                        v-model="birth_certificate_number"
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Kewarganegaraan</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kewarganegaraan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="citizenship"
                        :readonly="true"
                        placeholder="Kewarganegaraan"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.citizenship[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.citizenship[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Alamat</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Alamat</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="address"
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
                        v-model="rt"
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
                        v-model="rw"
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
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Kecamatan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="kecamatan"
                        placeholder="Kecamatan"
                        type="text"
                        :readonly="true"
                        :class="{'is-invalid': get(this.errors, 'errors.kecamatan[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.kecamatan[0]', '')}}</div>
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
import { get } from 'lodash'
import moment from 'moment'
export default {
    props : [
        "redirect_url", "submit_url"
    ],
    data(){
        return {
            errors : '',
            name : '',
            birthplace : '',
            birthdate : new Date('2000-01-01'),
            gender : 'laki-laki',
            family_card_number : '',
            householder_name : '',
            birth_certificate_number : '',
            citizenship : 'WNI',
            address : '',
            rt : '',
            rw : '',
            kecamatan : 'Sajingan Besar',
            kelurahan : 'Desa Sanatab',
            religion : 'islam',
            disableSubmit : false,
            document : '',
            type : "Baru"
        }
    },
    computed :{
        formData(){
            let data = {
                name : this.name,
                gender : this.gender,
                birthplace : this.birthplace,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                family_card_number : this.family_card_number,
                householder_name : this.householder_name,
                birth_certificate_number : this.birth_certificate_number,
                citizenship : this.citizenship,
                address : this.address,
                rt : this.rt,
                rw : this.rw,
                kecamatan : this.kecamatan,
                kelurahan : this.kelurahan,
                religion : this.religion,
                type : this.type
            };

            let formData = new FormData;
            for (let dataKey in data) {
                formData.append(dataKey, data[dataKey]);
            }
            formData.append('document', this.document);
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
                swal({
                    icon : "success",
                    title : "Data berhasil dimasukkan",
                    button : "Ok"
                }).then((ok) => {
                    if(ok) window.location.replace(this.redirect_url);
                    this.resetForm();
                })
            }).catch(e => {
                this.errors = e.response.data;
                this.disableSubmit = false;
            });
        },
        resetForm(){
                this.name = null;
                this.gender = 'laki-laki';
                this.birthplace = null,
                this.birthdate = new Date('2000-01-01'),
                this.family_card_number = null,
                this.householder_name = null,
                this.birth_certificate_number = null,
                this.citizenship = null,
                this.address = null,
                this.rt = null;
                this.rw = null;
                this.kecamatan = null;
                this.kelurahan = null;
                this.religion = 'islam';
                this.disableSubmit = false;
                this.document = '';
                this.type = 'Baru';
                document.getElementById('document').value = '';
        },
        assignDocument(event){
            this.document = event.target.files[0];
        }
    }
}
</script>
