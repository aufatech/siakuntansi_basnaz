<?php include("koneksi.php");
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

            include("koneksi.php");
           if (isset($_GET['cetak'])){
            $id=$_GET['cetak'];
            $awal=$id-1;

?>
<html>
<head>
	<title>Cetak Transaksi | SIA Baznas</title>
</head>
<body>
 
	<center>
		<table border='0' width='100%'>
						<tr>
						<td rowspan='4' width='200' align='center'><img src='baznas.png' width='200'></td>
						<td colspan='2'  align='center'><h2><b>BADAN AMIL ZAKAT NASIONAL</b></h2></td>
						<td rowspan='7' width='120' align='center'></td>
						</tr>
						 <tr>
						<td colspan='2' align='center'><h3><b>KABUPATEN REMBANG<BR></b></h3></td>
						</tr>
						<tr>
						<td colspan='2' align='center'><i><h5>Jl.Pemuda Km. 03 Rembang, Rambutmalang, Kabongan Kidul, Kecamatan Rembang Kabupaten Rembang, Jawa Tengah 59219</h5> </i></td>
						</tr>  
						</table>
						<hr>
            <table border='0' width='100%'>
            <tr>
            <td align='center'><h2><b>LAPORAN POSISI KEUANGAN</b></h2></td>
            </tr>
             <tr>
            <td align='center'><h3><b>31 Desember <?php echo $id; ?></b></h3></td>
            </tr>
            <tr>
            <td align='center'><i><h4>(Dalam Rupiah)</h4> </i></td>
            </tr>  
            </table>
 
              <table border="0" width="100%">
               
               <thead><tr>
                  <th colspan="4"><h3><b>Asset</b></h3></th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td></td>
                  <td colspan="3"><h4><b>Asset Lancar</b></h4></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='1100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"></td>
                  <td width="50%"><h5><?php echo $data[2] ?></h5></td>
                  <td width="40%"><h5><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$id'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></h5></td>
                </tr>

                <tfoot>
                <tr>
                  
                  <td colspan="3" align="center"><h4>Jumlah Aset Lancar</h4></td>
                  <td style="text-decoration: overline;"><h4><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='1100' AND YEAR(jurnal_umum.tanggal_input) = '$id'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='1100' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></h4></td>
                 </tr>
              </tfoot>
                
              </table>
            <br>
              <table border="0" width="100%">
                 <tr>
                  <td></td>
                  <td colspan="3"><h4><b>Asset Tidak Lancar</b></h4></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='1200' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"></td>
                  <td width="50%"><h5><?php echo $data[2] ?></h5></td>
                  <td width="40%"><h5><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$id'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></h5></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3" align="center"><h4>Jumlah Aset Tidak Lancar</h4></td>
                  <td style="text-decoration: overline;"><h4><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='1200' AND YEAR(jurnal_umum.tanggal_input) = '$id'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='1200' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></h4></td>
              </tfoot>
                
              </table>
              <br><br>
              <table border="0" width="100%">
               
               <thead><tr>
                  <th colspan="4"><h3>LIABILITAS & SALDO DANA</h3></th>
                   <tbody>
                </tr></thead> 
                <tr>
                  <td></td>
                  <td colspan="3"><h4><b>Liabilitas Jangka Pendek</b></h4></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='2100' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"></td>
                  <td width="50%"><h5><?php echo $data[2] ?></h5></td>
                  <td width="40%"><h5><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$id'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></h5></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3" align="center"><h4>Jumlah Liabilitas Jangka Pendek</h4></td>
                  <td style="text-decoration: overline;"><h4><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='2100' AND YEAR(jurnal_umum.tanggal_input) = '$id'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='2100' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></h4></td>
              </tfoot>  
              </table>
              <br>
              <table border="0" width="100%">
                <tr>
                  <td></td>
                  <td colspan="3"><h4><b>Liabilitas Jangka Panjang</b></h4></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='2200' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"></td>
                  <td width="50%"><h5><?php echo $data[2] ?></h5></td>
                  <td width="40%"><h5><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$id'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></h5></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3" align="center"><h4>Jumlah Liabilitas Jangka Panjang</h4></td>
                  <td style="text-decoration: overline;"><h4><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='2200' AND YEAR(jurnal_umum.tanggal_input) = '$id'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='2200' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></h4></td>
              </tfoot>
                
              </table>
           
              <table border="0" width="100%">
               <tr>
                  <td></td>
                  <td colspan="3"><h4><b>Saldo Dana</b></h4></td>
                </tr>
                <?php
            include("koneksi.php");
            $qry=mysql_query("SELECT * from akun WHERE induk='3000' GROUP BY akun.nama_akun ORDER BY akun.no_akun")or die(mysql_error());
            
            $no=1;
            while($data=mysql_fetch_array($qry)){
            ?>
           
                <tr>
                  <td colspan="2"></td>
                  <td width="50%"><h5><?php echo $data[2] ?></h5></td>
                  <td width="40%"><h5><?php 
                      $qry1=mysql_query("SELECT IF(SUM(debet-kredit), SUM(debet-kredit),0) FROM jurnal_umum WHERE no_akun='$data[0]' AND year(tanggal_input)='$id'")or die(mysql_error());
                       while($sa=mysql_fetch_array($qry1)){
                           $qr=mysql_query("SELECT SUM(`debet`) as debet, sum(kredit) as kredit FROM saldo_awal WHERE `periode`='$awal' AND no_akun = '$data[0]'")or die(mysql_error());
                              while($dat=mysql_fetch_array($qr)){
                                $saldo_awal=$dat[0]-$dat[1];
                        echo number_format($sa[0]+$saldo_awal);
                         }
                       }
                     }?></h5></td>
                </tr>
                <tfoot>
                <tr>
                  <td colspan="3" align="center"><h4>Jumlah Saldo Dana</h4></td>
                  <td style="text-decoration: overline;"><h4><?php 
                      $q=mysql_query("SELECT SUM(jurnal_umum.debet-jurnal_umum.kredit) AS saldo FROM akun INNER JOIN jurnal_umum on akun.no_akun=jurnal_umum.no_akun WHERE akun.induk='3000' AND YEAR(jurnal_umum.tanggal_input) = '$id'")or die(mysql_error());
                       while($da=mysql_fetch_array($q)){
                           $qra=mysql_query("SELECT SUM(saldo_awal.debet-saldo_awal.kredit) AS saldo FROM akun INNER JOIN saldo_awal ON akun.no_akun=saldo_awal.no_akun WHERE akun.induk='3000' AND saldo_awal.periode='$awal'")or die(mysql_error());
                              while($dt=mysql_fetch_array($qra)){
                                $saldo=$dt[0]+$da[0];
                        echo number_format($saldo);
                         }
                       }
                     ?></h4></td>
              </tfoot>
                
              </table>
           
  <table width="100%">
              <tr>
                <td align="right"><br><br><br><br><h4>Rembang,<?php echo date("d").' '.$bulan= getBulan(date("m")).' '.date("yy") ?> </td>
              </td>
              </tr>
              <tr>
                <td align="right"><br><br><br><br>
              </td>
              </tr>
              <tr>
                <td align="right">______________________________
              </td>
              </tr>
              <tr>
                <td align="right"><h4>            
              </td>
              </tr>
             </table>
              <?php
      }
        
        ?>
	<script>
		window.print();
	</script>
	
</body>
</html>