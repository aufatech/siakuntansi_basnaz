<?php
include"koneksi.php";
?>
<?php
if (isset($_GET['update'])){
$id=$_GET['update'];
$qry=mysql_query("select * from saldo_awal where id='$id'");
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
     <label>Level</label>
    <select name="t_periode" class="form-control" id="t_level">
 <option value="'.$data['periode'].'">'.$data['periode'].'</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2021">2021</option>
 </select>
  </div>
  <div class="form-group">
    <label>Induk Akun</label>
    <select name="t_akun" class="form-control select2" id="t_level">
    <option value="">----Pilih Level----</option>
';
 $akn=mysql_query("select * from akun");
while($bi=mysql_fetch_array($akn)){
  if($data['no_akun']===$bi['no_akun']){

    $selected="selected";
  }else{
    $selected="";
  }
  echo '
        <option '.$selected.' value="'.$bi['no_akun'].'">'.$bi['nama_akun'].'</option>'; } echo '
    </select>
  </div>
  <div class="form-group">
    <label>Debet</label>
    <input type="text" name="t_debet"  class="form-control" value="'.$data['debet'].'" required="true" />
  </div>
  <div class="form-group">
    <label>Kredit</label>
    <input type="text" name="t_kredit"  class="form-control" value="'.$data['kredit'].'" required="true" />
  </div>
  <div class="form-group">
    <label>Tanggal Masuk</label>
    <input type="text" name="t_tgl"  class="form-control" id="datepicker" value="'.$data['tgl_masuk'].'" required="true" />
  </div>
  </div>
<br />
    <button type="submit" class="btn btn-danger" name="edit">Edit</button>
      <a href="?admin=saldoawal"><button type="submit" class="btn btn-warning">Kembali</button></a>

</form>
</div>';
}
if (isset($_POST['edit'])){
$user=$_SESSION['username'];
$q=mysql_query("select id_user from user where username='$user'");
while($b=mysql_fetch_array($q)){
$i=$b['id_user'];
}  
$periode=$_POST['t_periode'];
$tgl=$_POST['t_tgl'];
$noakun=$_POST['t_akun'];
$dbt=$_POST['t_debet'];
$krdt=$_POST['t_kredit'];
$qry1=mysql_query("update saldo_awal set periode='$periode', no_akun='$noakun', debet = '$dbt', kredit='$krdt', tgl_masuk='$tgl', id_user='$i' where id='$id'") or die(mysql_error());
if ($qry1){
echo '<script>alert("Data berhasil di Update");window.location.assign("admin.php?admin=saldoawal");</script>';
}else{
echo '<script>alert("Data Gagal di Update")</script>';
}
}
?>
