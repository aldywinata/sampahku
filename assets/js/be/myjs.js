// dataTables
$(document).ready( function () {
    $('#dataTables').DataTable();
} );
$(document).ready( function () {
    $('#dataTables2').DataTable();
} );

//Bootstrap Toggle Swich
// $(document).ready(function() {
//     $('#ubahStatTogg2').bootstrapToggle({
//         size: 'sm',
//         width: 90,
//         style: 'slow',
//         onstyle: 'primary',
//         offstyle: 'danger',
//         on: '<span style="font-size: 13px">Aktif</span>',
//         off: '<span style="font-size: 13px">Tidak Aktif</span>'
//       });
// })

//select2
$(document).ready(function() {
    $('.mySelect2').select2({
      theme: "bootstrap-5",
      width: function() {
        return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style';
      },
      placeholder: function() {
        return $(this).data('placeholder');
      }
    });
  });
  

// Active Menu
$(document).ready( function(){
    // const path = location.pathname.split('/');
    // const url = location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3];

    const path = window.location.pathname.split('/');
    let url = '';

    if (path.length >= 4) {
        url = window.location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3];
    }

    $('aside.sidebar ul.sidebar-nav li a').each( function(){
        if( $(this).attr('href').indexOf(url) !== -1 ){
            $(this).removeClass('collapsed');
        }
    } );
    
} );

$(document).ready( function(){
    // const path = location.pathname.split('/');
    // const url = location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3];

    const path = window.location.pathname.split('/');
    let url = '';

    if (path.length >= 4) {
        url = window.location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3];
    }

    $('aside.sidebar ul.sidebar-nav li.nav-item ul.nav-content li a').each( function(){
        if( $(this).attr('href').indexOf(url) !== -1 ){
            $(this).addClass('active').parent().parent('ul').addClass('show').siblings('a').removeClass('collapsed');
        }
    } );

} );

// SweetAlert2 Confirm btn Logout
$('.btn-logout').on('click', function(e) {
    
    const href = $(this).attr('href');
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Keluar ?',
        text: "Apakah Anda Yakin ingin Keluar ?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })

});

// SweetAlert2 Confirm btn Delete Profile
$('.btn-removeImg').on('click', function(e) {
    
    const href = $(this).attr('href');
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Yakin ?',
        text: "Hapus Foto Profile ?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })

});

// SweetAlert2 AKUN LOGIN/halaman login
$('.btn-akun').on('click', function(e) {

    Swal.fire({
        // imageUrl: 'http://localhost/sampahku/assets/imgs/icon.png',
        // imageHeight: 100,
        icon: 'warning',
        title: 'Akun Login Sampahku',
        // text: "Harap datang langsung ke Sampahku atau Klik disini untuk Menghubungi Pihak Terkait !",
        html:
            '<b>Petugas atau Pimpinan</b><br> ' +
            'username : petugas || username : pimpinan</br>' +
            'password : users123 || password : users123 </br></br>' +
            '<b>Nasabah</b><br> ' +
            'username : petugas || username : pimpinan</br>' +
            'password : nasabah123 || password : nasabah123 </br></br>',
    })

});

// SweetAlert2 Bergabung/halaman login
$('.btn-join').on('click', function(e) {
    
    const href = $(this).attr('href');
    e.preventDefault();

    Swal.fire({
        // imageUrl: 'http://localhost/sampahku/assets/imgs/icon.png',
        // imageHeight: 100,
        icon: 'warning',
        title: 'Ingin Bergabung?',
        // text: "Harap datang langsung ke Sampahku atau Klik disini untuk Menghubungi Pihak Terkait !",
        html:
            'Harap Datang langsung ke <b>Sampahku</b> atau ' +
            '<a href="//localhost/sampahku/#contact" target="_BLANK">Klik disini</a> ' +
            'untuk menghubungi pihak terkait !',
    })

});

// Sweetalert Confirm Delete Data
$('.tmbol-delete').on('click', function(e){
    
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        icon: 'warning',
        title: 'Yakin?',
        text: "Data Akan dihapus ?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});

//Sweatalert2 Konfirmasi Penukaran
$('.btn-konfirmasi').on('click', function(e) {
    e.preventDefault();

    const idPenukaran = $(this).data('id-penukaran');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success ms-4',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

    swalWithBootstrapButtons.fire({
        title: 'Konfirmasi',
        text: "Harap Konfirmasi Penukaran Poin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Batalkan',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + '/imadmin/penukaran/updateStatus/' + idPenukaran,
                type: 'POST',
                data: {
                    status: 'completed'
                },
                success: function(response) {
                    swalWithBootstrapButtons.fire(
                        'Success',
                        'Penukaran Telah diproses',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil diproses
                    });
                },
                error: function() {
                    swalWithBootstrapButtons.fire(
                        'Oopss...',
                        'Penukaran Gagal diproses !',
                        'error'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil diproses
                    });
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            $.ajax({
                url: base_url + '/imadmin/penukaran/updateStatus/' + idPenukaran,
                type: 'POST',
                data: {
                    status: 'failed'
                },
                success: function(response) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Penukaran Telah dibatalkan !',
                        'error'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil diproses
                    });
                },
                error: function() {
                    swalWithBootstrapButtons.fire(
                        'Oopss...',
                        'Penukaran Gagal dibatalkan !',
                        'error'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil diproses
                    });
                }
            });
        }
    });
});

