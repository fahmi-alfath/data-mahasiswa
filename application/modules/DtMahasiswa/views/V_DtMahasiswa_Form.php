<!-- <div class="alert alert-danger" role="alert">
<?php echo validation_errors(); ?>
</div> -->
<br/>
<div class="row">
    <div class="col-md-8">
        <form action="<?php echo base_url() . 'DtMahasiswa/proses' ?>" method="POST">
        <div class="form-group row">
            <label for="MahasiswaNIM" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-9">
            <input type="hidden" class="form-control" name="MahasiswaID" id="MahasiswaID" value="<?php echo !empty($page_data['data_mahasiswa']->MahasiswaID) ? $page_data['data_mahasiswa']->MahasiswaID : ""; ?>">
            <input required autofocus type="text" class="form-control" name="MahasiswaNIM" id="MahasiswaNIM" placeholder="NIM" value="<?php echo !empty($page_data['data_mahasiswa']->MahasiswaNIM) ? $page_data['data_mahasiswa']->MahasiswaNIM : ""; ?>">
            <?php echo form_error('MahasiswaNIM'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="MahasiswaNama" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
            <input required type="text" class="form-control" name="MahasiswaNama"  id="MahasiswaNama" placeholder="Nama Lengkap" value="<?php echo !empty($page_data['data_mahasiswa']->MahasiswaNama) ? $page_data['data_mahasiswa']->MahasiswaNama : ""; ?>">
            <?php echo form_error('MahasiswaNama'); ?>
            </div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-primary col-sm-6"><span data-feather="save"></span> | Simpan</button>
            <button type="button" onClick="window.history.go(-1); return false;" class="btn btn-outline-secondary float-right"><span data-feather="corner-up-left"></span> | Kembali</button>
        </div>
        </div>
        </form>
    </div>
</div>
