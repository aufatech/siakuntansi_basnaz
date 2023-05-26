<?php
session_start();
include("koneksi.php");
$username=$_POST['f_username'];
$password=$_POST['f_password'];
$qry=mysql_query("SELECT * FROM user WHERE username = '$username' AND password = md5('$password') AND status='1'") or die(mysql_error());
$cek=mysql_num_rows($qry);
$row=mysql_fetch_assoc($qry);
if($row['level'] == admin){
	$_SESSION['username'] = $username;
	$_SESSION['admin']=$username;
	header("Location:admin.php?admin=beranda");
				}

				else if($row['level'] == user){
	$_SESSION['username'] = $username;
	$_SESSION['user']=$username;
	header("Location:user.php?user=beranda");
				}else{
					echo "<script>alert('Pengguna tidak terdaftar');history.back(self);</script>";
		}
?>
