<?php
include "koneksi.php";
?>

<div class="col-12 animated bounce">
          <div class="card card-pink">
            <div class="card-header">
              <h3 class="card-title">Data Akun</h3>
              <div class="card-tools">
              <button class='btn btn-sm btn-flat btn-success animated swing' data-toggle='modal' data-target='#tambahakun'><i class='fa fa-check'></i> Tambah Akun</button>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr bgcolor="pink">
                  <th width="10px">No</th>
                  <th width="20px">No Akun</th>
                  <th width="30px">Nama Akun</th>
                  <th width="10px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
    			  include("koneksi.php");
    			  $qry=mysql_query("SELECT * FROM akun")or die(mysql_error());
    			  $no=1;
    			  while($data=mysql_fetch_array($qry)){

    			  ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $data[0] ?></td>
                  <td><?php echo $data[2] ?></td>
                  <td><a href="?admin=edita&&update=<?php echo $data[0] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="?admin=hapusa&&delete=<?php echo $data[0] ?>" onclick="return confirm('Apa Anda Yakin Mau dihapus??')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
                </tr>
                <?php
        }
        ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      <div class="modal fade" id="tambahakun">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header bg-info">
              <h4 class="modal-title">Tambah Akun</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action='akun_simpan.php' method='post'>
                <div class='form-group'>
                  <label>No Akun</label>
                  <input type='text' name='t_noakun' class='form-control'  required='true'/>
                </div>
                <div class='form-group'>
                  <label>Nama Akun</label>
                  <input type='text' name='t_namaakun'  class='form-control' required='true'/>
                </div>
                <div class='form-group'>
                  <label>Induk Akun</label>
                  <select name="t_induk" class="form-control select2" id="t_level">
                    <option value="">----Pilih Level----</option>
                    <?php
    								$brg=mysql_query("select * from akun where induk = ''");
    								while($b=mysql_fetch_array($brg)){
    									?>
                      <option value="<?php echo $b['no_akun']; ?>"><?php echo $b['nama_akun'] ?></option>
    									<?php
    								}
    								?>
                  </select>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
