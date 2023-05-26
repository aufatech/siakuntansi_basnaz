<?php
include("koneksi.php");
include("fungsi.php");
$auto=kodeauto("jurnal_umum","NJU");
?>
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Tambah Jurnal Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <form method="post">
                            <div class="row">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Tanggal Input</label>
                                  <input type="text" name="q_tanggal" class="form-control datepicker" id="datepicker" value="<?php echo date('yy-m-d')?>">
                                </div>
                              </div>
                             <div class="col-sm-3">
                               <div class="form-group">
                                  <label>No Jurnal</label>
                                  <input type="text" name="q_inp" class="form-control" id="datepicker" value="<?php echo date("Y-m-d H:i:s")?>" disabled>
                                </div>
                             </div>
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>No Jurnal</label>
                                  <input type="text" class="form-control" name="q_nojur" value="<?php echo $auto; ?>" disabled>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>ID User</label>
                                  <input type="text" class="form-control" name="q_id_user" value=" <?php
                                  $username=$_SESSION['username'];
                                  $q=mysql_query("select id_user from user where username='$username'");
                                  while($b=mysql_fetch_array($q)){
                                  echo $b['id_user'];
                                  }  
                                  ?>" disabled>
                                </div>
                              </div>
                            </div>

                            <div class="row">

                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label>No Bukti</label>
                                  <input type="text" name="q_bukti" class="form-control" autofocus="true">
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                  <label>Akun </label>
                                  <select name="q_akun" class="form-control select2" id="t_level" required='true'>
                                    <option value="0">----Pilih Akun----</option>
                                    <?php
                                    $brg=mysql_query("SELECT * FROM `akun` WHERE `induk` != ''");
                                    while($b=mysql_fetch_array($brg)){
                                      ?>
                                      <option value="<?php echo $b['no_akun']; ?>"> <?php echo $b['nama_akun'] ?></option>
                                      <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <label>Debet</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        Rp.
                                      </span>
                                    </div>
                                    <input type="number" name="q_debet" class="form-control float-right" value="0">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label>Kredit</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          Rp.
                                        </span>
                                      </div>
                                      <input type="number" name="q_kredit" class="form-control float-right" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label>Keterangan</label>
                                  <input class="form-control" placeholder="Keterangan ...." name="q_keterangan"/>
                                </div>
                                  <div class="card">
                          <div class="row"><div class="col-sm-12">
                            <div class="card-tools">
                              
                            <button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah</button>
                           </div>
                         </div>
                          </div>
                          <!-- /.row -->
                        </div>
                              </div>
                              <div class="col-sm-8">
                              <div class="card-body ">
              <table id="example" class="table table-bordered table-striped ">
                <thead>
                <tr bgcolor="pink">
                  <th width="10px">No</th>
                  <th width="30px">No Bukti</th>
                  <th width="30px">Nama Akun</th>
                  <th width="20px">Debet</th>
                  <th width="30px">Kredit</th>
                  <th width="10px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                  $qry=mysql_query("SELECT jurnal_umum.no_bukti, akun.nama_akun, jurnal_umum.debet, jurnal_umum.kredit FROM jurnal_umum INNER JOIN akun ON jurnal_umum.no_akun=akun.no_akun WHERE jurnal_umum.no_jurnal=''
      ")or die(mysql_error());
                  $no=1;
                   while($data=mysql_fetch_array($qry)){
                     echo '<tr>
                       <td>'.$no++.'</td>
                       <td>'.$data[0].'</td>
                       <td>'.$data[1].'</td>
                       <td>'.$data[2].'</td>
                       <td>'.$data[3].'</td>
                       <td><a href="?admin=hapusju&&delete='.$data[0].'" onclick="return confirm("Apa Anda Yakin Mau dihapus??"")" class="btn btn-danger btn-sm">Hapus</a>
                     </td>
                     </tr>';

                   }

                   ?>
                  <?php
                 
        if (isset($_POST['tambah'])){   

$user=$_SESSION['username'];
$q=mysql_query("select id_user from user where username='$user'");
while($b=mysql_fetch_array($q)){
$id=$b['id_user'];
}  
$tgl=$_POST['q_tanggal'];
$noakun=$_POST['q_akun'];
$nobukti=$_POST['q_bukti'];
$dbt=$_POST['q_debet'];
$krdt=$_POST['q_kredit'];
$ket=$_POST['q_keterangan'];
$inp=date("Y-m-d H:i:s");
$qry1=mysql_query("INSERT INTO `jurnal_umum`(`no`, `no_jurnal`, `no_bukti`, `tgl_jurnal`, `no_akun`, `debet`, `kredit`, `id_user`, `tanggal_input`, `keterangan`, `status`) VALUES (NULL, '',$nobukti,'$inp','$noakun','$dbt','$krdt','$id','$tgl','$ket', '0')") or die(mysql_error());
if ($qry1){
 echo '<script>window.location.assign("admin.php?admin=tambahj");</script>';
}else{
echo '<script>alert("silahkan cek data lagi")</script>';
}
}
        ?>
              </table>
            </div>
             <div class="card-footer">
                          <div class="row">
                            <div class="col-sm-12">
                            <div class="card-tools">
                            <button type="submit" class="btn btn-info btn-block" name="simpan">Simpan</button>
                           </div>
                              </div>
                          </div>
                          <!-- /.row -->
                        </div>
                              </div>

                              </div>
                        <!-- /.card-body -->
                      

                      </form>
                      </div>
                    </div>
                    
        </div>
      </div>
      <?php
if (isset($_POST['simpan'])){
  function kodeau($table,$initial){
$struktur = mysql_query("SELECT `no_jurnal` FROM ".$table);
$field = mysql_field_name($struktur,0);
$panjang = mysql_field_len($struktur,0);
$qry=mysql_query("SELECT MAX(".$field.") FROM ".$table );
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
$nojur=kodeau("jurnal_umum","NJU");
$qry1=mysql_query("update jurnal_umum set no_jurnal='$nojur', status='1' where no_jurnal=''") or die(mysql_error());
if ($qry1){
echo '<script>alert("Data berhasil di Update");window.location.assign("admin.php?admin=jurnalumum");</script>';
}else{
echo '<script>alert("lakukan pengimputan terlebih dahulu")</script>';
}
}
?>