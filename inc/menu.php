
<?php
	
	$cartinfo =$db->prepare("SELECT * FROM sepet INNER JOIN urunler ON urunler.urunkodu = sepet.sepeturun WHERE sepetbayi=:b");
	if(isset($_SESSION['login'])){ 
	$cartinfo->execute([':b'=>$bcode]);
	}

	 

?>

<header id="sticky-menu" class="header header-2">
				<div class="header-area">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 offset-md-4 col-7">
								<div class="logo text-md-center">
									<a href="index.php"><img src="" alt="" /></a>
								</div>
							</div>
							<div class="col-md-4 col-5">
								<div class="mini-cart text-end">
									<ul>


										<li>
											<a class="cart-icon" href="#">
												<i class="zmdi zmdi-shopping-cart"></i>
												<span><?php echo $cartinfo->rowCount(); ?></span>
											</a>
											<div class="mini-cart-brief text-left">
												<div class="cart-items">
													<p class="mb-0">Sepetinizde <span><?php echo $cartinfo->rowCount(); ?></span> ürün bulunuyor</p>
												</div>
												<div class="all-cart-product clearfix">

												<?php
												$totalprice=0;
												if($cartinfo->rowCount()){
													 
													foreach($cartinfo as $cart){
														 $ptax = $cart['kdv'] == 0 ? '': '+KDV';  ?>
													
													<div class="single-cart clearfix">
														<div class="cart-photo">
															<a href="<?php echo $cart['urunseflink']; ?>"><img src="<?php echo site."uploads/product/".$cart['urunkapak'];  ?>" width="90" height="90" alt="<?php echo $cart['urunbaslik']; ?>" /></a>
														</div>
														<div class="cart-info">
															<h5><a href="<?php echo site."/product.php?productsef=".$cart['urunseflink']; ?>"><?php echo $cart['urunbaslik']; ?></a></h5>
															<p class="mb-0">Fiyat :<?php echo $cart['urunfiyat']."₺".$ptax; ?></p>
															<p class="mb-0">Adet :<?php echo $cart['sepetadet']; ?> </p>
															<p class="mb-0">KDVli fiyat :<?php echo $cart['toplamfiyat']; ?> </p>
															<span class="cart-delete">
																<a href="<?php echo site."/cart.php?productdelete&code=".$cart['sepeturun']; ?>"><i class="zmdi zmdi-close"></i></a>
															</span>
														</div>
													</div>
													<?php
													$totalprice +=$cart['toplamfiyat'];

												}
													}else{
														alert("sepetinizde ürün bulunmuyor","danger");	
													}?>

											</div>
											
												<div class="cart-totals">
													<h5 class="mb-0">TOPLAM : <span class="floatright"> <?php echo  $totalprice ; ?>₺</span></h5>
												</div>
												<div class="cart-bottom  clearfix">
													<a href="cart.php" class="button-one floatleft text-uppercase" data-text="Sepete git">Sepete Git</a>
												
												</div>
											</div>


										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- MAIN-MENU START -->
				<div class="menu-toggle menu-toggle-2 hamburger hamburger--emphatic d-none d-md-block">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<div class="main-menu  d-none d-md-block">
					<nav>
					<ul>
						<li><a href="<?php echo site; ?>">ANA SAYFA</a>
						</li><li><a href="<?php echo site; ?>">ÜRÜNLER</a></li>
						<?php if(!isset($_SESSION['login'])){ ?>
						<li><a href="<?php echo site; ?>login.php">KAYIT OL</a></li>
						<li><a href="<?php echo site; ?>login.php">GİRİŞ YAP</a></li>
						<?php }	else{ ?>
						<li><a href="<?php echo site; ?>profil.php">HESABIM</a></li>
						<li><a onclick="return confirm('Çıkış yapılacak onaylıyor musunuz ?')"href="<?php echo site; ?>logout.php">ÇIKIŞ YAP</a></li>
						<?php }	?>

						<li><a href="<?php echo site; ?>contact.php">BİZE ULAŞIN</a></li>
							</ul>
					</nav>
				</div>
				<!-- MAIN-MENU END -->
			</header>
			