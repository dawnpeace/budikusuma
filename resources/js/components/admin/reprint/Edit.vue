<template>
    <div>
        <h5>Permintaan Cetak Ulang Dokumen</h5>
        <hr>
        <div class="row">
            <div class="col-3">
                No. Identitas
            </div>
            <div class="col-9">
                {{ document.id_number }}
            </div>
            <div class="col-3">
                Jenis Dokumen
            </div>
            <div class="col-9">

            </div>
            <div class="col-3">
                Tanggal Pengajuan
            </div>
            <div class="col-9">

            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : [
        "document"
    ],
    data(){
        
    }
}
</script>