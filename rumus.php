	<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {
              
				//kriteria
				case 'data-kriteria':
					include "modul/kriteria/data_kriteria.php";
					break;
				case 'add-kriteria':
					include "modul/kriteria/add_kriteria.php";
					break;
				case 'edit-kriteria':
					include "modul/kriteria/edit_kriteria.php";
					break;
				case 'del-kriteria':
					include "modul/kriteria/del_kriteria.php";
					break;

				//rw
				case 'data-rw':
					include "modul/rw/data_rw.php";
					break;
				case 'add-rw':
					include "modul/rw/add_rw.php";
					break;
				case 'edit-rw':
					include "modul/rw/edit_rw.php";
					break;
				case 'del-rw':
					include "modul/rw/del_rw.php";
					break;

				//alternatif
				case 'data-alternatif':
					include "modul/alternatif/data_alternatif.php";
					break;
				case 'add-alternatif':
					include "modul/alternatif/add_alternatif.php";
					break;
				case 'edit-alternatif':
					include "modul/alternatif/edit_alternatif.php";
					break;
				case 'del-alternatif':
					include "modul/alternatif/del_alternatif.php";
					break;

				//sub
				case 'data-sub':
					include "modul/sub/data_sub.php";
					break;
				case 'add-sub':
					include "modul/sub/add_sub.php";
					break;
				case 'edit-sub':
					include "modul/sub/edit_sub.php";
					break;
				case 'del-sub':
					include "modul/sub/del_sub.php";
					break;


				//nilai
				case 'data-nilai':
					include "modul/nilai/data_nilai.php";
					break;
				case 'add-nilai':
					include "modul/nilai/add_nilai.php";
					break;
				case 'edit-nilai':
					include "modul/nilai/edit_nilai.php";
					break;
				case 'del-nilai':
					include "modul/nilai/del_nilai.php";
					break;

					//Pembobotan Kriteria
				case 'data-bobot':
					include "modul/bobot/data_bobot.php";
					break;
				case 'hasil-bobot':
					include "modul/bobot/hasil_bobot.php";
					break;

				//Pembobotan Kriteria
				case 'data-pendidikan':
					include "modul/pendidikan/data_pendidikan.php";
					break;
				case 'hasil-pendidikan':
					include "modul/pendidikan/hasil_pendidikan.php";
					break;

				//WSM
					case 'data-saw':
					include "modul/saw/data_saw.php";
					break;
					case 'data-hitung':
					include "modul/saw/data_hitung.php";
					break;


				
				
				

          
              //default
              default:
                  echo "<center><h1> ERROR !</h1></center>";
                  break;    
          }
      }else{
        // Auto Halaman Home kriteria
          if($data_level=="admin"){
              include "home/admin.php";
              }
          elseif($data_level=="Kepala Desa"){
              include "home/admin.php";
              }
          }
    ?>