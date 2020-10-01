import {swal} from 'sweetalert'
import Swal from 'sweetalert2'
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

export function confirmationModal() {
    return Swal.fire({
        title: "Konfirmasi",
        text: "Anda yakin ingin melanjutkan?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    })
}

export function errorModal() {
    return Swal.fire({
        icon : 'error',
        button: 'Ok',
        title : 'Terjadi kesalahan'
    })
}

export function successModal(attributes){
    return Swal.fire({
        text: "",
        icon: "success",
        showCancelButton: false,
        confirmButtonText: "Ok",
        ...attributes
    });
}
