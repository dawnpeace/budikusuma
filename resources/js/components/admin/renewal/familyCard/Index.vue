<template>
    <div>
        <div class="table-responsive">
            <table id="familyCardTable" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Status</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import DataTable from 'datatables.net';
import * as dt from 'datatables.net-dt';
import moment from 'moment';
import {get, cloneDeep} from 'lodash'
import {documentStatus} from "../../../../helper";

export default {
    props : [
        "ajax_url",
    ],
    data(){
        return {
            dataTable : null,
        }
    },
    methods: {
        documentStatus,
    },
    mounted(){
        this.dataTable = $('#familyCardTable').DataTable({
            serverSide : true,
            processing : true,
            ajax : this.ajax_url,
            order : [[4, 'desc']],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'id_card', name: 'id_card' },
                { data: 'householder', name: 'householder' },
                { data: 'status', name: 'status'},
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
            ],
            columnDefs : [
                {
                    targets : [3],
                    "render": function ( data ) {
                        return documentStatus(data)
                    }
                }
            ]
        });

        this.dataTable.on('draw.dt', item => {
            document.querySelectorAll('button.dt-btn-forward')
                .forEach((el, key) => {
                    el.addEventListener('click', () => {
                        console.log(el);
                        location.href = el.dataset.forwardUrl;
                    });
                });
        });
    }
}
</script>


