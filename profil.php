<?php require_once 'inc/header.php';
  if( @$_SESSION['login'] != @sha1(md5(IP2().$_SESSION['code'])) ){

	go(site);


  }
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"/>
<style>
.pagination{
	background: transparent!important;
	display: flex,!important;

}

</style>


<!-- profil -->
		<div class="wrapper bg-dark-white">

			<!-- HEADER-AREA START -->
			<?php require_once 'inc/menu.php';?>
			<!-- HEADER-AREA END -->
			<!-- Mobile-menu start -->
			<?php require_once 'inc/mobilmenu.php';?>
			<!-- Mobile-menu end -->
			<!-- HEADING-BANNER START -->
			<div class="heading-banner-area overlay-bg" style ="background: rgba(0, 0, 0, 0) url(<?php echo site;?>/uploads/anafoto.jpg?>) no-repeat scroll center center / cover";>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-banner">
								<div class="heading-banner-title">
									<h2> Bayi Profil</h2>
								</div>
								<div class="breadcumbs pb-15">
									<ul>
										<li><a href="#">Ana Sayfa/a></li>
										<li>bayi profil</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- HEADING-BANNER END -->
			<!-- PRODUCT-AREA START -->
			<div class="product-area pt-80 pb-80 product-style-2" >
				<div class="container">
					<div class="row">
						<div class="col-lg-3 order-2 order-lg-1">
						
							<!-- Widget-Categories start -->
							<aside class="widget widget-categories  mb-30">
								<div class="widget-title">
									<h4>Menü</h4>
								</div>
								<div id="cat-treeview"  class="widget-info product-cat boxscrol2">
									<ul>
										<li><a href="<?php echo site."/profil.php?process=profile";?>"><span>Profil bilgileri</span></a> </li> 
										<li><a href="<?php echo site."/profil.php?process=changepassword";?>"><span>şifremi değistir</span></a> </li>  	
											
										<li><a href="<?php echo site."/profil.php?process=order";?>"><span>Siparişlerim</span></a> </li>  	
										<li><a href="<?php echo site."/profil.php?process=address";?>"><span>Adreslerim</span></a> </li>
										<!--<li><a href="<?php echo site."/profil.php?process=havale";?>"><span>Banka işlem</span></a> </li>    -->
										<li><a href="<?php echo site."/cart.php";?>"><span>Sepetim</span></a> </li> 
										<li><a href="<?php echo site."/logout.php";?>"><span>Çıkış</span></a> </li>  	 		

									</ul>
								</div>
							</aside>
							<!-- Widget-categories end -->
						
						
					
							<!-- Widget-banner start  silinecek -->
							<aside class="widget widget-banner hidden-sm">
								
							</aside>
							<!-- Widget-banner end -->
						</div>
						<div class="col-lg-9 order-1 order-lg-2">
							<!-- Shop-Content End -->
							

							<?php
							$process=get('process');
							
							switch($process){

								case 'order':
									$orders =$db->prepare("SELECT * FROM siparsler INNER JOIN durumkodlari ON durumkodlari.durumkodu = siparsler.siparisdurum WHERE siparisbayi=:b");
									$orders->execute([':b' =>$bcode]);
									?>

									<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
									<div class="product-option mb-30 clearfix">
									<!-- Nav tabs -->
									<ul class="nav d-block shop-tab">
										<li>Siparişlerim(<?php echo $orders->rowcount(); ?>)</li>
									

										
										
										<?php


									

										if($orders->rowcount()){


										?>

												<table class ="table table-hover " id="b2btable">
													<thead>
														<tr>
														<th>KOD</th>
														<th>DURUM</th>
														<th>TUTAR</th>
														<th>ODEME TÜRÜ </th>
														<th>TARİH</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															foreach($orders as $order){?>
															<tr>
																<td><a href="" title="Sipariş detayı"><?php echo $order['sipariskodu'];?></td>
																<td><?php echo $order['durumbaslik'];?></td>
																<td><?php echo $order['siparistutar'];?>₺</td>
																
																<td><?php echo $order['siparisturu']==1 ?'havale' : 'kredi kartı';?></td>
																<td><?php echo dt($order['siparistarih'])." | ".$order['siparissaat'];?></td>
															</tr>

														<?php
															}
														?>
													</tbody>


										</table>
											<?php
										}else{
											alert('Siparişiniz Bulunmamaktadır...','danger');
										}

												?>

										
									</ul>
									
								</div>
							
									
									</div>
								</div>
								</div>
										<?php
									break;
									case 'newaddress':
										?>

							<form action="" method="POST" onsubmit="return false;" id="newaddressform">	
								<div class="customer-login text-left">
									<h4 class="title-1 title-border text-uppercase mb-30">YENİ ADRES EKLE</h4>
									
									<input type="text"placeholder="Adres başlık" name="title">
									<input type="text" placeholder="Adres Tarif"name ="content">
								
	
									<button type="submit" id="newaddres" onclick="newaddress();"  class="button-one submit-button mt-15">Adresi Ekle</button>
								</div>	
								</form>	



										<?php
										break;
									case 'addressedite':

										
											$id=get('id');
											if(!$id){
												go(site);
											}
											$query =$db->prepare("SELECT * FROM bayi_adresler WHERE adresbayi=:b AND id=:id");
											$query->execute([':b'=>$bcode,':id' =>$id]);
											
											if($query->rowcount()){

												$row=$query->fetch(PDO::FETCH_OBJ);
											
												?>


							<form action="" method="POST" onsubmit="return false;" id="addressform">	
								<div class="customer-login text-left">
									<h4 class="title-1 title-border text-uppercase mb-30"><?php echo $row->adresbaslik; ?>| ADRES DÜZENLE</h4>
									
									<input type="text"value="<?php echo $row->adresbaslik;?>" placeholder="Adres başlık" name="title">
									<input type="text"value="<?php echo $row->adrestarif;?>" placeholder="Adres Tarif"name ="content">
									<select name="status">
												<option value="1"<?php echo $row->adresdurum==1?'selected': null;?>>AKTİF</option>
												<option value="2"<?php echo $row->adresdurum==2?'selected': null;?>>PASİF</option>

									</select>
									<input type="hidden" value="<?php echo $row->id;?>"name="addressid"/>
									<button type="submit" id="addressbuton" onclick="addressbutton();"  class="button-one submit-button mt-15">Adresi Güncelle</button>
								</div>	
								</form>	


										<?php

											}else{
												go(site);
											}

										break;
									case 'addressdelete':
										$id=get('id');
										if(!$id){
											go(site);
										}
										$query =$db->prepare("SELECT * FROM bayi_adresler WHERE adresbayi=:b AND id=:id");
										$query->execute([':b'=>$bcode,':id' =>$id]);
										if($query->rowcount()){
											
											$delete=$db->prepare("UPDATE bayi_adresler SET adresdurum=:d WHERE adresbayi=:b AND id=:id");
											$delete->execute([':d'=>2,':b'=>$bcode,':id' =>$id]);
											if($delete){
												//header('refresh:2;url=profile.php?process=address'); çalişmiyor bak
												alert("Adresiniz Başarılı Şekilde Pasif Edildi","success");
												//go(site."/profile.php?process=address",2); çalişmiyor bak
											}
											else{
												alert("Bir Hata Oluştu","danger");
											}
										}	





										break;
									case 'address':

										$address =$db->prepare("SELECT * FROM bayi_adresler WHERE adresbayi=:b ");
										$address->execute([':b' =>$bcode]);
										?>
	
										<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
										<div class="product-option mb-30 clearfix">
										<!-- Nav tabs -->
										<ul class="nav d-block shop-tab">
											<li>Adreslerim(<?php echo $address->rowcount(); ?>)</li>
											<li><a href="<?php echo site;?>profil.php?process=newaddress">[Yeni Adres Ekle]</a></li>
	
											
											
											<?php
	
	
										
	
											if($address->rowcount()){
	
	
											?>
	
													<table class ="table table-hover " id="b2btable">
														<thead>
															<tr>
															<th>ID</th>
															<th>BAŞLIK</th>
															<th>AÇIK ADRES</th>
															<th>DURUM</th>
															<th>İŞLEM</th>
															</tr>
														</thead>
														
														<tbody>
															<?php
																foreach($address as $order){?>
																<tr>
																	<td>#<?php echo $order['id'];?></td>
																	<td><?php echo $order['adresbaslik'];?></td>
																	<td><?php echo $order['adrestarif'];?></td>
																	
																	<td><?php echo $order['adresdurum']==1 ?'Aktif' : 'Aktif degil';?></td>
																	<td><a href="<?php echo site ;?>/profil.php?process=addressedite&id=<?php echo $order['id'];?>"title="Adres değiştir"><i class="zmdi zmdi-edit"></i></a></td>
																	<td><a href="<?php echo site ;?>/profil.php?process=addressdelete&id=<?php echo $order['id'];?>"title="Adres pasif yap"><i class="zmdi zmdi-close"></i></a></td>
																</tr>
	
															<?php
																}
															?>
														</tbody>
	
	
													</table>
												<?php
											}else{
												alert('Adres bulunmamaktadır...','danger');
											}
	
													?>
	
											
										</ul>
										
									</div>
								
										
										</div>
									</div>
									</div>
											<?php
										break;

											case 'order':
									$orders =$db->prepare("SELECT * FROM siparsler INNER JOIN durumkodlari ON durumkodlari.durumkodu = siparsler.siparisdurum WHERE siparisbayi=:b");
									$orders->execute([':b' =>$bcode]);
									?>

									<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
									<div class="product-option mb-30 clearfix">
									<!-- Nav tabs -->
									<ul class="nav d-block shop-tab">
										<li>Siparişlerim(<?php echo $orders->rowcount(); ?>)</li>
									

										
										
										<?php


									

										if($orders->rowcount()){


										?>

												<table class ="table table-hover " id="b2btable">
													<thead>
														<tr>
														<th>KOD</th>
														<th>DURUM</th>
														<th>TUTAR</th>
														<th>ODEME TÜRÜ </th>
														<th>TARİH</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															foreach($orders as $order){?>
															<tr>
																<td><a href="" title="Sipariş detayı"><?php echo $order['sipariskodu'];?></td>
																<td><?php echo $order['durumbaslik'];?></td>
																<td><?php echo $order['siparistutar'];?>₺</td>
																
																<td><?php echo $order['siparisturu']==1 ?'havale' : 'kredi kartı';?></td>
																<td><?php echo dt($order['siparistarih'])." | ".$order['siparissaat'];?></td>
															</tr>

														<?php
															}
														?>
													</tbody>


										</table>
											<?php
										}else{
											alert('Siparişiniz Bulunmamaktadır...','danger');
										}

												?>

										
									</ul>
									
								</div>
							
									
									</div>
								</div>
								</div>
										<?php
									break;
								
							
									case 'newhavale':
										
										?>
										
										
									  <form action="" method="POST" onsubmit="return false;" id="newnotificationform">	
        <div class="customer-login text-left">
            <h4 class="title-1 title-border text-uppercase mb-30">YENİ HAVALE BİLDİRİM</h4>
            
            <select name="hbank">
                <option value="0" redonly>Havale yaptığınız bankayı seçiniz</option>
                <?php 

				
                    $banks = $db->prepare("SELECT * FROM bankalar WHERE bankadurum=:d");

                    $banks->execute([':d' => 1]);
                    if($banks->rowCount()){
                        foreach($banks as $bank){
                            echo '<option value="'.$bank['id'].'">'.$bank['bankadi'].'</option>';
                        }
                    }


                ?>
            </select>

            <input type="date" placeholder="Havale tarihi" name="hdate">
            <input type="text" placeholder="Havale saati" name="hhour">
            <input type="text" placeholder="Havale tutarı" name="hprice">
            <textarea name="hdesc" rows="10" placeholder="Havale açıklaması"></textarea>
	
									<button type="submit" id="newaddres" onclick="newaddress();"  class="button-one submit-button mt-15">Havale Bildirimi Ekle</button>
								</div>	
								</form>	


							
										<?php
											break;
									case 'havale':
										$havale =$db->prepare("SELECT * FROM havalebildirim INNER JOIN bankalar ON bankalar.id = havalebildirim.banka   WHERE havalebayi=:b");
										$havale->execute([':b' =>$bcode]);
										?>
	
										<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
										<div class="product-option mb-30 clearfix">
										<!-- Nav tabs -->
										<ul class="nav d-block shop-tab">
											<li>Havale Bildirimlerim(<?php echo $havale->rowcount(); ?>)</li>
											<li><a href ="<?php echo site; ?>profil.php?process=newhavale">[Yeni Bildirim Ekleyin]</a></li>
	
											
											
											<?php
	
	
										
	
											if($havale->rowcount()){
	
	
											?>
	
													<table class ="table table-hover " id="b2btable">
														<thead>
															<tr>
															
															<th>TARİH</th>
															<th>TUTAR</th>
															<th>BANKA ADI </th>
															<th>NOT</th>
															</tr>
														</thead>
														
														<tbody>
															<?php
																foreach($havale as $order){?>
																<tr>

																	<td><?php echo dt($order['havaletarih']). "|".$order['havalesaat'];?></td>
																	<td><?php echo $order['havaletutar'];?>₺</td>
																	<td><?php echo $order['bankadi'];?></td>
																	<td><?php echo $order['havalenot'];?></td>
																	
																</tr>
	
															<?php
																}
															?>
														</tbody>
	
	
											</table>
												<?php
											}else{
												alert('Siparişiniz Bulunmamaktadır...','danger');
											}
	
													?>
	
											
										</ul>
										
									</div>
								
										
										</div>
									</div>
									</div>
											<?php
										break;


								case 'profil':
								?>
								<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
								<div class="product-option mb-30 clearfix">
									<!-- Nav tabs -->
									<ul class="nav d-block shop-tab">
										<li>Profil Bilgileri</li>
										
									</ul>
									
								</div>
								<!-- Tab panes -->
								<div class="login-area  ">
								<div class="container">
									<div class="row">
										
									<form action="" method="POST">	
								<div class="customer-login ">
								
									
									<input type="text" placeholder="E-posta giriniz" name="bec">
									<input type="password" placeholder="sifre giriniz">
									
									<button type="submit"   class="button-one submit-button mt-15">Profili Güncelle</button>
								</div>	
								</form>	
								
									</div>
								</div>
								</div>
								<?php
								break;
									case 'profile';
								
									?>
									<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
									<div class="product-option mb-30 clearfix">
										<!-- Nav tabs -->
										<ul class="nav d-block shop-tab">
											<li>Profil Bilgileri</li>
											
										</ul>
										
									</div>
									<!-- Tab panes -->
									<div class="login-area  ">
									<div class="container">
										<div class="row">
											
										<form action="" method="POST" onsubmit="return false;" id="profileform">	
									<div class="customer-login ">
									
										<label>Bayi kodu:</label>
										<input type="text" disabled value="<?php echo $bcode;?>" name="bec">
										

										
										<label>Bayi adı:</label>
										<input type="text" value="<?php echo $bname;?>" name="bname" placeholder="bayiadı">
										

										<label>Bayi mail:</label>
										<input type="text" value="<?php echo $bmail;?>" name="bmail" placeholder="bayimail">
										
									
										
										<label>Bayi telefon:</label>
										<input type="text" value="<?php echo $bphone;?>" name="bphone" placeholder="bayi telefon">

										<label>Bayi fax:</label>
										<input type="text" value="<?php echo $bfax;?>" name="bfax" placeholder="bayi fax">

										<label>Bayi vergino:</label>
										<input type="text" value="<?php echo $bvno;?>" name="bvno" placeholder="bayi vergi no">

										<label>Bayi vergi daire:</label>
										<input type="text" value="<?php echo $bvd;?>" name="bvd" placeholder="bayi vergi dairesi">


										<label>Bayi web:</label>
										<input type="text" value="<?php echo $bweb;?>" name="bweb" placeholder="bayi web sitesi">


										<button type="submit"  onclick="profilebutton();" id="profilebuton" class="button-one submit-button mt-15">Profili Güncelle</button>
									
									
									
									
									</div>	
									</form>	
									
										</div>
									</div>
									</div>
									<?php
									break;
									



								
									default:
										?>
										<div class="shop-content mt-tab-30 mb-30 mb-lg-0">
										<div class="product-option mb-30 clearfix">
											<!-- Nav tabs -->
											<ul class="nav d-block shop-tab">
												<li>Şifremi Değiştir </li>
												
											</ul>
											
										</div>
										<!-- Tab panes -->
										<div class="login-area  ">
										<div class="container">
											<div class="row">
												
											<form action="" method="POST" onsubmit="return false;" id="passwordform">	
										<div class="customer-login ">
										
											<label>Yeni Şifrenizi Giriniz  :</label>
											<input type="password"  name="password" placeholder="şifreninizi giriniz">
											
	
											
											<label>Yeni Şifrenizi Tekrar Giriniz:</label>
											<input type="password"  name="password2" placeholder="tekrar giriniz">
	
	
											<button type="submit"  onclick="passwordbutton();" id="passwordbuton" class="button-one submit-button mt-15">Şifremi Güncelle</button>
										
										
										
										
										</div>	
										</form>	
										
											</div>
										</div>
										</div>
										<?php
										break;
	
	









									


							}
								?>



						</div>
					</div>
				</div>
			</div>
			<!-- PRODUCT-AREA END -->
<?php require_once 'inc/footer.php';?>
<!--
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#b2btable').DataTable();
});
</script>
-->