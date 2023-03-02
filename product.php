<?php require_once 'inc/header.php'; ?>	

		<!-- product.php -->
		<div class="wrapper bg-dark-white">

			<!-- HEADER-AREA START -->
		<?php require_once 'inc/menu.php'; ?>	

			<!-- HEADER-AREA END -->
			<!-- Mobile-menu start -->
			<?php require_once 'inc/mobilmenu.php'; ?>	
			<!-- Mobile-menu end -->
			<?php 
			 $sef = get('productsef');
			 if(!$sef){
				go(site);
				}

				$product = $db->prepare("SELECT * FROM urunler WHERE urundurum=:d AND urunseflink=:se");
				$product->execute([':d'=> 1 ,':se'=> $sef]);
				if($product->rowcount()){
					$row = $product->fetch(PDO::FETCH_OBJ);
					}else{
						go(site);
					}
			
			
			
			
			
			
			?>	



			<!-- HEADING-BANNER START -->
			<div class="heading-banner-area overlay-bg"  style ="background: rgba(0, 0, 0, 0) url(<?php echo site;?>/uploads/product/<?php echo $row->urunbanner;?>) no-repeat scroll center center / cover;">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2><?php echo $row->urunbaslik; ?></h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="<?php echo site; ?>">ANA SAYFA</a></li>
										<li>ÜRÜN</li>
										<li><?php echo $row->urunbaslik; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- HEADING-BANNER END -->
			<!-- PRODUCT-AREA START -->
			<div class="product-area single-pro-area pt-80 pb-80 product-style-2">
				<div class="container">	
					<div class="row shop-list single-pro-info no-sidebar">
						<!-- Single-product start -->
						<div class="col-lg-12">
							<div class="single-product clearfix">
								<!-- Single-pro-slider Big-photo start -->
								<div class="single-pro-slider single-big-photo view-lightbox slider-for">
									<div>
										<img src="<?php echo site ."/uploads/product/".$row->urunkapak;  ?>" alt="<?php echo $row->urunbaslik;?>" width="370" height="450" />
										<a class="view-full-screen" href="<?php echo site ."/uploads/product/".$row->urunkapak;  ?>"  data-lightbox="roadtrip" data-title="<?php echo $row->urunbaslik;?>">
											<i class="zmdi zmdi-zoom-in"></i>
										</a>
										</div>
									 		</div>	
								<!-- Single-pro-slider Big-photo end -->								
								<div class="product-info">
									
									<div class="fix mb-20">
										<span class="pro-price"><b> Ürün Fiyat: </b><?php echo $row->urunfiyat."₺";?> | <b> Ürün Kodu: </b> <?php echo $row->urunkodu;?></span>
									</div>
									<div class="product-description">
										<p> <?php  echo strip_tags(mb_substr($row->urunicerik,0,500,'utf8'));?>  | 	<a href= "#description">Tüm açıklamayı oku </a></p>
									
									
									
									</div>
									<!-- color start -->								
									
									
									<div class="clearfix">
										
								
										<form action="" method="" onsubmit="return false;" id="addcartform">
								
											<input type="number" value="1" name="qty" class="cart-plus-minus-box">
											
									
										<div class="product-action clearfix">
										<input min="1" type="hidden" value="<?php echo $row->urunkodu;?>" name="pcode">
											
											
											<button type="submit" onclick="addcart();" id="addcartt" class="btn btn-default"><i class="zmdi zmdi-shopping-cart-plus">Sepete Ekle</i></button>
										</div>
										
									</div>
									<!-- Single-pro-slider Small-photo start -->
									
									<!-- Single-pro-slider Small-photo end -->
								</div>
							</div>
							</form>
						</div>
						<!-- Single-product end -->
					</div>
					<!-- single-product-tab start -->
					<div class="single-pro-tab">
						<div class="row">
							
							<div class="col-md-9">
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="description">
										<div class="pro-tab-info pro-description">
											<h3 class="tab-title title-border mb-30"><?php echo $row->urunbaslik; ?> Açıklaması </h3>
										
											<?php
											echo $row->urunicerik;

											?>
											
												
											




										</div>
									</div>
									<div class="tab-pane " id="reviews">
										<div class="pro-tab-info pro-reviews">
											<div class="customer-review mb-60">
												<h3 class="tab-title title-border mb-30">Customer review</h3>
												<ul class="product-comments clearfix">
													<li class="mb-30">
														<div class="pro-reviewer">
															<img src="img/reviewer/1.jpg" alt="" />
														</div>
														<div class="pro-reviewer-comment">
															<div class="fix">
																<div class="floatleft mbl-center">
																	<h5 class="text-uppercase mb-0"><strong>Gerald Barnes</strong></h5>
																	<p class="reply-date">27 Jun, 2021 at 2:30pm</p>
																</div>
																<div class="comment-reply floatright">
																	<a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
																	<a href="#"><i class="zmdi zmdi-close"></i></a>
																</div>
															</div>
															<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
														</div>
													</li>
													<li class="threaded-comments">
														<div class="pro-reviewer">
															<img src="img/reviewer/1.jpg" alt="" />
														</div>
														<div class="pro-reviewer-comment">
															<div class="fix">
																<div class="floatleft mbl-center">
																	<h5 class="text-uppercase mb-0"><strong>Gerald Barnes</strong></h5>
																	<p class="reply-date">27 Jun, 2021 at 2:30pm</p>
																</div>
																<div class="comment-reply floatright">
																	<a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
																	<a href="#"><i class="zmdi zmdi-close"></i></a>
																</div>
															</div>
															<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
														</div>
													</li>
												</ul>
											</div>
											<div class="leave-review">
												<h3 class="tab-title title-border mb-30">Leave your reviw</h3>
												<div class="your-rating mb-30">
													<p class="mb-10"><strong>Your Rating</strong></p>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
												</div>
												<div class="reply-box">
													<form action="#">
														<div class="row">
															<div class="col-md-6">
																<input type="text" placeholder="Your name here..." name="name" />
															</div>
															<div class="col-md-6">
																<input type="text" placeholder="Subject..." name="name" />
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<textarea class="custom-textarea" name="message" placeholder="Your review here..." ></textarea>
																<button type="submit" data-text="submit review" class="button-one submit-button mt-20">submit review</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>		
									</div>

									<div class="tab-pane" id="information">
										<div class="pro-tab-info pro-information">
											<h3 class="tab-title title-border mb-30"><?php echo $row->urunbaslik; ?> Özellikleri </h3>

											<div class="table-responsive">

											<table class="table">

												<?php
												
												$pskill = $db->prepare("SELECT * FROM urun_ozellikler WHERE ozellikurun=:u AND ozellikdurum=:d");
												$pskill->execute([':u'=>$row->urunkodu,':d'=>1]);
												if($pskill->rowCount()){
														foreach($pskill as $prow){
															?>	
														<tr>							
														<th><?php echo $prow['ozellikbaslik']; ?></th>
														<td><?php echo $prow['ozellikicerik']; ?>:</td>
														</tr>
											


															<?php

														}
												}else{
													alert('Ürün özelliği eklenmemiş','danger');
												}
												
												
												?>
													
												</table>
												
											</div>

											</div>											
									</div>
									
								</div>									
							</div>
						</div>
					</div>
					<!-- single-product-tab end -->
				</div>
			</div>
			<!-- PRODUCT-AREA END -->
			<!-- FOOTER START -->
			<?php require_once 'inc/footer.php'; ?>	