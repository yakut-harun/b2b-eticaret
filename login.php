<?php require_once 'inc/header.php';


if( @$_SESSION['login'] == @sha1(md5(IP().$bcode)) ){
    go(site);
}
?>	

		<!-- WRAPPER START -->
		<div class="wrapper bg-dark-white">

			<!-- HEADER-AREA START -->
			<?php require_once 'inc/menu.php'; ?>	

			<!-- HEADER-AREA END -->
			<!-- Mobile-menu start -->
			<?php require_once 'inc/mobilmenu.php'; ?>	

			<!-- Mobile-menu end -->
			<!-- HEADING-BANNER START -->
			<div class="heading-banner-area overlay-bg"style ="background: rgba(0, 0, 0, 0) url(<?php echo site;?>/uploads/anafoto.jpg?>) no-repeat scroll center center / cover";>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2>Registration</h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="index.php">ANA SAYFA</a></li>
										<li>Registration</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- HEADING-BANNER END -->
			<!-- SHOPPING-CART-AREA START -->
			<div class="login-area  pt-80 pb-80">
				<div class="container">
						<div class="row">

							<div class="col-lg-6">
								<form action="" method="POST" onsubmit="return false;" id="bgirisform">	
								<div class="customer-login text-left">
									<h4 class="title-1 title-border text-uppercase mb-30">BAYİ GİRİŞ</h4>
									
									<input type="text" placeholder="E-posta ya da bayi kodu" name="bec">
									<input type="password" placeholder="sifre giriniz"name ="bpass">
									
									<button type="submit" id="girisbuton" onclick="girisbutton();"  class="button-one submit-button mt-15">GİRİS YAP</button>
								</div>	
								</form>				
							</div>

							
					
							<div class="col-lg-6">

								<form action="" method="POST" onsubmit="return false;"id="bkayitform">	
									<div class="customer-login text-left">
										<h4 class="title-1 title-border text-uppercase mb-30">BAYİ KAYIT</h4>

										<input type="text" placeholder="Bayi adı" name="bname">
										<input type="text" placeholder="Bayi e-posta " name="bmail">
									
										<input type="password" placeholder="Bayi sifresi" name="bpass">
										<input type="password" placeholder="Bayi sifresi tekrar"name="bpass2">
										<input type="text" placeholder="Bayi telefon " name="bphone">
										<input type="text" placeholder="Bayi vergi no " name="bvno">
										<input type="text" placeholder="Bayi vergi dairesi" name="bvd">


										<button type="submit"id="kayitbuton" onclick="kayitbutton();"  class="button-one submit-button mt-15">KAYIT OL</button>
										
									</div>	
								</form>				
							</div>
							
						</div>
				
				</div>
			</div>
			<!-- SHOPPING-CART-AREA END -->
			<!-- FOOTER START -->
			<footer>
				<!-- Footer-area start -->
				<?php require_once 'inc/footer.php'; ?>	