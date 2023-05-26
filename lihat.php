<?php
include"koneksi.php";
?>
<?php
if (isset($_GET['lihat'])){
$id=$_GET['lihat'];
$qry=mysql_query("SELECT transaksi.no_pembayaran, transaksi.id_user, user.nama, transaksi.tgl_pembayaran, transaksi.jenis_transaksi, transaksi.jumlah_bayar, transaksi.upload FROM transaksi INNER JOIN user ON transaksi.id_user=user.id_user where no_pembayaran='$id'");
$data=mysql_fetch_assoc($qry);
echo '
 <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Transaksi</h3>
              <div class="col-12"><br>
                <img src="img/'.$data['upload'].'" class="product-image" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><b>No Pembayaran : '.$data['no_pembayaran'].'</b></h3>
              <p></p>
              <hr>
              <table>
              <tr>
                <td><h4 class="mt-3">Nama Pembayar </h4></td>
                <td width="40%"><h4 class="mt-3">'.$data['nama'].'</h4></td></tr>
              <tr>
              <tr>
                <td><h4 class="mt-3">Tanggal Pembayaran    </h4></td>
                <td><h4 class="mt-3">'.$data['tgl_pembayaran'].'</h4></td>
              </tr>
              <tr>
                <td><h4 class="mt-3">Jenis Transaksi   </h4></td>
                <td><h4 class="mt-3">'.$data['jenis_transaksi'].'</h4></td>
              </tr>
              <tr>
                <td><h4 class="mt-3">Jumlah Bayar   </h4></td>
                <td><div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                 Rp.'.$data['jumlah_bayar'].'
                </h2>
              </div></td>
              </tr>
              <tr>
                <td><br></td>
                <td><br><a href="javascript:window.history.go(-1);">
                <div class="btn btn-info btn-lg btn-flat">
                  
                  <i class="fas fa-chevron-left  fa-lg mr-2"></i> 
                  Kembali
                </div></a></td>
              </tr>
             </table>
            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->';
}?>
