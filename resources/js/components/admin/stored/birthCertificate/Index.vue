<template>
    <div>
        <h5 class="text-center mb-2">Arsip Akta Lahir</h5>
        <hr>
        <div class="row mb-3">
            <div class="col-12">Filter Tanggal</div>
            <div class="form-group col-md-6 col-sm-12">
                <datepicker 
                input-class="form-control"
                id="birthdate"
                format="dd-MM-yyyy"
                v-model="startDate"
                :class="{'is-invalid': get(this.errors, 'errors.startDate[0]', false)}"
                />
                <div class="invalid-feedback">{{get(this.errors, 'errors.startDate[0]', '')}}</div>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <datepicker 
                input-class="form-control"
                id="birthdate"
                format="dd-MM-yyyy"
                v-model="endDate"
                :class="{'is-invalid': get(this.errors, 'errors.startDate[0]', false)}" 
                />
                <div class="invalid-feedback">{{get(this.errors, 'errors.startDate[0]', '')}}</div>
            </div>
            <div class="col-12">
                <p class="text-danger">{{ errorDate }}</p>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button @click="findBetween" type="button" class="btn btn-sm btn-primary mx-1">Filter</button>
                    <button @click="download" type="button" class="btn btn-sm btn-success mx-1">Download</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" id="storedIdCard">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Identitas</th>
                        <th>Nama</th>
                        <th>Diarsipkan Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
</template>
<script>
import DataTable from 'datatables.net';
import * as dt from 'datatables.net-dt';
import moment from 'moment';
import {get, cloneDeep} from 'lodash'
import { confirmationModal, errorModal, successModal } from '../../../../helper';
export default {
    props : [
        "ajax_url", "latest_date", "oldest_date", "export_url"
    ],
    mounted(){
        this.dataTable = $('#storedIdCard').DataTable({
            serverSide : true,
            processing : true,
            ajax : this.ajax_url,
            order : [[3, 'desc']],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'id_card', name: 'id_card' },
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
            ],
            columnDefs : [
                {
                    targets : [0,4],
                    orderable : false,
                    searchable : false
                },
                {
                    targets : [3],
                    searchable : false,
                    className : 'text-center',
                    render : (data) => {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    targets : [0,1],
                    className : 'text-right'
                }
            ]
        });

        this.dataTable.on('draw.dt', item => {
            let buttons = document.querySelectorAll('button.dt-btn-forward')
                .forEach((el, key) => {
                    el.addEventListener('click', () => {
                        console.log(el);
                        location.href = el.dataset.forwardUrl;
                    });
                });
        });

    },
    data(){
        return {
            dataTable : null,
            startDate : new Date(this.oldest_date),
            endDate : new Date(this.latest_date),
            errors : null,
            errorDate : ''
        }
    },
    methods : {
        get,
        cloneDeep,
        findBetween(){
            let start = cloneDeep(this.startDate);
            let end = cloneDeep(this.endDate);
            if(this.checkDate()){
                let url = this.ajax_url + "?start_date=" + moment(start).format('YYYY-MM-DD') + "&end_date=" + moment(end).format('YYYY-MM-DD');
                this.dataTable.ajax.url(url).load();
            }
        },
        checkDate(){
            let start = cloneDeep(this.startDate);
            let end = cloneDeep(this.endDate);
            if(moment(start).isBefore(end) || moment(start).isSame(end)){
                this.errorDate = ''
                return true;
            } else {
                this.errorDate = "Mohon Perbaiki Tanggal"
                return false;
            }
        },
        download(){
            if(this.checkDate()){
                let start = cloneDeep(this.startDate);
                let end = cloneDeep(this.endDate);
                location.href = this.export_url + "?start_date=" + moment(start).format('YYYY-MM-DD') + "&end_date=" + moment(end).format('YYYY-MM-DD');
            }
        }
    }
}
</script>