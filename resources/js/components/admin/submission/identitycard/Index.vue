<template>
    <div class="w-100">
        <h5 class="text-center">Form Pembuatan Kartu Tanda Penduduk</h5>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for=""></label>
                    <select @change="changeByDocStatus" v-model="status" class="form-control">
                        <option value="00">Tunggu</option>
                        <option value="01">Dalam Proses</option>
                        <option value="02">Diterima</option>
                        <option value="03">Ditolak</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="myDataTable" class="table">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Identity Card Number
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Action
                        </th>
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
export default {
    props : [
        'ajax_url'
    ],
    mounted(){
        this.dataTable = $('#myDataTable').DataTable({
            serverSide : true,
            processing : true,
            ajax : this.ajax_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'identity_card_number', name: 'identity_card_number' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' }
            ]
        });
        
    },
    data(){
        return {
            dataTable : null,
            status : '00',
        }
    },
    methods : {
        changeByDocStatus(){
            this.dataTable.ajax.url(this.ajax_url + '?status=' + this.status).load();
        }
    }

}
</script>