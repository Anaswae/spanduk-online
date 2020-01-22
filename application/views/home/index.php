<?php $this->load->view('home/header'); ?>


	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							

								<div class="item active">
									<div class="col-sm-6">
										<h1><span>Sistem Percetakan Online</span></h1>
										<h2>Mudah</h2>
										<p><?php echo strip_tags(substr('Lorem ipsum dolor sit amet, consectetur adipisicin...',0,200));?></p>

									</div>
									<div class="col-sm-6">
										<img src="<?php echo base_url();?>images/slider/slide3.jpg" class="girl img-responsive" alt="Tittle Pertama" />
										
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1><span>Sistem Percetakan Online</span></h1>
										<h2>Cepat</h2>
										<p><?php echo strip_tags(substr('Lorem ipsum dolor sit amet, consectetur adipisicin...',0,200));?></p>
									</div>
									<div class="col-sm-6">
										<img src="<?php echo base_url();?>images/slider/slide1.jpg" class="girl img-responsive" alt="Tittle Kedua" />

									</div>
								</div>

                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>Sistem Percetakan Online</span></h1>
                                        <h2>Praktis</h2>
                                        <p><?php echo strip_tags(substr('Lorem ipsum dolor sit amet, consectetur adipisicin...',0,200));?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url();?>images/slider/slide2.png" class="girl img-responsive" alt="Tittle Ketiga" />

                                    </div>
                                </div>

							

							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">

				
				<div class="col-sm-12">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Pilihan Toko</h2>
						
						<?php
						foreach ($toko->result_array() as $value) { ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img style="height: 240px; width: 260px" src="<?php echo base_url();?>images/toko/<?php echo $value['gambar'];?>" alt="" />
											<h2>Rp. <?php echo $value['harga'];?>/Meter</h2>
                                                <a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>"><h4 style="color: black"> <?php echo $value['nama_toko'];?></h4></a>
											<a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>" class="btn btn-default add-to-cart">Pesan</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
                                                <a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>"><img style="height: 240px; width: 260px" src="<?php echo base_url();?>images/toko/<?php echo $value['gambar'];?>" alt="" /></a>
                                                <a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>"><h2>Rp. <?php echo $value['harga'];?>/Meter</h2></a>
												<a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>"><h4 style="color: black"> <?php echo $value['nama_toko'];?></h4></a>
												<a href="<?php echo base_url();?>home/pesan/<?php echo $value['id_toko'];?>" class="btn btn-default add-to-cart">Pesan</a>
											</div>
										</div>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						
						
						
						
						
						
						
					</div><!--features_items-->
					
					
					

					
				</div>
			</div>
		</div>
	</section>

<?php $this->load->view('home/footer'); ?>