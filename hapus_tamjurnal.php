<?php
include "koneksi.php";
?>
<?php
if (isset($_GET['delete'])){
$id=$_GET['delete'];
$qry=mysql_query("delete from jurnal_umum where no_jurnal ='$id'");
if ($qry) {
echo '<script>alert("Berhasil Hapus Data");
window.location.assign("admin.php?admin=jurnalumum");</script>';
}else{
echo '<script>alert("Data gagal dihapus")</script>';
}
}
?>
