<template>
    <div>
        <hr>
        <div class="table-responsive mb-3">
            <h5 class="text-center">Daftar Dokumen Kartu Keluarga</h5>
            <table class="table-sm table table-striped">
                <thead>
                    <th>No KK</th>
                    <th>Nama Kepala Keluarga</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <tr v-if="cardsData.length === 0">
                        <td colspan="3" class="text-center">Anda belum memiliki rekaman Kartu Keluarga di Portal Sanatab</td>
                    </tr>
                    <tr v-for="card in cardsData">
                        <td>{{card.id_card}}</td>
                        <td>{{card.householder}}</td>
                        <td>
                            <button :disabled="card.renewal_count > 0" @click="redirect(card.id)" class="btn btn-sm btn-primary">Perbaharui</button>
                            <button @click="populateCardModal(card.renewal)" v-if="card.renewal_count > 0" type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#familyCard">
                                Lihat Pengajuan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="familyCard" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Daftar Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <h5 class="text-center">Daftar Permintaan</h5>
                            <table class="table table-sm">
                                <thead>
                                    <th>No KK</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Catatan Pemilik</th>
                                    <th>Keterangan Petugas</th>
                                </thead>
                                <tbody>
                                    <tr v-for="card in this.cardList">
                                        <td>{{card.id_card}}</td>
                                        <td>{{moment(card.created_at).format('DD-MM-YYYY')}}</td>
                                        <td>{{humanStatus(card.status)}}</td>
                                        <td>{{card.note}}</td>
                                        <td>{{card.reason}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import $ from 'jquery'
import moment from 'moment'
export default {
    props : [
        "cards", "view_url"
    ],
    data() {
        return {
            cardsData : this.cards,
            cardList : []
        }
    },
    methods : {
        moment,
        redirect : function(id) {
            location.href = this.view_url + '/' + id;
        },
        populateCardModal : function(cards) {
            this.cardList = cards;
        },
        humanStatus(status) {
            switch(status){
                case '00':
                    return 'Tunggu';
                case '01':
                    return 'Proses';
                case '02':
                    return 'Disetujui';
                case '03':
                    return 'Ditolak';
                case '04':
                    return 'Selesai';
            }
        }

    },
    mounted(){
        $("#kk").on('hidden.bs.modal', function(){
            this.cardList = [];
        });
    }


}
</script>

<style scoped>

</style>
