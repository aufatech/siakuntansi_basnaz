<?php
include"koneksi.php";
?>
<?php
if (isset($_GET['konfirm'])){
$id=$_GET['konfirm'];
$qry1=mysql_query("update user set status='1' where id_user='$id'") or die(mysql_error());
if ($qry1){
echo '<script>alert("Data berhasil di konfirmasi");window.location.assign("admin.php?admin=pengguna");</script>';
}else{
echo '<script>alert("Data Gagal di Update")</script>';
}
}
?>
