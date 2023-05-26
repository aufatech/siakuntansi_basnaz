<?php include("koneksi.php");
  			function kodeauto($table,$initial){
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
			$kode=kodeauto("transaksi","NPM");
			$user=$_SESSION['username'];
            $q=mysql_query("select id_user from user where username='$user'");
            while($b=mysql_fetch_array($q)){
            $id=$b['id_user'];
            }  
			$tgl=$_POST['t_tglpmbyrn'];
			$jns=$_POST['t_jns_tr'];
			$jmlh=$_POST['t_jmlh'];
			
			$ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, 'img/'.$nama);
					$query = mysql_query("INSERT INTO `transaksi` (`no_pembayaran`, `id_user`, `tgl_pembayaran`, `jenis_transaksi`, `jumlah_bayar`, `upload`) VALUES ('$kode', '$id', '$tgl', '$jns', '$jmlh', '$nama');") or die(mysql_error());
					if($query){
						echo '<script>alert("Berhasil Disimpan.");window.location.assign("admin.php?admin=transaksi");</script>';
					}else{
						echo '<script>alert("Gagal UPload.");</script>';
					}
				}else{
					echo '<script>alert("File Terlalu Besar.");</script>';
				}
			}else{
				echo '<script>alert("Ekstensi tidak diperbolehkan.");</script>';
			}
?>
