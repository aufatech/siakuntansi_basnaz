<?php
include("koneksi.php");
if (isset($_GET['update'])){
$id=$_GET['update'];
$qry=mysql_query("select * from jurnal_umum where no_jurnal='$id'");
$data=mysql_fetch_assoc($qry);
echo'
<div class="col-12 animated bounce">
          <div class="card card-pink">
                        <div class="card-header">
                          <h3 class="card-title">Edit Jurnal Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <form method="post">
                            <div class="row">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Tanggal</label>
                                  <input type="text" name="q_tanggal" class="form-control" id="datepicker" value="'.$data['tanggal_input'].'">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Tanggal</label>
                                  <input type="text" name="q_inp" class="form-control" id="datepicker" value="'.$data['tgl_jurnal'].'" disabled>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>No Jurnal</label>
                                  <input type="text" class="form-control" name="q_nojur" value="'.$data['no_jurnal'].'" disabled>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>ID User</label>
                                  <input type="text" class="form-control" name="q_id_user" value="'.$data['id_user'].'" disabled>
                                </div>
                              </div>
                            </div>

                            <div class="row">

                              <div class="col-sm-4">
                                <!-- textarea -->
                                <div class="form-group">
                                  <label>Akun </label>
                                  <select name="q_akun" class="form-control select2" id="t_level" required="true">
                                    <option value="0">----Pilih Akun----</option>
                                    ';
                                       $akm=mysql_query("select * from akun where induk != ''");
                                      while($bia=mysql_fetch_array($akm)){
                                        if($data['no_akun']===$bia['no_akun']){

                                          $selected="selected";
                                        }else{
                                          $selected="";
                                        }
                                        echo '
                                        <option '.$selected.' value="'.$bia['no_akun'].'">'.$bia['nama_akun'].'</option>'; } echo '
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Debet</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        Rp.
                                      </span>
                                    </div>
                                    <input type="number" name="q_debet" class="form-control float-right" value="'.$data['debet'].'">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Kredit</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          Rp.
                                        </span>
                                      </div>
                                      <input type="number" name="q_kredit" class="form-control float-right" value="'.$data['kredit'].'">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Keterangan</label>
                                  <input class="form-control" placeholder="Keterangan ...." name="q_keterangan" value="'.$data['keterangan'].'"/>
                                </div>
                              </div>
                              </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <div class="row">
                            <div class="card-tools">
                            <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                           
                              </div>
                          </div>
                          <!-- /.row -->
                        </div>

                      </form>
                      </div>
                    </div>
                    
        </div>
      </div>';
    }
if (isset($_POST['edit'])){
$tgl=$_POST['q_tanggal'];
$noakun=$_POST['q_akun'];
$dbt=$_POST['q_debet'];
$krdt=$_POST['q_kredit'];
$ket=$_POST['q_keterangan'];
$qry1=mysql_query("update jurnal_umum set tgl_jurnal='$tgl', no_akun='$noakun', debet='$dbt', kredit='$krdt', keterangan='$ket' where no_jurnal='$id'") or die(mysql_error());
if ($qry1){
echo '<script>alert("Data berhasil di Update");window.location.assign("admin.php?admin=jurnalumum");</script>';
}else{
echo '<script>alert("silahkan cek data lagi")</script>';
}
}
?>
