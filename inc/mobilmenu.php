<div class="mobile-menu-area">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 d-block d-md-none">
							<div class="mobile-menu">
								<nav id="dropdown">
											<ul>
										<li><a href="<?php echo site; ?>">ANA SAYFA</a>

										</li><li><a href="<?php echo site; ?>">ÜRÜNLER</a></li>
										<?php if(!isset($_SESSION['login'])){ ?>
										<li><a href="<?php echo site; ?>register.php">KAYIT OL</a></li>
										<li><a href="<?php echo site; ?>login.php">GİRİŞ YAP</a></li>
										<li><a onclick="return confirm('onaylıyor musunuz')"href="<?php echo site; ?>logout.php">ÇIKIŞ YAP</a></li>
										<?php }	else{ ?>

										<li><a href="<?php echo site; ?>profil.php">HESABIM</a></li>
										<?php }	?>

										<li><a href="<?php echo site; ?>contact.php">BİZE ULAŞIN</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>