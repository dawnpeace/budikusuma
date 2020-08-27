<template>
    <div>
        <h5 class="text-center">Daftar Dokumen</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-striped p-1 table-bordered">
                <thead class="thead-dark">
                    <th width="8%">No</th>
                    <th>Dokumen</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                        <td class="text-right">{{index + 1}}</td>
                        <td>{{removeUnderscore(item.document)}}</td>
                        <td>
                            <button @click="showModal(item.description, item.document)" class="btn btn-sm btn-primary">Lihat Syarat</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="modal fade" id="requirementModal" tabindex="-1" role="dialog" aria-labelledby="myModal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalTitle">Daftar Persyaratan {{removeUnderscore(modalTitle)}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{modalContent}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {get} from 'lodash'
export default {
    props : [
        "items", "document_url"
    ],
    data(){
        return {
            modalShow : true,
            modalContent : '',
            modalTitle : ''
        }
    },
    methods: {
        get,
        showModal(description, title){
            this.modalContent = description;
            this.modalTitle = title;
            $('#requirementModal').modal('show');
        },
        removeUnderscore(document){
            return document.replace('_', ' ');
        }
    }
}
</script>