<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-edit"></i>Daftar Pesanan Masuk</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-toolbar">
									<div class="btn-group">
										
										
									</div>
									
								</div>
								<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Pesanan</th>
											<th>Nama Toko</th>
											<th>Jenis Pesanan</th>
											<th>Ukuran</th>
											<th>Biaya</th>
											<th>Pesan</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$no=1;
										if ($data_transaksi->num_rows()>0) {
											foreach ($data_transaksi->result_array() as $tampil) { ?>
										<tr >
											<td><?php echo $no;?></td>
											<td><?php echo $tampil['kode_pesanan'];?></td>
											<td><?php echo $tampil['nama_toko'];?></td>
											<td><?php echo $tampil['jenis_pesanan'];?></td>
											<td><?php echo $tampil['ukuran'];?></td>
											<td><?php echo $tampil['biaya'];?></td>
											<td><?php echo $tampil['pesan'];?></td>

										</td>
										</tr>
										<?php
										$no++;
										}
										}
										
										else { ?>
										<tr>
											<td colspan="12">No Result Data</td>
										</tr>
										<?php

										}
										?>
										
									</tbody>
								</table>
							</div>
						</div>
						
					</div>
				</div>

				


				


