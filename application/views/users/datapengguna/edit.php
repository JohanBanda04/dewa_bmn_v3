<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Pengguna</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control"
                             value="<?php echo $query->nama_lengkap; ?>"
                             placeholder="Nama" required autofocus
                             onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Level</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="level" selected="<?php echo $query->level; ?>" required>
                        <option value="">- Pilih Level-</option>
                        <option value="kanwil" <?php if($query->level=='kanwil') echo 'selected="selected"'; ?>>Kanwil</option>
                        <option value="satker" <?php if($query->level=='satker') echo 'selected="selected"'; ?>>Satker</option>
                        <option value="superadmin" <?php if($query->level=='superadmin') echo 'selected="selected"'; ?>>Superadmin</option>
                      </select>
                    </div>
                  </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">Satker</label>
                        <div class="col-lg-9">
                            <select class="form-control default-select2" name="satker"
                                    selected="" required>
                                <option value="">- Pilih Satker -</option>
                                <?php foreach ($query_satker as $index=>$satker) { ?>
                                    <option <?php if ($satker->id==$query->satker_id){
                                        ?> selected <?php
                                    }?> style="color: black"
                                            value="<?php echo $satker->id; ?>">
                                        <?php echo $satker->nama_satker; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="<?php echo $query->username; ?>" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="<?php echo $query->password; ?>" placeholder="Password" required>
					  <i style="color: red;">*Password tidak boleh kosong.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Re-Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control" value="<?php echo $query->password; ?>" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate"
                          onclick="return confirm('Anda yakin untuk mengubah data?');"
                          class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

