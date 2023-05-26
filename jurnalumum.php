<?php
include "koneksi.php";
$refresh=mysql_query("delete from jurnal_umum where status ='0'");
if($refresh){
 //Fungsi konversi nama bulan ke dalam bahasa indonesia
 function getBulan($bln){
    switch ($bln){
     case 1:
      return "Januari";
      break;
     case 2:
      return "Februari";
      break;
     case 3:
      return "Maret";
      break;
     case 4:
      return "April";
      break;
     case 5:
      return "Mei";
      break;
     case 6:
      return "Juni";
      break;
     case 7:
      return "Juli";
      break;
     case 8:
      return "Agustus";
      break;
     case 9:
      return "September";
      break;
     case 10:
      return "Oktober";
      break;
     case 11:
      return "November";
      break;
     case 12:
      return "Desember";
      break;
    }
   }

 ?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
            <div class="card-header">
              <h3 class="card-title">Jurnal Umum</h3>
              <div class="card-tools">
              <a href="?admin=tambahj" class="btn btn-sm btn-flat btn-success animated swing"><i class='fa fa-check'></i> Tambah Data</a>
            </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr bgcolor="pink">
                  <th>No</th>
                  <th>Bulan dan Tahun</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
    			  include("koneksi.php");
    			  $qry=mysql_query("SELECT MONTH(`tanggal_input`) AS BULAN, YEAR(`tanggal_input`) AS TAHUN, LEFT(`tanggal_input`,7) AS tanggala FROM jurnal_umum GROUP BY MONTH(`tanggal_input`), YEAR(`tanggal_input`)")or die(mysql_error());
    			  $no=1;
    			  while($data=mysql_fetch_array($qry)){
    			  ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $bulan= getBulan($data[0]).' '.$data[1]; ?></td>
                  <td><a href="?admin=lihatjurnal&&bulan=<?php echo $data[2] ?>" class="btn btn-success btn-sm"> <i class="fas fa-eye  fa-lg mr-2"></i> lihat Jurnal</a>
                </td>
                </tr>
                <?php
              }
        }
        ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
