<div class="col-lg-3 order-2 order-lg-1">
							<!-- side bar -->
							<aside class="widget widget-search mb-30">
								<form action="#">
									<input type="text" placeholder="Ürün Arama..." />
									<button type="submit">
										<i class="zmdi zmdi-search"></i>
									</button>
								</form>
							</aside>
							<!-- Widget-search end -->
							<!-- Widget-Categories start -->
							<aside class="widget widget-categories  mb-30">
								<div class="widget-title">
									<h4>katagoriler</h4>
								</div>
								<div id="cat-treeview"  class="widget-info product-cat boxscrol2">
									<ul>
										<li>
                                            <?php
                                            $cat =$db->prepare("SELECT * FROM urun_katagoriler WHERE katdurum=:d");
                                            $cat->execute([':d'=> 1]);
                                            if($cat->rowcount()){
                                                foreach($cat as $ca){
                                                    echo'<li><a href="catagory.php?catsef='.$ca['katsef'].'"><span>'.$ca['katbaslik'].'</span></a></li>';
                                                }
                                            }
											?>
										</li>          
									
									</ul>
								</div>
							</aside>
							<!-- Widget-categories end -->
							<!-- Shop-Filter start -->
							
							<!-- Shop-Filter end -->
							
							
							<!-- Widget-banner end -->
						</div>