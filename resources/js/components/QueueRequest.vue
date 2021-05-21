<template>
    <div>
        <h5 class="text-center">Pengajuan Antrian</h5>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Dokumen</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Dokument</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <select :class="{'is-invalid': get(this.errors, 'errors.document[0]', false)}" v-model="document"  id="document" class="form-control">
                        <option value="E-KTP">E-KTP</option>
                        <option value="KK">Kartu Keluarga</option>
                        <option value="KIA">Kartu Identitas Anak</option>
                        <option value="AKTA_LAHIR">Akta Lahir</option>
                        <option value="AKTA_KEMATIAN">Akta Kematian</option>
                    </select>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.document[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Keterangan</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Keterangan</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <textarea 
                        v-model="note" 
                        placeholder="Keterangan Antrian" 
                        type="text"
                        id="note"
                        :class="{'is-invalid': get(this.errors, 'errors.note[0]', false)}" 
                        class="form-control">
                    </textarea>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.note[0]', '')}}</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block" for="">Tanggal Antrian</label>
                <label class="w-100 text-right d-none d-md-block d-lg-block d-sm-none d-xs-none" for="">Tanggal Antrian</label>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <datepicker 
                    input-class="form-control"
                    id="appointed_at"
                    format="dd-MM-yyyy"
                    name="appointed_at"
                    v-model="appointed_at"
                    placeholder="Tanggal Antri" 
                    :class="{'is-invalid': get(this.errors, 'errors.appointed_at[0]', false)}" 
                    ></datepicker>
                    <div class="invalid-feedback">{{get(this.errors, 'errors.appointed_at[0]', '')}}</div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button @click="submitQueue" class="btn btn-sm btn-primary">Submit</button>
        </div>
        <hr class="my-5">

        <div class="col-12">
            <h5 class="text-center mb-2">Daftar Antrian</h5>
            <div class="table-responsive">
                <table class="table-sm table table-striped table-bordered">
                    <thead>
                        <th>Antrian</th>
                        <th>Tanggal Antri</th>
                        <th>Jenis Dokumen</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="queues.length == 0" colspan="3">
                                Anda tidak memiliki data
                            </td>
                        </tr>
                        <tr :key="key" v-for="(queue, key) in queues">
                            <td>{{queue.id}}</td>
                            <td>{{dateFormat(queue.appointed_at)}}</td>
                            <td>{{queue.document}}</td>
                        </tr>
                    </tbody>
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
        'queues', 'submit_url', 'redirect_url'
    ],
    methods:{
        get,
        cloneDeep,
        submitQueue: function() {
            let data = {
                document : this.document,
                note : this.note,
                appointed_at : this.appointedAt
            };

            axios.post(this.submit_url, data)
                .then(success => {
                    swal({
                        icon : "success",
                        title : "Data berhasil dimasukkan",
                        button : "Ok"
                    }).then((ok) => {
                        if(ok) window.location.replace(this.redirect_url);
                    })
                })
                .catch(err => {
                    this.errors = err.response.data;
                });
        },
        dateFormat: date => {
            return moment(date).format('DD-MM-YYYY');
        }
        
    },
    data(){
        return {
            document : 'E-KTP',
            note : '',
            appointed_at : new Date(),
            errors : null,

        }
    },
    computed: {
        appointedAt() {
            let appointedAt = cloneDeep(this.appointed_at);
            return moment(appointedAt).format('DD-MM-YYYY')
        }
    }

}
</script>
