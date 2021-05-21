<template>
    <div class="row">
        <div class="table-responsive col-12 p-5">
            <h5 class="text-center">Daftar Dokumen Dimiliki</h5>
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>No Identitas</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <tr :key="key" v-for="(card, key) in cards">
                        <td>{{card.identity_card_number}}</td>
                        <td>{{card.name}}</td>
                        <td>{{dateFormat(card.birthdate)}}</td>
                        <td class="text-center">
                            <button @click="submitReprint(card.id)" :disabled="canReprint(card)" class="btn btn-sm btn-primary">
                                Ajukan Cetak Ulang
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive col-12 p-5">
            <h5 class="text-center">Daftar Riwayat Pengajuan</h5>
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Dicetak Pada</th>
                </thead>
                <tbody>
                    <tr :key="key" v-for="(reprint, key) in flatMap">
                        <td>{{dateFormat(reprint.created_at)}}</td>
                        <td>{{reprint.printed_at == null ? 'Belum Dicetak' : 'Telah Dicetak'}}</td>
                        <td>{{reprint.printed_at ? dateFormat(reprint.printed_at) : ''}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import moment from 'moment';
import {confirmationModal, successModal, errorModal} from '../../helper'
import Swal from 'sweetalert2';
export default {
    props : ["cards", "submit_url", "redirect_url", "has_printed"],
    data(){
        return {
            
        }
    },
    methods : {
        dateFormat: date => {
            return moment(date).format('DD-MM-YYYY')
        },
        submitReprint(id) {
            confirmationModal()
                .then(ok => {
                    if(ok.isConfirmed) {
                        axios.post(this.submit_url, {card : id})
                            .then(success => {
                                successModal({
                                    title : "Permintaan berhasil dibuat.", 
                                    onClose : () => {
                                        location.replace(this.redirect_url);
                                    }
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon : 'error',
                                    title : 'Anda memiliki Permintaan yang telah di proses'
                                });
                            });
                    }
                });
        },
        canReprint(card) {
            if(card.reprints.length != 0) {
                let createdAt = moment(card.created_at);
                return createdAt.isBetween(moment().add(-2, 'months'), moment());
            }
        }

    },
    computed: {
        flatMap : function() {
            let data = this.cards;
            let flatData = [];
            data.forEach(element => {
                if(element.reprints.length > 0) {
                    let children = element.reprints;
                    children.forEach(child => {
                        let mix = {
                            'identity_card_number' : element.identity_card_number,
                            'name' : element.name,
                            'created_at' : child.created_at,
                            'printed_at' : child.printed_at
                        }

                        flatData.push(mix);
                    });
                }
            });
            return flatData;
        }
    }
}
</script>
