<?php
if(isset($_GET['kode'])){
            $sql_hapus = "DELETE FROM nilai WHERE id_alternatif='".$_GET['kode']."'";
            $query_hapus = mysqli_query($koneksi, $sql_hapus);
            mysqli_query($koneksi,"delete from nilai_pendidikan where id_alternatif='$_GET[kode]'");

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-nilai';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-nilai';
                    }
                })</script>";
            }
        }

