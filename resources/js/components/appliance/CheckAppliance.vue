<template>
    <div class="w-inherit">
        <div class="row">
            <h5 class="text-center col-12 mb-5">Periksa Status Permintaan Dokumen</h5>

            <div class="col-md-3 col-sm-12 mb-03">
                    <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">Dokumen</label>
                    <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">Dokumen</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <select @change="emptyError" v-model="document" class="form-control">
                            <option value="E-KTP">E-KTP</option>
                            <option value="KIA">KIA</option>
                            <option value="KK">KK</option>
                            <option value="AKTA_LAHIR">AKTA LAHIR</option>
                        </select>
                    </div>
                </div>
        </div>
        <form @submit.prevent="submitForm" class="row" action="">
            <div v-show="shouldHideElement('name')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama </label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama </label>
            </div>
            <div v-show="shouldHideElement('name')" class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="name" 
                        placeholder="Nama" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.name[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.name[0]', '')}}</div>
                </div>
            </div>

            <div v-show="shouldHideElement('householder')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Nama Kepala Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">Nama Kepala Keluarga</label>
            </div>
            <div v-show="shouldHideElement('householder')" class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="householder" 
                        placeholder="Nama Kepala Keluarga" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.householder[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.householder[0]', '')}}</div>
                </div>
            </div>

            <div v-show="shouldHideElement('householder_id_card')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">NIK Kepala Keluarga</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">NIK Kepala Keluarga</label>
            </div>
            <div v-show="shouldHideElement('householder_id_card')" class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="householder_id_card" 
                        placeholder="NIK Kepala Keluarga" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.householder_id_card[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.householder_id_card[0]', '')}}</div>
                </div>
            </div>

            <div v-show="shouldHideElement('family_card_number')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">No KK</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">No KK</label>
            </div>
            <div v-show="shouldHideElement('family_card_number')" class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="family_card_number" 
                        placeholder="Nomor Kartu Keluarga" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.family_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.family_card_number[0]', '')}}</div>
                </div>
            </div>

            <div v-show="shouldHideElement('mother_identity_card_number')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">NIK Ibu</label>
                <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none" for="">NIK Ibu</label>
            </div>
            <div v-show="shouldHideElement('mother_identity_card_number')" class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input
                        v-model="mother_identity_card_number" 
                        placeholder="NIK Ibu" 
                        type="text" 
                        :class="{'is-invalid': get(this.errors, 'errors.mother_identity_card_number[0]', false)}"
                        class="form-control"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.mother_identity_card_number[0]', '')}}</div>
                </div>
            </div>
            
            <div v-show="shouldHideElement('birthdate')" class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Lahir</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Lahir</label>
            </div>
            <div v-show="shouldHideElement('birthdate')" class="col-md-9 col-sm-12">
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
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Pengajuan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Pengajuan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <datepicker 
                        input-class="form-control"
                        id="submission_date"
                        format="dd-MM-yyyy"
                        v-model="submission_date"
                        placeholder="Tanggal Lahir" 
                        :class="{'is-invalid': get(this.errors, 'errors.submission_date[0]', false)}"/>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.submission_date[0]', '')}}</div>
                </div>
            </div>

            <div class="col-12 py-4">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary mx-1">Submit</button>
                    <button @click="emptySearch" v-show="data.length > 0" type="button" class="btn btn-sm btn-secondary mx-1">Hapus Pencarian</button>
                </div>
            </div>
        </form>
        <hr v-show="data.length != 0">
        <div v-show="data.length != 0" class="row mt-5">
            <h5 class="col-12 text-center mb-3">Hasil Pencarian</h5>
            <div class="col-12 table-responsive px-3 mb-3">
                <table v-for="(value, index) in data" :key="index" class="table table-sm table-bordered">
                    <tr v-for="(val, idx) in value" :key="idx">
                        <td class="px-2 py-1 font-weight-bold text-capitalize">{{pascalCaseConvert(idx)}}</td>
                        <td v-if="idx == 'status'" class="px-2 py-3">
                            <span :class="getBadgeClassByStatus(val)" class="badge">{{displayStatus(val)}}</span>
                        </td>
                        <td v-if="idx != 'status'" class="px-2 py-3">{{val}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
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
            errors : null,
            content : {
                "Nama" : "asun",
                "status" : "hold"
            },
            document : 'E-KTP',
            name : null,
            mother_identity_card_number : null,
            birthdate : new Date('2000-01-01'),
            submission_date : new Date(),
            householder : null,
            householder_id_card : null,
            family_card_number : null,
            data : [],
        }
    },
    computed:{
        idCardFormData(){
            return {
                name : this.name,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
            }
        },
        childIdCardFormData(){
            return {
                family_card_number : this.family_card_number,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
                name : this.name
            }
        },
        familyCardFormData(){
            return {
                householder_id_card : this.householder_id_card,
                householder : this.householder
            }
        },
        birthCertificateFormData(){
            return {
                name : this.name,
                mother_identity_card_number : this.mother_identity_card_number,
                birthdate : moment(this.birthdate).format("DD-MM-YYYY"),
            }
        }
    },
    methods:{
        get,
        cloneDeep,
        shouldHideElement(param){
            let paramIdCard = [
                'name', 'birthdate'
            ];
            let paramChildIdCard = [
                'family_card_number', 'birthdate', 'name'
            ];
            let paramFamilyCard = [
                'householder_id_card', 'householder'
            ];
            let paramBirthCertificate = [
                'name', 'mother_identity_card_number', 'birthdate'
            ]
            switch(this.document){
                case 'E-KTP':
                    return paramIdCard.includes(param);
                case 'KIA':
                    return paramChildIdCard.includes(param);
                case 'KK' :
                    return paramFamilyCard.includes(param);
                case 'AKTA_LAHIR' :
                    return paramBirthCertificate.includes(param);
            }
        },
        submitForm(){
            let data = null;
            switch(this.document){
                case 'E-KTP':
                    data = this.idCardFormData;
                    break;
                case 'KIA':
                    data = this.childIdCardFormData;
                    break;
                case 'KK' :
                    data = this.familyCardFormData;
                    break;
                case 'AKTA_LAHIR' :
                    data = this.birthCertificateFormData;
                    break;
            }
            data.submission_date = moment(this.submission_date).format("DD-MM-YYYY");
            data.document = this.document;
            axios.post(this.submit_url, data)
                .then(response => {
                    this.errors = null;
                    this.data = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        },
        displayStatus(status){
            switch(status){
                case '00':
                    return 'Daftar Tunggu';
                case '01':
                    return 'Dalam Proses';
                case '02':
                    return 'Diterima';
                case '03':
                    return 'Ditolak';
                case '04':
                    return 'Selesai';
            }
        },
        getBadgeClassByStatus(status){
            switch(status){
                case '00':
                    return 'badge-secondary';
                case '01':
                    return 'badge-info';
                case '02':
                    return 'badge-primary';
                case '03':
                    return 'badge-danger';
                case '04':
                    return 'badge-success';
            }
        },
        pascalCaseConvert(key){
            return key.replace('_', ' ');
        },
        emptyError(){
            this.errors = null;
        },
        emptySearch(){
            this.data = [];
        }
    }
}
</script>