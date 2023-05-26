<?php
include "koneksi.php";
?>
<?php
if (isset($_GET['delete'])){
$bkt=$_GET['delete'];
$qry=mysql_query("delete from jurnal_umum where no_bukti ='$bkt'");
if ($qry) {
echo '<script>alert("Berhasil Hapus Data");
window.location.assign("admin.php?admin=tambahj");</script>';
}else{
echo '<script>alert("Data gagal dihapus")</script>';
}
}
?>