<?php $this->load->view('home/header'); ?>

	
<section>
    <div id="contact-page" class="container">
    	<div class="bg">
	    	  	
    		<div class="row">  	
    			<h2 class="title text-center">PEMESANAN</h2>
	    		<div class="col-sm-offset-3 col-sm-6 ">
	    			<div class="contact-form" onmousemove="HitungText()">
	    				
	    				<?php 
									
							if ($this->session->flashdata('error')){
								echo "<div class='alert alert-block alert-danger show'>
									  	<button type='button' class='close' data-dismiss='alert'>×</button>
										<span>Username atau Email Telah Terdaftar!</span>
									</div>";
							}
							
												
							?>

						
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="forminput" method="post" action="<?php echo base_url();?>home/pesan_simpan">
				    		<div class="form-group col-md-12">
                            	<label style="color: #868682">Kode Pesanan *</label>
                                <input name="kode_pesan" class="form-control" value="<?php echo $kode_pesan; ?>" readonly="" />
                            </div>
                            <div class="form-group col-md-12">
                            	<label style="color: #868682">Toko *</label>
                                <select class="form-control" name="id_toko" readonly>
                                <?php
                                $harga =null;
								foreach ($toko->result_array() as $value) { 
								if ($value['id_toko'] == $id_toko) {
								?>
	                             	<option value="<?php echo $id_toko?>" selected><?php echo $value['nama_toko']?></option>
								<?php 
								$harga = $value['harga'];
								}
								}
								?>
								</select>
                            </div>

                            <div class="form-group col-md-12">
                            	<label style="color: #868682">Jenis Pesanan *</label>
                                <select class="form-control" name="jenis_pesanan">
                                	<option value="Spanduk" selected>Spanduk</option>
                                	<option value="Baliho">Baliho</option>
                                </select>
                            </div>


                            <div class="form-group col-md-12">
                            	<label style="color: #868682">Ukuran *</label>
                                <select class="form-control" name="ukuran" id="ukuran" onchange="Hitungbiaya()" onclick="Hitungbiaya()" onmousemove="Hitungbiaya()">
                                	<option value="3x2" selected>3x2 (Rp.<?php echo $harga;?>/Meter)</option>
                                	<option value="4x6">4x6 (Rp.<?php echo $harga;?>/Meter)</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                            	<label style="color: #868682">Total Biaya *</label>
                                <input name="biaya" id="biaya" class="form-control" placeholder="Biaya" readonly="" />
                            </div>

                            <div class="form-group col-md-12">
                            	<label style="color: #868682">Pesan *</label>
                                <textarea style="height: 100px" placeholder="Tinggalkan pesan anda" class="form-control" type='text' size='30' name='pesan' ></textarea>
							    
                            </div>

				            
				            
				        
				           
				                          
				            <div class="form-group col-md-6">
				                <p class="animate6 bounceIn"><button type="RESET" class="btn btn-danger btn-block">RESET</button></p>
				            </div>
				            <div  class="form-group col-md-6">
				                <p class="animate6 bounceIn"><button type="submit" class="btn btn-success btn-block">SUBMIT</button></p>
				            </div>				            
				        </form>
				       
	    			</div>
	    		</div>
	    			    		
   			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
  </section>
<script language='javascript'>
  function Hitungbiaya(){
    
    var ukuran = document.getElementById('ukuran').value;
    var biaya = document.getElementById('biaya');

 	if (ukuran == '3x2') {
 		this.forminput.biaya.value = 3*2*<?php echo $harga?>;
    } else {
    	this.forminput.biaya.value = 4*6*<?php echo $harga?>;
    }
	}


 
</script>




<?php $this->load->view('home/footer'); ?>