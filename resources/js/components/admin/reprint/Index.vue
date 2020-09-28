<template>
    <div class="w-100">
        <h5 class="text-center">Daftar Pengajuan Cetak Ulang Dokumen</h5>
        <hr>
        <div class="px-5">
            <div class="row mb-3">
                <label for="" class="col-12">Pilih Jenis Status Dokumen</label>
                <div class="form-group col-12">
                    <select @change="changeDocument" v-model="document" class="form-control">
                        <option value="E-KTP">E-KTP</option>
                        <option value="KK">Kartu Keluarga</option>
                        <option value="KIA">Kartu Identitas Anak</option>
                        <option value="AKTA_LAHIR">Akta Kelahiran</option>
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
                            Pengajuan Pada
                        </th>
                        <th>
                            Dicetak Pada
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
import {confirmationModal} from '../../../helper';
import Swal from 'sweetalert2';
import moment from 'moment'
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
                { data: 'id_number', name: 'id_number' },
                { data: 'created_at', name: 'created_at' },
                { data: 'printed_at', name: 'printed_at' },
                { data: 'action', name: 'action' }
            ],
            columnDefs : [
                {
                    targets : [1],
                    searchable : false,
                    render : function(data, type, row) {
                        return moment(data).format('DD-MM-YYYY')
                    }
                },
                {
                    targets : [2],
                    searchable : false,
                    render : function(data, type, row) {
                        if(data){
                            return moment(data).format('DD-MM-YYYY')
                        }
                        return "Belum Tercetak";
                    }
                },
                {
                    targets : [3],
                    searchable : false,
                    orderable : false,
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
            document : 'E-KTP',
        }
    },
    methods : {
        changeDocument(){
            this.dataTable.ajax.url(this.ajax_url + '?document=' + this.document).load();
        }

    }

}
</script>