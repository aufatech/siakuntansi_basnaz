<?php
include("koneksi.php");
$akunn="";
$saldoakhir = 0;
?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Laporan Perubahan Dana <?php
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
            <h3>Dana Zakat</h3>
          </div>
        </div>
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
                  <td colspan="4"><h3><b>Penerimaan</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='4100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                        echo number_format($sa[0]);
                       }
                     }?></td>
                </tr>
                <tr>
                  <td colspan="3">Jumlah Penerimaan Dana Zakat</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='4100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                        $saldo=$da[0];
                        echo number_format($saldo);
                       }
                     ?></td>
             
                <tr>
                  <td colspan="4"><h3><b>Penyaluran</b></h3></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='5100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$bb'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){            
                        echo number_format($sa[0]);
                       }
                     }?></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3">Jumlah Penyaluran Dana Zakat</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='5100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                        $saldo=$da[0];
                        echo number_format($saldo);
                       }
                     ?></td>
                   </tr>
                   <tr>
                  <td colspan="3">Surplus (Defisit) Dana Zakat</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='5100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                        $saldo=$da[0];
                        echo number_format($saldo);
                       }
                     ?></td>
                   </tr>
                   <tr>
                  <td colspan="3">Saldo Awal Dana</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='5100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                        $saldo=$da[0];
                        echo number_format($saldo);
                       }
                     ?></td>
                   </tr>
                   <tr>
                  <td colspan="3">Saldo Akhir Dana</td>
                  <td><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='5100' AND YEAR(jurnal_umum.tanggal_input) = '$bb'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                        $saldo=$da[0];
                        echo number_format($saldo);
                       }
                     ?></td>
                   </tr>
              </tfoot>
                
              </table>
            </div>
            </div>
            </div>
            </div>
         
        <?php
      }
        ?>