                    <?php if(!empty($this->session->flashdata("st_class"))){ ?>
                        <br/>
						<div class="alert alert-<?php echo $this->session->flashdata("st_class"); ?>">
							<?php echo $this->session->flashdata("st_message"); ?>
						</div>
					<?php } ?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="<?php echo base_url() . 'DtMahasiswa/data_tambah/'; ?>" class="btn btn-sm btn-success">
                                    <span data-feather="plus-square"></span>
                                    Tambah Data
                                </a> 
                                <a href="<?php echo base_url() . 'DtMahasiswa/laporan/'; ?>" class="btn btn-sm btn-primary">
                                    <span data-feather="file-text"></span>
                                    Lihat Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Tahun Masuk</th>
                                    <th>Program Studi</th>
                                    <th>Kelas</th>
                                    <th>Jenjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    foreach ($page_data['data_mahasiswa'] as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value->MahasiswaNIM; ?></td>
                                        <td><?php echo $value->MahasiswaNama; ?></td>
                                        <td><?php echo $value->MahasiswaTahunMasuk; ?></td>
                                        <td><?php echo $value->ProdiNama; ?></td>
                                        <td><?php echo $value->KelasNama; ?></td>
                                        <td><?php echo $value->JenjangNama; ?></td>
                                        <th>
                                            <div class="btn-group mr-2">
                                                <a href="<?php echo base_url() . 'DtMahasiswa/data_update/' . $value->MahasiswaID; ?>" class="btn btn-sm btn-primary" title="Update">
                                                    <span data-feather="edit"></span>
                                                </a>
                                                <a href="<?php echo base_url() . 'DtMahasiswa/data_hapus/' . $value->MahasiswaID; ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onClick="return window.confirm('Data Akan Dihapus. Lanjutkan?')">
                                                    <span data-feather="trash"></span>
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                <?php 
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>