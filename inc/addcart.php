<?php

require_once '../system/function.php';

if($_POST){
    $qty       = post('qty');
    $pcode     = post('pcode');

    if( @$_SESSION['login'] == @sha1(md5(IP().$bcode)) ){

            if(!$qty || !$pcode){
                echo 'empty';
            }else{
                if($qty<1){
                    echo 'qty';
                }else{

                    $prow =$db->prepare("SELECT urunkodu,urunfiyat,urundurum FROM urunler WHERE urunkodu=:k");
                    $prow->execute([':k'=>$pcode]);
                    $productrow =$prow->fetch(PDO::FETCH_OBJ);

                    //sepetin toplam maliyet = adet* ürün + kdv
                    
                    $totalprice = $productrow->urunfiyat * $qty;
                    $tax = $totalprice * $arow->sitekdv/100;
                    $subtotal =$totalprice + $tax ;


                  $currrentcart = $db->prepare("SELECT sepeturun,sepetbayi,sepetadet FROM sepet WHERE sepeturun=:u AND sepetbayi=:b");
                    $currrentcart->execute([':u' => $productrow->urunkodu,':b'=>$bcode]);
                    if($currrentcart->rowCount()){

                        $currrentcart = $currrentcart->fetch(PDO::FETCH_OBJ);
                        $currentqty =$currrentcart->sepetadet + $qty;

                        
                        $totalprice = $productrow->urunfiyat * $currentqty;
                        $tax = $totalprice * $arow->sitekdv/100;
                        $subtotal =$totalprice + $tax ;

                        $result = $db->prepare("UPDATE sepet SET
                       
                        sepetadet  =:a,
                        birimfiyat =:bi,
                        toplamfiyat=:tf,
                        kdv        =:ka WHERE sepeturun=:u AND sepetbayi=:b
                    ");

                    $result->execute([

                        ':a'   => $currentqty,
                        ':bi'  => $productrow->urunfiyat,
                        ':tf'  => $subtotal,
                        ':ka'  => $arow->sitekdv,
                        ':u'   => $productrow->urunkodu,
                        ':b'   => $bcode
                    ]);
                   
                 

                   if($result->rowcount()){
                       echo 'ok';
                   }else{
                       echo 'error';
                   }
               



                    }else{
                        $result = $db->prepare("INSERT INTO sepet SET 
                        sepetbayi  =:b,
                       sepeturun  =:u,
                       sepetadet  =:a,
                       birimfiyat =:bi,
                       toplamfiyat=:tf,
                       sepettarih =:ta,
                       sepetsilinme =:si,
                       kdv        =:ka                   
                   ");

                   $result->execute([  ':b'   => $bcode,
                   ':u'   => $productrow->urunkodu,
                   ':a'   => $qty,
                   ':bi'  => $productrow->urunfiyat,
                   ':tf'  => $subtotal,
                   ':ta'  => date('Y-m-d'),
                   ':si'  => date('Y-m-d', strtotime( date('Y-m-d') . " +7 days")),
                   ':ka'  => $arow->sitekdv
               ]);
                       
                   
                 

                   if($result->rowcount()){
                       echo 'ok';
                   }else{
                       echo 'error';
                   }
               


                    }
                    


                }
            }
            
    }
   
    else{
        echo 'login';
    }

   
   
}







?>