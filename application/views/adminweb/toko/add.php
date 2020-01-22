<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Add Toko</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<?php if(validation_errors()) { ?>
								<div class="alert alert-block alert-error">
								  <button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo validation_errors(); ?>
								</div>
								<?php 
								} 
								?>

								<div id="form_sample_2" class="form-horizontal">
								
									<?php echo form_open_multipart('adminweb/toko_simpan/','class="form-horizontal"'); ?>
									
									<div class="control-group">
										<label class="control-label">Kode Toko</label>
										<div class="controls">
											<input type="text" name="kode_toko" id="kode_toko" class="span6 m-wrap" value="<?php echo $kode_toko;?>" readonly="true" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Nama Toko</label>
										<div class="controls">
											<input type="text" name="nama_toko" id="nama_toko" class="span6 m-wrap" placeholder="Nama Toko..." />
										</div>
									</div>
									


									

									<div class="control-group">
										<label class="control-label">Harga</label>
										<div class="controls">
											<input type="text" name="harga" id="harga" required="required" class="span6 m-wrap" placeholder="Harga..." />
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
													<input type="file" name="userfile" class="default" required="required" />
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
										<button type="submit" id="simpan" class="btn green"><i class="icon-ok"></i> Simpan</button>
										<a href="<?php echo base_url();?>adminweb/toko" class="btn white"><i class="icon-long-arrow-left"></i> Kembali</a>
										
									</div>
									<?php echo form_close(); ?>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>


