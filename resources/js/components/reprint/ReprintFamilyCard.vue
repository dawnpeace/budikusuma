<template>
    <div class="row">
        <div class="table-responsive col-12 p-5">
            <h5 class="text-center">Daftar Dokumen Dimiliki</h5>
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>No Identitas</th>
                    <th>Nama Kepala Keluarga</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <tr :key="key" v-for="(card, key) in cards">
                        <td>{{card.id_card}}</td>
                        <td>{{card.householder}}</td>
                        <td>{{dateFormat(card.birthdate)}}</td>
                        <td class="text-center">
                            <button data-toggle="modal" data-target="#reprintModal" @click="updateId(card.id)" :disabled="canReprint(card)" class="btn mt-1 btn-sm btn-primary">
                                Ajukan Cetak Ulang
                            </button>
                            <a class="btn btn-dark btn-sm mt-1" :href="`${media_url}\\${card.id}`">Download Dokumen Pendukung</a>
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

        <div id="reprintModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pengajuan Cetak Ulang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Pengajuan</label>
                            <select class="form-control" v-model="reprintType">
                                <option value="hilang">Hilang</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <form id="hilang" method="post" v-show="reprintType === 'hilang'" :action="submit_url">
                            <div class="form-group">
                                <label>Dokumen Pengantar</label>
                                <input accept="application/pdf" type="file" name="pengantar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Kehilangan</label>
                                <input accept="application/pdf" type="file" name="kehilangan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Pendukung</label>
                                <input accept="application/pdf" type="file" class="form-control" name="pendukung" required>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-sm btn-primary" type="button" @click="submitReprint">Submit</button>
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            <input type="hidden" name="type" v-model="reprintType">
                            <input type="hidden" name="card" v-model="id">
                        </form>
                        <form id="rusak" method="post" v-show="reprintType === 'rusak'" :action="submit_url">
                            <div class="form-group">
                                <label>Dokumen KK Rusak</label>
                                <input accept="application/pdf" type="file" name="dokumen_rusak" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Pengantar</label>
                                <input accept="application/pdf" type="file" name="pengantar" class="form-control" required>
                            </div>
                            <input type="hidden" name="type" v-model="reprintType">
                            <input type="hidden" name="card" v-model="id">
                            <div class="form-group text-right">
                                <button class="btn btn-sm btn-primary" type="button" @click="submitReprint">Submit</button>
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';
import {confirmationModal, successModal, errorModal} from '../../helper'
import Swal from 'sweetalert2';
import $ from "jquery";
export default {
    props : ["cards", "submit_url", "redirect_url", "has_printed", "media_url"],
    data(){
        return {
            reprintType : 'hilang',
            id : null,
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
                        let formObject = document.getElementById(this.reprintType === 'hilang' ? 'hilang' : 'rusak');
                        let formData = new FormData(formObject);
                        axios.post(
                            this.submit_url,
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        )
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
            return card.reprints.length > 0;
        },
        updateId(id) {
            this.id = id;
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
                        let mixed = {
                            'id_card' : element.id_card,
                            'name' : element.name,
                            'created_at' : child.created_at,
                            'printed_at' : child.printed_at
                        }

                        flatData.push(mixed);
                    });
                }
            });
            return flatData;
        }
    },
    mounted() {
        $('#reprintModal').on('hidden.bs.modal', function () {
            $("input[type=file]").each(function(key, value) {
                $(value).val("");
            });

        });
    }
}
</script>
