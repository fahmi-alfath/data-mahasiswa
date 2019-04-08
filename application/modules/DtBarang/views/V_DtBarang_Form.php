
			<!-- Main row -->
			<div class="row">
				<div class="col-xs-12">
                    <?php if(!empty($this->session->flashdata("st_class"))){ ?>
						<div class="alert alert-<?php echo $this->session->flashdata("st_class"); ?>">
							<?php echo $this->session->flashdata("st_message"); ?>
						</div>
					<?php } ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url("DtBarang/data_proses") ?>" method="post">
                    <div class="box-body">
						<div class="container">
							<div class="row">
								<div class="col-md-7">
									<div class="row">
										<div class="form-group col-md-4">
											<label for="BarID">ID</label>
											<input type="text" name="BarID" class="form-control" id="BarID" placeholder="ID" value="<?php echo !empty($page_data['Barang']->BarID) ? $page_data['Barang']->BarID : ""; ?>" readonly>
										</div>
										<div class="form-group col-md-8">
											<label for="BarKode">Kode Barang</label>
											<input type="text" name="BarKode" class="form-control" id="BarKode" placeholder="Auto Number" value="<?php echo !empty($page_data['Barang']->BarKode) ? $page_data['Barang']->BarKode : ""; ?>" readonly>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-7">
											<label for="BarNama">Nama Barang</label>
											<input type="text" name="BarNama" class="form-control" id="BarNama" placeholder="Nama Barang" value="<?php echo !empty($page_data['Barang']->BarNama) ? $page_data['Barang']->BarNama : ""; ?>" required>
										</div>
										<div class="form-group col-md-5">
											<label for="BarSatuan">Satuan</label>
											<select class="form-control" name="BarSatuan">
												<?php foreach($page_data['data_satuan'] as $row){ ?>
													<option <?php if(!empty($page_data['Barang']->BarSatuan)){ echo $row->DataNama == $page_data['Barang']->BarSatuan ? "selected" : ""; }; ?> value="<?php echo $row->DataNama; ?>"><?php echo $row->DataKet; ?></option>
												<?php } ?>
											</select>
											<!-- <input type="text" name="BarSatuan" class="form-control" id="BarSatuan" placeholder="No. Satuan" value="<?php echo !empty($page_data['Barang']->BarSatuan) ? $page_data['Barang']->BarSatuan : ""; ?>" required> -->
										</div>
									</div>
									<div class="form-group">
										<label for="BarHarga">Harga</label>
										<div class="input-group">
											<span class="input-group-addon">Rp. </span>
											<input type="text" name="BarHarga" class="form-control" placeholder="Harga" id="BarNama" value="<?php echo !empty($page_data['Barang']->BarHarga) ? $page_data['Barang']->BarHarga : ""; ?>" required>
											<span class="input-group-addon">,-</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-flat btn-social btn-primary btn-block"><i class="fa fa-save"></i> Simpan Data</button>
									<!-- <button type="reset" class="btn btn-flat btn-social btn-warning btn-block"><i class="fa fa-refresh"></i>Reset Data</button> -->
									<button type="button" onClick="window.history.go(-1); return false;" class="btn btn-flat btn-social btn-default btn-block"><i class="fa fa-share"></i>Kembali</button>
								</div>
							</div>
						</div>
                    </div>
                    <!-- /.box-body -->

                    <!-- <div class="box-footer">
                    </div> -->
                    </form>
                </div>
                <!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row (main row) -->