<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <button @click="datatableReload" class="btn btn-sm btn-primary">
                    <i class="fa fa-refresh"></i> Refresh Table
                </button>
            </div>
            
            <h5 class="text-center">Antrian Hari Ini</h5>
            <div class="table-responsive">
                
                <table id="queue" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Dokumen</th>
                            <th>Catatan</th>
                            <th>Tanggal Antrian</th>
                            <th>Pengantri</th>
                            <th>NIK Pengantri</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import DataTable from 'datatables.net';
import * as dt from 'datatables.net-dt';
import moment from 'moment';
export default {
    props : [
        "ajax_url"
    ],
    mounted() {
        this.dataTable = $("#queue").DataTable({
            serverSide : true,
            processing : true,
            ajax : this.ajax_url,
            columns: [
                { data: 'document', name: 'document' },
                { data: 'note', name: 'note' },
                { data: 'appointed_at', name: 'appointed_at' },
                { data: 'user.name', name: 'user.name' },
                { data: 'user.identity_number', name: 'user.identity_number' }
            ],
            columnDefs : [
                {
                    targets : [2],
                    searchable : false,
                    render : (data) => {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
            ]
        });
    },
    data() {
        return {
            dataTable : null,
        }
    },
    methods : {
        datatableReload : function() {
            this.dataTable.ajax.reload();
        }
    }
}
</script>