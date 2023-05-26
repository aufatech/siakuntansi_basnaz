<?php
include"koneksi.php";
?>
<?php
if (isset($_GET['update'])){
$id=$_GET['update'];
$qry=mysql_query("select * from akun where no_akun='$id'");
$data=mysql_fetch_assoc($qry);
echo '
<div class="card animated bounce">
  <div class="card-header">
    <h5 class="card-title">Ubah Data akun</h5
    </div>
  </div>
  <div class="card-body">
  <div class="table-responsive">
  <form method="post">
  <div class="form-group">
    <label>No Akun</label>
    <input type="text" name="t_noakun" class="form-control" value="'.$data['no_akun'].'" required="true" disabled/>
  </div>
  <div class="form-group">
    <label>Nama Akun</label>
    <input type="text" name="t_namaakun"  class="form-control" value="'.$data['nama_akun'].'" required="true" />
  </div>
  <div class="form-group">
    <label>Induk Akun</label>
    <select name="t_induk" class="form-control select2" id="t_level">
    <option value="">----Pilih Level----</option>
';
 $akn=mysql_query("select * from akun");
while($bi=mysql_fetch_array($akn)){
  if($data['induk']===$bi['no_akun']){

    $selected="selected";
  }else{
    $selected="";
  }
  echo '
        <option '.$selected.' value="'.$bi['no_akun'].'">'.$bi['nama_akun'].'</option>'; } echo '
    </select>
  </div>

  </div>
<br />
    <button type="submit" class="btn btn-danger" name="edit">Edit</button>
      <button type="submit" class="btn btn-warning"><a href="?admin=akun">Kembali</a></button>

</form>
</div>';
}
if (isset($_POST['edit'])){
$nm=$_POST['t_namaakun'];
$ti=$_POST['t_induk'];
$qry1=mysql_query("update akun set nama_akun='$nm', induk='$ti' where no_akun='$id'") or die(mysql_error());
if ($qry1){
echo '<script>alert("Data berhasil di Update");window.location.assign("admin.php?admin=akun");</script>';
}else{
echo '<script>alert("Data Gagal di Update")</script>';
}
}
?>
