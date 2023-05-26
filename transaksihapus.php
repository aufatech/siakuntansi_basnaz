<?php
include "koneksi.php";
?>
<?php
if (isset($_GET['delete'])){
$id=$_GET['delete'];
$qry=mysql_query("delete from transaksi where no_pembayaran ='$id'");
if ($qry) {
echo '<script>alert("Berhasil Hapus Data");window.history.go(-1);</script>';
}else{
echo '<script>alert("Data gagal dihapus")</script>';
}
}
?>
