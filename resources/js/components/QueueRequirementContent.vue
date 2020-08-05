<template>
    <div>
        <h5 class="text-center">Daftar Dokumen</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-striped p-1 table-bordered">
                <thead class="thead-dark">
                    <th class="col-1">No</th>
                    <th class="col-5">Dokumen</th>
                    <th class="col-6">Aksi</th>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="index">
                        <td class="text-right">{{index + 1}}</td>
                        <td>{{item.name}}</td>
                        <td>
                            <a v-bind:href="item.url" class="btn btn-sm btn-primary">Kunjungi Laman</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
export default {
    props : [
        "items"
    ]
}
</script>