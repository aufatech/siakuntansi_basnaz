<?php
include("koneksi.php");
include("fungsi.php");
$auto=kodeauto("jurnal_umum","NJU");
$refresh=mysql_query("delete from jurnal_umum where status ='0'");
if($refresh){
?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Jurnal Umum</h3>
                          <div class="card-tools">
              <a href="?admin=tambahj" class="btn btn-sm btn-flat btn-success animated swing"><i class='fa fa-check'></i> Tambah Jurnal</a>
            </div>
                        </div>
                        
            <!-- /.card-header -->
             <div class="card-body">
              <table id="example1" class="table table-hover table-head-fixed">
                <thead>
                <tr bgcolor="pink">
                  <th>No</th>
                  <th>No Pembayaran</th>
                  <th>No Akun</th>
                  <th>Akun</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                </tbody>
                <tfoot>
                   <?php
            include("koneksi.php");
            if (isset($_GET['bulan'])){
                  $buln=$_GET['bulan'];
            $qry=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM jurnal_umum WHERE `tanggal_input` LIKE '%$buln%'")or die(mysql_error());
            while($data=mysql_fetch_array($qry)){

            ?>
                <tr>
                  <td colspan="4"><center><b>JUMLAH TOTAL</b></center></td>
                  <td><?php echo $data[0] ?></td>
                  <td><?php echo $data[1] ?></td>
                  <td></td>
                </tr>
                <?php if($data[0] == $data[1]){ ?>
                <tr>
                  <td colspan="7"><div class="bg-green py-2 px-3 mt-4">
                <h5 class="mb-0">
                 <center>SEIMBANG</center>
                </h5>
              </div></td>
                </tr>
                <?php }else{  ?>
                  <tr>
                  <td colspan="7"><div class="bg-red py-2 px-3 mt-4">
                <h5 class="mb-0">
                 <center>TIDAK SEIMBANG</center>
                </h5>
              </div></td>
                </tr>
                <?php
              }
      }
        ?>
              </tfoot>
                <tbody>
                  <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT jurnal_umum.tanggal_input, jurnal_umum.no_jurnal, jurnal_umum.id_user, jurnal_umum.no_akun, akun.nama_akun, jurnal_umum.debet, jurnal_umum.kredit FROM jurnal_umum INNER JOIN akun ON jurnal_umum.no_akun=akun.no_akun WHERE jurnal_umum.tanggal_input LIKE '%$buln%'")or die(mysql_error());
            $no=1;
            while($data=mysql_fetch_array($qry)){

            ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $data[0] ?></td>
                  <td><?php echo $data[3] ?></td>
                  <td><?php echo $data[4] ?></td>
                  <td><?php echo $data[5] ?></td>
                  <td><?php echo $data[6] ?></td>
                  <td><a href="?admin=ubahj&&update=<?php echo $data[1] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?admin=hapusj&&delete=<?php echo $data[1] ?>" onclick="return confirm('Apa Anda Yakin Mau dihapus??')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
                </tr>
              
                <?php

        }
      }
    }
        ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
