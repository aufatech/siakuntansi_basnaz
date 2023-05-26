<?php
include("koneksi.php");
$akunn="";
$saldoakhir = 0;
?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Neraca <?php
if(isset($_POST["search"])){
  $b=$_POST['cari'];
  echo "".$b;

?></h3>

            <div class="card-tools">
              <a href="?admin=neracasaldocetak&&cetak=<?php echo $b; ?>" class="btn btn-sm btn-flat btn-success animated swing"><i class='fa fa-print'></i> Cetak</a>
            </div>
                          <?php } ?>
                        </div>
                        
            <!-- /.card-header -->
             <div class="card-body">
              <form method="post">
              <div class="input-group input-group-sm" style="width: 300px;">
                
                 <select name="cari" class="form-control select2" id="t_level" required='true'>
                                    <option value="0">----Pilih Periode----</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    
                                  </select>
                    <span class="input-group-btn">
                     <button type="submit" name="search" class="btn btn-primary">Cari</button>
                    </span>
              </div>
            </form>
        </div>
      </div>
       <?php 
if(isset($_POST["search"])){
  $bb=$_POST['cari'];
  $awal=$bb-1;

?>
       <div class="card">
          <div class="card-body">
            <h3>Asset</h3>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
       <div class="card">
          <div class="card-body">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
              <table class="table table-bordered">
               
               <thead><tr>
                  <th colspan="3">Keterangan</th>
                  <th >Saldo Akhir</th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td colspan="4"><h3><b>Asset Lancar</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='1100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah Aset Lancar</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='1100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='1100' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></td>
                   </tr>
              </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-6">
       <div class="card">
          <div class="card-body">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
              <table class="table table-bordered">
               
               <thead><tr>
                  <th colspan="3">Keterangan</th>
                  <th>Saldo Akhir</th>
                </tr></thead> 
                <tbody>
                <tr>
                  <td colspan="4"><h3><b>Asset Tidak Lancar</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='1200' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah Aset Tidak Lancar</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='1200' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='1200' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></td>
              </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          <!-- row -->
        </div>
        <div class="card">
          <div class="card-body">
            <h3>LIABILITAS & SALDO DANA</h3>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
       <div class="card">
          <div class="card-body">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
              <table class="table table-bordered">
               
               <thead><tr>
                  <th colspan="3">Keterangan</th>
                  <th >Saldo Akhir</th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td colspan="4"><h3><b>Liabilitas Jangka Pendek</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='2100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah liabilitas Jangka Pendek</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='2100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='2100' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></td>
              </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-6">
       <div class="card">
          <div class="card-body">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
              <table class="table table-bordered">
               
               <thead><tr>
                  <th colspan="3">Keterangan</th>
                  <th >Saldo Akhir</th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td colspan="4"><h3><b>Liabilitas Jangka Panjang</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='2200' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah Liabilitas Jangka Panjang</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='2200' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='2200' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></td>
              </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          <!-- row -->
<div class="col-md-12">
       <div class="card">
          <div class="card-body">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
              <table class="table table-bordered">
               
               <thead><tr>
                  <th colspan="3">Keterangan</th>
                  <th >Saldo Akhir</th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td colspan="4"><h3><b>Saldo Dana</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='3000' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah Saldo Dana</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='3000' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='3000' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></td>
              </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          <!-- row -->
        </div>
        <?php
      }
        ?>