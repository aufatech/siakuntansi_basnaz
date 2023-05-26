<?php
include"koneksi.php";
?>
<?php
if (isset($_GET['update'])){
$id=$_GET['update'];
$qry=mysql_query("select * from transaksi where no_pembayaran='$id'");
$data=mysql_fetch_assoc($qry);
echo'
<div class="card animated bounce">
  <div class="card-header">
    <h5 class="card-title">Ubah Transaksi '.$data['no_pembayaran'].' </h5
    </div>
  </div>
  <div class="card-body">
  <div class="table-responsive">
  <form method="post" enctype="multipart/form-data" >
  <div class="form-group">
    <label>ID User</label>
    <input type="text" name="t_iduser" class="form-control"  required="true" value="'.$data['id_user'].'" disabled/>
  </div>
  <div class="form-group">
    <label>Tanggal Pembayaran</label>
    <input type="text" name="t_tgl" id="datepicker" class="form-control"  required="true" value="'.$data['tgl_pembayaran'].'"/>
  </div>
  <div class="form-group">
    <label>Jenis Transaksi</label>
    <select name="t_jns" class="form-control select2" id="t_level">
    <option value="">----Pilih Transaksi----</option>
';
 $akm=mysql_query("select * from jenis_transaksi");
while($bia=mysql_fetch_array($akm)){
  if($data['jenis_transaksi']===$bia['Nama']){

    $selected="selected";
  }else{
    $selected="";
  }
  echo '
        <option '.$selected.' value="'.$bia['Nama'].'">'.$bia['Nama'].'</option>'; } echo '
    </select>
  </div>
  <div class="form-group">
    <label>Jumlah Pembayaran</label>
    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                      Rp.
                      </span>
                    </div>
                    <input type="text" name="t_jmlh" class="form-control float-right" value="'.$data['jumlah_bayar'].'">
                  </div>
  </div>
  <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    <img src="img/'.$data['upload'].'" width="50" class="img-responsive">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="f_gambar" value="'.$data['upload'].'">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
 
<br />
    <button type="submit" class="btn btn-danger" name="edit">Edit</button>
    <button type="submit" class="btn btn-warning"><a href="?admin=pengguna">Kembali</a></button>
</form>
</div>';

}
if (isset($_POST['edit'])){
$tgl=$_POST['t_tgl'];
$jns=$_POST['t_jns'];
$jml=$_POST['t_jmlh'];
$gambar=$_FILES['f_gambar']['name'];
$move=move_uploaded_file($_FILES['f_gambar']['tmp_name'],"img/".$gambar);
if ($move){
  mysql_query("update transaksi set tgl_pembayaran='$tgl', jenis_transaksi='$jns', jumlah_bayar='$jml', upload='$gambar' where no_pembayaran='$id'") or die(mysql_error());
echo '<script>alert("Data berhasil di Update");window.history.go(-2);</script>';
}else{
  mysql_query("update transaksi set tgl_pembayaran='$tgl', jenis_transaksi='$jns', jumlah_bayar='$jml' where no_pembayaran='$id'") or die(mysql_error());
echo '<script>alert("Data berhasil di Ubah");window.history.go(-2);</script>';
}
}
?>
