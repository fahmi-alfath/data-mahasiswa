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
									<div class="row">
									<form method="GET">
										<div class="col-md-2">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker1" name="from" value="<?php echo !empty($page_data['filter_from']) ? $page_data['filter_from'] : date("Y-m-d") ?>">
											</div>
											<!-- /.input group -->
										</div>
										<div class="col-md-1">
										<button type="button" class="btn btn-flat btn-default btn-block disabled"> <i class="fa fa-arrow-right"></i> </button>
										</div>
										<div class="col-md-2">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker1" name="to" value="<?php echo !empty($page_data['filter_to']) ? $page_data['filter_to'] : date("Y-m-d") ?>">
											</div>
											<!-- /.input group -->
										</div>
										<div class="col-md-1">
											<button type="submit" class="btn btn-flat btn-primary btn-block"><i class="fa fa-search"></i></button>
										</div>
									</form>
										<div class="col-md-3 col-md-offset-3">
											<a href="<?php echo base_url("TrPembelian/data_baru"); ?>" class="btn btn-flat btn-social btn-success pull-right"><i class="fa fa-plus"></i> TAMBAH DATA</a>
										</div>
									</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="tbl-pembelian" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>ID</th>
									<th>Dokumen</th>
									<th>Tanggal</th>
									<th>Supplier</th>
									<th>Total Pembelian</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php 
                                    $id = 1;
                                    foreach($page_data['data_pembelian'] as $row){ 
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td><?php echo $row->TrDocNo; ?></td>
									<td><?php echo $row->TrTanggal; ?></td>
									<td><?php echo $row->TrSupNama; ?></td>
									<td><?php echo "Rp. " . number_format($row->TrTotal); ?></td>
									<td>
										<a href="<?php echo base_url(); ?>TrPembelian/data_baru?TrDocNo=<?php echo $row->TrDocNo; ?>" class="btn btn-flat btn-sm btn-default bg-blue"><i class="fa fa-search"></i></a>
										<div class="btn-group pull-right">
											<a class="btn btn-default btn-flat btn-sm <?php if($row->TrStatus == '0'){ echo 'bg-yellow'; }elseif($row->TrStatus == '1'){ echo 'bg-green';}else{ echo 'bg-red'; } ?>"><?php echo $row->DataKet; ?></a>
											<a class="btn btn-default btn-flat btn-sm <?php echo $row->TrStatus == '0' ? '' : 'disabled'; ?> <?php if($row->TrStatus == '0'){ echo 'bg-yellow'; }elseif($row->TrStatus == '1'){ echo 'bg-green';}else{ echo 'bg-red'; } ?> dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="<?php echo base_url(); ?>TrPembelian/data_status?TrDocNo=<?php echo $row->TrDocNo; ?>&ChStatus=1" class="bg-green" onClick="return window.confirm('Proses Complete Data <?php echo $row->TrDocNo; ?>. Lanjutkan?')"><i class="fa fa-caret-right"></i> SELESAI</a></li>
												<li class="divider"></li>
												<li><a href="<?php echo base_url(); ?>TrPembelian/data_status?TrDocNo=<?php echo $row->TrDocNo; ?>&ChStatus=2" class="bg-red" onClick="return window.confirm('Proses Pembatalan Data <?php echo $row->TrDocNo; ?>. Lanjutkan?')"><i class="fa fa-caret-right"></i> BATAL</a></li>
											</ul>
										</div>
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
									<th>Dokumen</th>
									<th>Tanggal</th>
									<th>Supplier</th>
									<th>Total Pembelian</th>
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