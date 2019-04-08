			<!-- Main row -->
			<div class="row">
				<div class="col-xs-12">
					<?php if(!empty($this->session->flashdata("st_class"))){ ?>
						<div class="alert alert-<?php echo $this->session->flashdata("st_class"); ?>">
							<?php echo $this->session->flashdata("st_message"); ?>
						</div>
					<?php } ?>
					<div class="box">
						<div class="box-header">
								<a href="<?php echo base_url("DtBarang/data_baru"); ?>" class="btn btn-flat btn-social btn-success pull-right"><i class="fa fa-plus"></i> TAMBAH DATA</a>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="tbl-barang" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>ID</th>
									<th>Kode</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php 
                                    $id = 1;
                                    foreach($page_data['data_barang'] as $row){ 
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td><?php echo $row->BarKode; ?></td>
									<td><?php echo $row->BarNama; ?></td>
									<td><?php echo $row->BarSatuan; ?></td>
									<td><?php echo "Rp. ". number_format($row->BarHarga); ?></td>
									<td align='center'>
										<a href="<?php echo base_url('DtBarang/data_ubah/'.$row->BarID); ?>" class="btn btn-flat btn-social-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-pencil-square-o"></i></a>
										<a href="<?php echo base_url('DtBarang/data_hapus/'.$row->BarID); ?>" class="btn btn-flat btn-social-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Data" onClick="return window.confirm('Data Akan Dihapus. Lanjutkan?')"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								<?php
                                    $id++;
                                    }
								?>
								</tbody>
								<tfoot>
								<tr>
									<th>ID</th>
									<th>Kode</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row (main row) -->