import swal from 'sweetalert'
import axios from 'axios'

export function deleteRow(routeUrl){
    swal({
        title : "Anda ingin menghapus data ?",
        dangerMode : true,
        icon : 'warning',
        buttons : true
    }).then(willDelete => {
        if(willDelete){
            axios.post(routeUrl)
                .then(response => {
                    swal({
                        icon: 'success',
                        title: 'Data Berhasil dihapus',
                        button: 'Ok'
                    });
                }).catch(error => {
                    swal({
                        icon: 'warning',
                        title: 'Terjadi Kesalahan',
                    });
                    console.log(error);
                });
        }   
    });
}

export function goToUrl(routeUrl){
    window.location.href = routeUrl;
}