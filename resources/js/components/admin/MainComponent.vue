<template>
    <div class="w-100">
        <h5 class="text-center">Form Pembuatan Kartu Tanda Penduduk</h5>
        <hr>
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
        $('#myDataTable').DataTable({
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
        
    }
}
</script>