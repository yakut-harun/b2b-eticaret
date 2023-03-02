<?php 

require_once '../system/function.php';

if( @$_SESSION['login'] != @sha1(md5(IP().$bcode)) ){
    go(site);
}

if($_POST){

    $name     = post('name');
    $phone    = post('phone');
    $note     = post('note');
    $address  = post('address');
    $payment  = post('payment');
    $code     = uniqid();

    if(!$name || !$phone || !$address || !$payment){
        echo 'empty';
    }else{

        $carttotal    = $db->prepare("SELECT SUM(toplamfiyat) as toplam FROM sepet WHERE sepetbayi=:b");
        $carttotal->execute([':b' => $bcode]);
        $carttotalrow = $carttotal->fetch(PDO::FETCH_OBJ); 


        $result = $db->prepare("INSERT INTO siparsler SET
            siparisbayi     =:b,
            siparisisim     =:i,
            siparistel      =:t,
            siparistarih    =:ta,
            siparissaat     =:sa,
            siparisnot      =:note,
            siparistutar    =:sip,
            sipariskodu     =:code,
            siparisadres    =:ad
        ");

        $result->execute([
            ':b'    => $bcode,
            ':i'    => $name,
            ':t'    => $phone,
            ':ta'   => date('Y-m-d'),
            ':sa'   => date('H:i'),
            ':note' => $note,
            ':sip'  => $carttotalrow->toplam,
            
            ':code' => $code,
            ':ad'   => $address
        ]);

        if($result->rowCount()){


            $cart = $db->prepare("SELECT * FROM sepet 
            INNER JOIN urunler ON urunler.urunkodu = sepet.sepeturun
            WHERE sepetbayi=:b");
            $cart->execute([':b' => $bcode]);
            if($cart->rowCount()){
                foreach($cart as $ca){

                    $orderproducts = $db->prepare("INSERT INTO siparis_urunler SET

                        sipkodu    =:s,
                        sipurun    =:u,
                        sipbirim   =:b,
                        sipadet    =:a,
                        siptoplam  =:t,
                        sipurunadi =:ua
                    
                    ");

                    $orderproducts->execute([
                        ':s'   => $code,
                        ':u'   => $ca['sepeturun'],
                        ':b'   => $ca['birimfiyat'],
                        ':a'   => $ca['sepetadet'],
                        ':t'   => $ca['toplamfiyat'],
                        ':ua'  => $ca['urunbaslik']
                    ]);

                   
                }

                
               
            }


           

            

            


            $deletecart = $db->prepare("DELETE FROM sepet WHERE sepetbayi=:b");
            $deletecart->execute([':b' => $bcode]);
            echo 'ok';


        }else{
            echo 'error';
            //print_r($result->errorInfo());
        }

    }

}

?>