//cek jumlah huruf kode kategori sampah
function cekJumlah(max) {
    let val = document.getElementById('kode').value;
    let cek = val.length;
    
    if(cek > max){
        document.getElementById('msg').innerHTML='MAX '+max+' Huruf !';
        document.getElementById('btn-tam').setAttribute('disabled', true); 
    }
    else if(cek <= max){
        document.getElementById('btn-tam').removeAttribute("disabled");
    }
}
//format angka
function formatInput() {
    var input = document.getElementById("poin");
    var input2 = document.getElementById("nominal");
    var value = input.value;
    var value2 = input2.value;

    // Menghilangkan semua karakter kecuali angka
    value = value.replace(/\D/g, "");
    value2 = value2.replace(/\D/g, "");

    // Mengubah angka menjadi format yang diinginkan
    value = parseInt(value).toLocaleString();
    value2 = parseInt(value2).toLocaleString();

    // Memasukkan angka yang telah diformat ke dalam input
    input.value = value;
    input2.value = value2;

    // Memeriksa jika nilai input kosong atau NaN
    if (value === "" || isNaN(parseInt(value))) {
        input.value = "";
        input.placeholder = "...";
    }

    // Memeriksa jika nilai input kosong atau NaN
    if (value2 === "" || isNaN(parseInt(value2))) {
        input2.value = "";
        input2.placeholder = "...";
    }
}
// Change Jenis Sampah
// function jenisChanged() {
//     var selectedValue = document.getElementById("jenis").value;
//     var stokDiv = document.getElementById("stokDiv");
  
//     if (selectedValue === "tukar_barang") {
//       // Tampilkan div stok
//       stokDiv.style.display = "block";
//     } else {
//       // Sembunyikan div stok
//       stokDiv.style.display = "none";
//     }
// }

//Metode Change
function metodeChange(){
    var selectMetod = document.getElementById('metode').value;
    var divBank = document.getElementById('divBank');
    var divEwallet = document.getElementById('divEwallet');
    var divNama = document.getElementById('divNama');
    var divNomor = document.getElementById('divNomor');

    var selectBank = document.getElementById('bank');
    var selectEwallet = document.getElementById('ewallet');

    if(selectMetod == "bank"){
        divEwallet.style.display = "none";
        selectEwallet.required = false;

        divBank.style.display = "block";
        selectBank.required = true;

        divNama.style.display = "block";
        divNomor.style.display = "block";

    }else{
        divBank.style.display = "none";
        selectBank.required = false;

        
        divEwallet.style.display = "block";
        selectEwallet.required = true;

        divNama.style.display = "block";
        divNomor.style.display = "block";
    }
}

function jenisChanged() {
    var selectedValue = document.getElementById("jenis").value;
    var stokDiv = document.getElementById("stokDiv");
    var stokInput = document.getElementById("stok");
    var nominalDiv = document.getElementById("divNominal");
    var nominalInput = document.getElementById("nominal");
    
    if (selectedValue === "tukar_barang") {
      // Tampilkan div stok
      stokDiv.style.display = "block";
      stokInput.required = true;
      
      nominalDiv.style.display = "block";
      nominalInput.required = true;

    } else {
      // Sembunyikan div stok
      stokDiv.style.display = "none";
    //   stokInput.required = false;

      nominalDiv.style.display = "block";
      nominalInput.required = true;
    }
    
  }

function jenisChangedEdit(){
    var selectedValue = document.getElementById("jenis").value;
    var stokDiv = document.getElementById("stokDiv");
    var stokInput = document.getElementById("stok");

    if (selectedValue === "tukar_barang") {
        // Tampilkan div stok
        stokDiv.style.display = "block";
        stokInput.required = true;
        
      } else {
        // Sembunyikan div stok
        stokDiv.style.display = "none";
        stokInput.required = false;
  
      }

}
  
//Filter data
function filterData(controller) {
    var jenis = document.getElementById('filter').value;
            var url = base_url + controller;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    var rewardContainer = document.getElementById('rewardContainer');
                    rewardContainer.innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("jenis=" + jenis);
}

//mengubah toggle checkbox status
function toggleStatus(id, container) {
    var id = id;

    Swal.fire({
        title: 'Yakin?',
        text: 'Anda yakin ingin mengubah status?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + container,
                type: 'POST',
                dataType: 'json',
                data: {
                    sendId: id
                },
                success: function(response) {
                    var status = response;

                    var swalConfig = {
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan dalam memperbarui status'
                    };

                    if (status == '1') {
                        swalConfig = {
                            icon: 'success',
                            title: 'Success',
                            text: 'Status Aktif'
                        };
                    } else if (status == '0') {
                        swalConfig = {
                            icon: 'success',
                            title: 'Success',
                            text: 'Status Tidak Aktif'
                        };
                    }

                    Swal.fire(swalConfig).then(() => {
                        location.reload();
                    });
                }
            });
        } else {
            location.reload();
        }
    });
}


  

// function toggleStatus(id, container) {
//     var id = id;

//     Swal.fire({
//         title: 'Yakin?',
//         text: 'Anda yakin ingin mengubah status?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Ya',
//         cancelButtonText: 'Batal'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: base_url + container,
//                 type: 'POST',
//                 data: {
//                     sendId: id
//                 },
//                 success: function(response) {
//                     var status = response;

//                     if (status == '1') {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Success',
//                             text: 'Status Aktif',
//                             onClose: function() {
//                                 location.reload();
//                             }
//                         });
//                     } else if (status == '0') {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Success',
//                             text: 'Status Tidak Aktif',
//                             onClose: function() {
//                                 location.reload();
//                             }
//                         });
//                     } else {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Error',
//                             text: 'Terjadi kesalahan dalam memperbarui status'
//                         });
//                     }
//                 }                               
                
//             });
//         } else {
//             location.reload();
//         }
//     });
// }


