<template>
    <div class="w-100">
        <h5 class="text-center">Daftar Arsip Kartu Identitas Anak</h5>
        <hr>
        <div class="table-responsive">
            <table id="myDataTable" class="table">
                <thead>
                    <tr>
                        <th>
                            Nomor Kartu
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Aksi
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
import {confirmationModal} from '../../../../helper'
import Swal from 'sweetalert2'
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
                { data: 'card_number', name: 'card_number' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' }
            ],
            columnDefs : [
                {
                    targets : [2],
                    orderable : false,
                    searchable : false,
                }
            ]
        });
        
        this.dataTable.on('draw.dt', item => {

            let checkButton = document.querySelectorAll('button.dt-btn-forward').forEach(el => {
                el.addEventListener('click', () => {
                    document.location.href = el.dataset.forwardUrl;
                })
            });
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