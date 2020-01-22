<div class="row-fluid">
					<div class="span12">
						
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Edit Toko</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
								</div>
							</div>
							<div class="portlet-body form">
								
								<div id="form_sample_2" class="form-horizontal">
								
									<?php echo form_open_multipart('adminweb/toko_update/','class="form-horizontal"'); ?>
									<input type="hidden" name='id_toko' value="<?php echo $id_toko;?>"> 

									<div class="control-group">
										<label class="control-label">Kode Toko</label>
										<div class="controls">
											<input type="text" name="kode_toko" id="kode_toko" class="span6 m-wrap" value="<?php echo $kode_toko;?>" readonly="true"/>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Nama Poduk</label>
										<div class="controls">
											<input type="text" name="nama_toko" id="nama_toko" class="span6 m-wrap" required="required" value="<?php echo $nama_toko;?>" />
										</div>
									</div>

									
									




									<div class="control-group">
										<label class="control-label">Harga</label>
										<div class="controls">
											<input type="text" name="harga" id="harga" required="required" class="span6 m-wrap" value="<?php echo $harga;?>" />
										</div>
									</div>



									

									

									<div class="control-group">
										<label class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="input-append">
													<div class="uneditable-input">
														<i class="icon-file fileupload-exists"></i> 
														<span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-file">
													<span class="fileupload-new">Select file</span>
													<span class="fileupload-exists">Change</span>
													<input type="file" name="userfile" class="default"/>
													</span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
										</div>
										<span class="label label-important">NOTE!</span>
											<span>
											File hanya dalam format gif,jpg,png,jpeg dengan resolusi 268PX x 249PX dan ukuran maksimal file sebesar 3 MB
											</span>
									</div>

									
									<div class="form-actions">
										<button type="submit" id="simpan" class="btn green"><i class="icon-ok"></i> Update</button>
										<a href="<?php echo base_url();?>adminweb/toko" class="btn white"><i class="icon-long-arrow-left"></i> Kembali</a>
										
									</div>
									<?php echo form_close(); ?>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>


