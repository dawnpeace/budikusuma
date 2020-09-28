<template>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav justify-content-center nav-tabs card-header-tabs ">
                <li @click="changeDoc('E-KTP')" class="nav-item">
                    <span v-bind:class="{active : currentDoc == 'E-KTP'}" class="nav-link decor-none clickable">E-KTP</span>
                </li>
                <li @click="changeDoc('KIA')" class="nav-item">
                    <span v-bind:class="{active : currentDoc == 'KIA'}" class="nav-link decor-none clickable">KIA</span>
                </li>
                <li @click="changeDoc('KK')" class="nav-item">
                    <span v-bind:class="{active : currentDoc == 'KK'}" class="nav-link decor-none clickable">Kartu Keluarga</span>
                </li>
                <li @click="changeDoc('AL')" class="nav-item">
                    <span v-bind:class="{active : currentDoc == 'AL'}" class="nav-link decor-none clickable">Akta Lahir</span>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive mt-5">
                <table class="table table-sm table-bordered text-left">
                    <tr>
                        <th>
                            Permintaan Ditolak Bulan Ini
                        </th>
                        <td>
                            {{ rejected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Permintaan Selesai Bulan Ini
                        </th>
                        <td>
                            {{ finished }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Permintaan Dalam Proses Bulan Ini
                        </th>
                        <td>
                            {{ inProgress }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total Permintaan Bulan Ini
                        </th>
                        <td>
                            {{ monthly }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total Seluruh Data Masuk
                        </th>
                        <td>
                            {{ totalEntry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total Data yang Telah Direkam
                        </th>
                        <td>
                            {{ totalPublished }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props : [
        "cards"
    ],
    mounted(){
        this.changeDoc('E-KTP');
    },
    data(){
        return {
            currentDoc : 'E-KTP',
            finished : 0,
            inProgress : 0,
            monthly : 0,
            rejected : 0,
            totalEntry : 0,
            totalPublished : 0,
        }
    },
    methods : {
        changeDoc(doc){
            let cardInfo;
            this.currentDoc = doc;
            switch(doc){
                case 'E-KTP':
                    cardInfo = this.cards.ktp;
                    break;
                case 'KIA':
                    cardInfo = this.cards.kia;
                    break;
                case 'KK':
                    cardInfo = this.cards.kk;
                    break;
                case 'AL':
                    cardInfo = this.cards.akta_lahir;
                    break;
            }
            this.finished = cardInfo.finished;
            this.inProgress = cardInfo.in_progress;
            this.monthly = cardInfo.monthly;
            this.rejected = cardInfo.rejected;
            this.totalEntry = cardInfo.total_entry;
            this.totalPublished = cardInfo.total_published
        }
    }
}
</script>