<template>
    <div class="w-100">
        <h5 class="text-center">Daftar Pengajuan Kartu Identitas Anak</h5>
        <hr>
        <div class="px-5">
            <div class="row mb-3">
                <label for="" class="col-12">Pilih Jenis Status Dokumen</label>
                <div class="form-group col-12">
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
            let delBtn = document.querySelectorAll('button.dt-btn-del').forEach(el => {
                el.addEventListener('click', () => {
                    confirmationModal()
                        .then(response => {
                            if(response.value){
                                let url = el.dataset.deleteUrl;
                                axios.post(url)
                                    .then(response => {
                                        Swal.fire({
                                            icon : 'success',
                                            title : 'Data berhasil dihapus'
                                        }).then( () => {
                                            this.dataTable.draw();
                                        });
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            icon : 'error',
                                            title : 'Terjadi Kesalahan'
                                        });
                                    })
                            }
                        })
                });
            });

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