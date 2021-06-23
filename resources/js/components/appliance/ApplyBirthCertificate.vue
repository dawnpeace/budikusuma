<template>
    <div>
        <h5 class="text-center">Daftar Akta Kelahiran</h5>
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">No KTP Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">No KTP Ibu</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="mother_identity_card_number"
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
                        v-model="mother_name"
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
                        v-model="father_identity_card_number"
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
                        v-model="father_name"
                        placeholder="Nama Ayah"
                        type="text"
                        :class="{'is-invalid': get(this.errors, 'errors.father_name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.father_name[0]', '')}}</div>
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
            errors : null,
            name : '',
            gender : 'laki-laki',
            birthdate : new Date('2000-01-01'),
            birthplace : '',
            mother_identity_card_number : '',
            mother_name : '',
            father_identity_card_number : '',
            father_name : '',
            disableSubmit : false,
            document : '',
            type : 'Baru'
        }
    },
    computed :{
        formData(){
            let data = {
                name : this.name,
                gender : this.gender,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                birthplace : this.birthplace,
                mother_identity_card_number : this.mother_identity_card_number,
                mother_name : this.mother_name,
                father_identity_card_number : this.father_identity_card_number,
                father_name : this.father_name,
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
                this.disableSubmit = true;
                swal({
                    title  : 'Data berhasil dimasukkan!',
                    button : 'Ok',
                    icon : 'success'
                }).then( ok => {
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
            this.birthdate = null;
            this.birthplace = new Date('2000-01-01');
            this.mother_identity_card_number = null;
            this.mother_name = null;
            this.father_identity_card_number = null;
            this.father_name = null;
            this.disableSubmit = false;
            document.getElementById('document').value = ''
            this.document = '';
            this.type = '';
        },
        assignDocument(event){
            this.document = event.target.files[0];
        }

    }
}
</script>
