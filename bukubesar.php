<?php
include("koneksi.php");
$akunn="";
?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Buku Besar <?php 
if(isset($_POST["search"])){
  $bb=$_POST['cari'];
  $q=mysql_query("select nama_akun from akun where no_akun='$bb'");
            while($b=mysql_fetch_array($q)){
            echo "".$b['nama_akun']."";
            }  
}
?></h3>
                          
                        </div>
                        
            <!-- /.card-header -->
             <div class="card-body">
              <table id="example2" class="table table-hover table-head-fixed">
                
                <div class="input-group input-group-sm" style="width: 300px;">
                     <form method="post">
                     <select name="cari" class="form-control select2" id="t_level" required='true'>
                                    <option value="0">----Pilih Akun----</option>
                                    <?php
                                    $brg=mysql_query("select * from akun");
                                    while($b=mysql_fetch_array($brg)){
                                      ?>
                                      <option value="<?php echo $b['no_akun']; ?>"> <?php echo $b['nama_akun'] ?></option>
                                      <?php
                                    }
                                    ?>
                                  </select>

                    <div class="input-group-append">
                      <button type="submit" name="search" class="btn btn-default"><i class="fas fa-search"></i>  Cari</button>
                    </div>
                    </form>
                  </div>
                
                </div>
                <thead>
                <tr bgcolor="pink">
                  <th>No</th>
                  <th>No Jurnal</th>
                  <th>Tanggal Input</th>
                  <th>ID User</th>
                  <th>No Akun</th>
                  <th>Akun</th>
                  <th>Keterangan</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                </tr>
                </thead>
                
                <tbody>
                  <?php
                   $TAHUN = DATE("Y");
              $awal= $TAHUN-1;
               if(isset($_POST["search"])){
            $ak=$_POST['cari'];
               $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$ak'")or die(mysql_error());
            while($dat=mysql_fetch_array($qr)){
              $saldo_awal=$dat[0]-$dat[1];
            ?>
                <tr>
                  <td colspan="7"><center><b>SALDO AWAL <?php echo $awal; ?></b></center></td>
                  <td><?php echo $dat[0] ?></td>
                  <td><?php echo $dat[1] ?></td>
                  <td><?php echo ($dat[0]-$dat[1]) ?></td>
                </tr>
                
      
                  <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT jurnal_umum.tanggal_input, jurnal_umum.no_jurnal, jurnal_umum.id_user, jurnal_umum.no_akun, akun.nama_akun, jurnal_umum.keterangan, jurnal_umum.debet, jurnal_umum.kredit FROM jurnal_umum INNER JOIN akun ON jurnal_umum.no_akun=akun.no_akun WHERE jurnal_umum.no_akun='$ak'")or die(mysql_error());
            $no=1;
            while($data=mysql_fetch_array($qry)){

            ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $data[1] ?></td>
                  <td><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php echo $data[3] ?></td>
                  <td><?php echo $data[4] ?></td>
                  <td><?php echo $data[5] ?></td>
                  <td><?php echo $data[6] ?></td>
                  <td><?php echo $data[7] ?></td>
                  <td><?php echo ($data[6]-$data[7]) ?>
                </td>
                </tr>
              
                <?php
              }
             
        
        ?>
        <tfoot>
          <?php
               $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM jurnal_umum WHERE  no_akun = '$ak'")or die(mysql_error());
            while($dataa=mysql_fetch_array($qr)){

            ?>
                <tr>
                  <td colspan="9"><center><b>JUMLAH TOTAL</b></center></td>
                  <td><?php echo ($dataa[0]-$dataa[1])+$saldo_awal ?></td>
                </tr>
                
      
                  <?php
                }
                }
              }
                ?>

        </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
