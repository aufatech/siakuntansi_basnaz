<?php
include "koneksi.php";
include "kode.php";

 ?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
            <div class="card-header">
              <h3 class="card-title">Transaksi <?php 
              $user=$_SESSION['username'];
             $qu=mysql_query("select * from user where username='$user'");
            while($iduser=mysql_fetch_array($qu)){
            echo $iduser['nama'];
            $kk=$iduser['id_user'];
            }  ?></h3>
              <div class="card-tools">
             <button class='btn btn-sm btn-flat btn-success animated swing' data-toggle='modal' data-target='#tambahtr'><i class='fa fa-check'></i> Tambah Akun</button>
            </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr bgcolor="pink">
                  <th>No</th>
                  <th>No Pembayaran</th>
                  <th>ID User</th>
                  <th>Nama User</th>
                  <th>Tgl Pembayaran</th>
                  <th>Jenis Transaksi</th>
                  <th>Jumlah Bayar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
    			  include("koneksi.php");
            
    			  $qry=mysql_query("SELECT transaksi.no_pembayaran, transaksi.id_user, user.nama, transaksi.tgl_pembayaran, transaksi.jenis_transaksi, transaksi.jumlah_bayar FROM transaksi INNER JOIN user ON transaksi.id_user=user.id_user WHERE transaksi.id_user='$kk'")or die(mysql_error());
    			  $no=1;
    			  while($data=mysql_fetch_array($qry)){

    			  ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $data[0] ?></td>
                  <td><?php echo $data[1] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><?php echo $data[3] ?></td>
                  <td><?php echo $data[4] ?></td>
                  <td><?php echo $data[5] ?></td>
                  <td><a href="?user=transaksiubah&&update=<?php echo $data[0] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?user=transaksihapus&&delete=<?php echo $data[0] ?>" onclick="return confirm('Apa Anda Yakin Mau dihapus??')" class="btn btn-danger btn-sm">Hapus</a>
                    <a href="?user=lihatd&&lihat=<?php echo $data[0] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                    <a href="?user=transaksicetak&&cetak=<?php echo $data[0] ?>" class="btn btn-success btn-sm">Cetak</a>
                </td>
                </tr>
                <?php

        }
        ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
 <div class="modal fade" id="tambahtr">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header bg-info">
              <h4 class="modal-title">Tambah Transaksi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method='post' enctype='multipart/form-data'>
                <div class='form-group'>
                  <label>Nomer Pembayaran</label>
                  <input type='text' name='t_nopem' class='form-control'  required='true' value='<?php echo kodeauto("transaksi","NPM") ?>' disabled/>
                </div>
                <div class='form-group'>
                  <label>ID User</label>
                  <input type='text' name='t_nopem' class='form-control'  required='true' value='<?php 
            $username=$_SESSION['username'];
            $q=mysql_query("select id_user from user where username='$username'");
            while($b=mysql_fetch_array($q)){
            echo "".$b['id_user']."";
            }  
            ?>' disabled/>
                </div>
                <div class='form-group'>
                  <label>Tanggal Transaksi</label>
                  <input type='text' name='t_tglpmbyrn' id='datepicker' class='form-control' value="<?php echo date('yy-m-d')?>" required='true'/>
                </div>
                <div class='form-group'>
                  <label>Jenis Transaksi</label>
                  <select name="t_jns_tr" class="form-control select2" id="t_level" required="true">
                    <option value="">----Pilih Jenis Transaksi----</option>
                    <?php
                    $brg=mysql_query("select * from jenis_transaksi");
                    while($b=mysql_fetch_array($brg)){
                      ?>
                      <option value="<?php echo $b['Nama']; ?>"><?php echo $b['Nama'] ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class='form-group'>
                  <label>Jumlah Bayar</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                      Rp.
                      </span>
                    </div>
                    <input type="text" name="t_jmlh" class="form-control float-right" >
                  </div>
                </div>
                 <div class="form-group">
                    <label for="customFile">Upload Bukti Pembayaran</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="simpan" class="btn btn-primary">Tambah</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php
if (isset($_POST['simpan'])){
function ka($table,$initial){
      $struktur = mysql_query("SELECT 'no_pembayaran' FROM ".$table);
      $field = mysql_field_name($struktur,0);
      $panjang = mysql_field_len($struktur,0);
      $qry=mysql_query("SELECT MAX(".$field.") FROM ".$table);
      $row=mysql_fetch_array($qry);
      if($row[0]==""){
        $angka=0;
      }else{
        $angka=substr($row[0],strlen($initial));

        }
        $angka++;
        $angka=strval($angka);
        $tmp="";
        for($i=1; $i<=($panjang-strlen($initial)-strlen($angka));$i++){
          $tmp=$tmp."0";
        }
      return $initial.$tmp.$angka;
      }
      $kode=ka("transaksi","NPM");
      $user=$_SESSION['username'];
            $q=mysql_query("select id_user from user where username='$user'");
            while($b=mysql_fetch_array($q)){
            $id=$b['id_user'];
            }  
      $tgl=$_POST['t_tglpmbyrn'];
      $jns=$_POST['t_jns_tr'];
      $jmlh=$_POST['t_jmlh'];
      
      $ekstensi_diperbolehkan = array('png','jpg');
      $nama = $_FILES['file']['name'];
      $x = explode('.', $nama);
      $ekstensi = strtolower(end($x));
      $ukuran = $_FILES['file']['size'];
      $file_tmp = $_FILES['file']['tmp_name'];  

      if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){      
          move_uploaded_file($file_tmp, 'img/'.$nama);
          $query = mysql_query("INSERT INTO `transaksi` (`no_pembayaran`, `id_user`, `tgl_pembayaran`, `jenis_transaksi`, `jumlah_bayar`, `upload`) VALUES ('$kode', '$id', '$tgl', '$jns', '$jmlh', '$nama');") or die(mysql_error());
          if($query){
            echo '<script>alert("Berhasil Disimpan.");window.location.assign("user.php?user=transaksi");</script>';
          }else{
            echo '<script>alert("Gagal UPload.");</script>';
          }
        }else{
          echo '<script>alert("File Terlalu Besar.");</script>';
        }
      }else{
        echo '<script>alert("Ekstensi tidak diperbolehkan.");</script>';
      }
}
?>