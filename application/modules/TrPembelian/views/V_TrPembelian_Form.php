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
                    <form class="form-horizontal" role="form" action="<?php echo base_url("TrPembelian/data_proses") ?>" method="post">
                    <div class="box-header">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-md-3 hidden">
                                    <label class="col-md-4 control-label" for="TrID">ID</label>
                                    <div class="col-md-8">
                                        <input type="text" name="TrID" class="form-control col-md-10" id="TrID" placeholder="ID" value="<?php echo !empty($page_data["data_pembelian"]->TrID) ? $page_data["data_pembelian"]->TrID : ""; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-4 control-label" for="TrDocID">Dokumen</label>
                                    <div class="col-md-8">
                                        <input type="text" name="TrDocID" class="form-control col-md-10" id="TrDocID" placeholder="Auto Number" value="<?php echo !empty($page_data["data_pembelian"]->TrDocNo) ? $page_data["data_pembelian"]->TrDocNo : ""; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-4 control-label" for="TrTanggal">Tanggal</label>
                                    <div class="col-md-8">
                                        <input type="text" name="TrTanggal" class="form-control col-md-10" id="TrTanggal" placeholder="Tanggal" value="<?php echo !empty($page_data["data_pembelian"]->TrTanggal) ? $page_data["data_pembelian"]->TrTanggal : Date("Y-m-d"); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-md-4 control-label" for="TrStatus">Status</label>
                                    <div class="col-md-8">
                                        <?php 
                                            if(array_key_exists("TrStatus", $page_data["data_pembelian"])){
                                                $status = $page_data["data_pembelian"]->TrStatus;
                                            }else{
                                                $status = "";
                                            }
                                        ?>
                                        <input type="text" name="TrStatus" class="form-control col-md-10 <?php if($status == '0'){ echo 'bg-yellow'; }elseif($status == '1'){ echo 'bg-green';}else{ echo 'bg-red'; } ?>" id="TrStatus" placeholder="Status" value="<?php echo !empty($page_data["data_pembelian"]->DataKet) ? $page_data["data_pembelian"]->DataKet : '-'; ?>" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <button type="button" class="btn btn-danger btn-flat pull-right btn-social"><i class="fa fa-trash"></i>Hapus Data</button>    
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="form-group col-md-12">
                                        <label class="col-md-2 control-label" for="DataSupplier">Supplier</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="DataSupplier" <?php echo !empty($page_data["data_pembelian"]->TrID) ? "disabled" : ""; ?> required>
                                                <option disabled selected value>----- Pilih Supplier -----</option>
                                                <?php foreach($page_data["data_supplier"] as $row){ ?>
                                                    <option value="<?php echo $row->SupID . "-" . $row->SupNama ?>"><?php echo $row->SupNama . " - " . $row->SupAlamat; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-flat btn-block" <?php echo !empty($page_data["data_pembelian"]->TrID) ? "disabled" : ""; ?>><i class="fa fa-user-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="col-md-2 control-label" for="TrSupID"></label>
                                        <div class="col-md-3">
                                            <input type="text" name="TrSupID" class="form-control col-md-10" id="TrSupID" placeholder="ID Supplier" value="<?php echo !empty($page_data["data_pembelian"]->TrSupID) ? $page_data["data_pembelian"]->TrSupID : ""; ?>" readonly required>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="TrSupNama" class="form-control col-md-10" id="TrSupNama" placeholder="Nama Supplier" value="<?php echo !empty($page_data["data_pembelian"]->TrSupNama) ? $page_data["data_pembelian"]->TrSupNama : ""; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    
                    
                    <div class="box-body">
                    <form action="<?php echo base_url("TrPembelian/barang_update?".$_SERVER['QUERY_STRING']); ?>" method="post">
                    <?php if(!empty($page_data["data_pembelian"]->TrDocNo)){ ?>
                        <button type="button" class="btn btn-success btn-flat btn-social" data-toggle="modal" data-target="#modal-barang"><i class="fa fa-plus"></i>Tambah Barang</button>
                        <button type="submit" class="btn btn-warning btn-flat btn-social"><i class="fa fa-pencil-square-o"></i>Update Kuantitas</button>
                        <a href="<?php echo base_url(uri_string() . "?" . $_SERVER['QUERY_STRING']); ?>" class="btn btn-primary btn-flat btn-social-icon"><i class="fa fa-refresh"></i></a>
                        <hr/>
                        <table id="tbl-penjualan-barang" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Banyaknya</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $id = 1;
                                        foreach($page_data["data_pembelian_detail"] as $row){ 
                                    ?>
                                    <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $row->TrDetBarID; ?></td>
                                    <td><?php echo $row->TrDetBarNama; ?></td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="<?php echo "TrDetBarID-".$row->TrDetBarID."|TrDetID-".$row->TrDetID; ?>" value="<?php echo $row->TrDetBarJumlah; ?>">
                                            <div class="input-group-btn">
                                            <!-- <a href="<?php echo base_url($this->uri->segment(1) . "/update_barang" . "?" . $_SERVER['QUERY_STRING'] . "&TrDetID=" . $row->TrDetID); ?>" class="btn btn-flat btn-primary"><i class="fa fa-pencil-square-o"></i></a>-->
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp. <?php echo number_format($row->TrDetBarTotal); ?></td>
                                    <td align="center">
                                        <a href="<?php echo base_url($this->uri->segment(1) . "/barang_hapus" . "?" . $_SERVER['QUERY_STRING'] . "&TrDetID=" . $row->TrDetID); ?>" class="btn btn-flat btn-social-icon btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                    </tr>
                                    <?php 
                                        $id++;
                                        }
                                    ?>
                                </form>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Banyaknya</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                            </tfoot>
                        </table>
                    <?php } ?>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                	</div>
                <!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row (main row) -->

			<div class="modal fade bs-example-modal-lg" id="modal-barang">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Barang</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tbl-barang" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $id = 1;
                                    foreach($page_data["data_barang"] as $row){ 
                                ?>
                                <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $row->BarNama; ?></td>
                                <td><?php echo $row->BarSatuan; ?></td>
                                <td>Rp. <?php echo number_format($row->BarHarga); ?></td>
                                <td>Stok</td>
                                <td>
                                    <a href="<?php echo base_url($this->uri->segment(1) . '/barang_tambah' .'?'. $_SERVER['QUERY_STRING'] . '&BarID=' . $row->BarKode); ?>" class="btn btn-flat btn-social-icon btn-primary pull-right"><i class="fa fa-plus"></i></a>
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
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->