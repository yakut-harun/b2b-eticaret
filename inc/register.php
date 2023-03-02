<?php

require_once '../system/function.php';

if( @$_SESSION['login'] == @sha1(md5(IP().$bcode)) ){
    go(site);
}


if($_POST){

    $bname = post('bname');
    
    $bmail = post('bmail');
    $bpass = post('bpass');
    $bpass2 = post('bpass2');
    $bphone = post('bphone');
    $bvno = post('bvno');
    $bvd = post('bvd');

    $bcode = uniqid();
    $crypto =sha1(md5($bpass));



if(!$bname || !$bmail || !$bpass || !$bpass2 || !$bphone || !$bvno || !$bvd){
    echo 'empty';


}else{
    if(!filter_var($bmail,FILTER_VALIDATE_EMAIL)){
        echo 'format';

    }else{
        if($bpass != $bpass2){
            echo 'match';
        
        } if(strlen($bpass)<3){
            echo 'uzun';
        }
        else{
            $already = $db->prepare("SELECT bayiemail FROM bayiler WHERE bayiemail=:b");
            $already->execute([':b'=>$bmail]);
            if($already->rowCount()){
                echo 'already';

            }else{
                $result = $db->prepare("INSERT INTO bayiler SET 
                bayikodu =:bcode, 
                bayiadi =:bname,
                bayiemail =:bmail,
                bayisifre =:bpass,
                bayitelefon =:bphone,
                bayivergino =:bvno,
                bayivergidairesi =:bvd");

                $result->execute([
                    ':bcode'=> $bcode,
                    ':bname'=> $bname,
                    ':bmail'=> $bmail,
                    ':bpass'=> $crypto,
                    ':bphone'=> $bphone,
                    ':bvno'=> $bvno,
                    ':bvd'=> $bvd
                ]);
                 
                if($result->rowCount()){
                    echo 'ok';
                }else{
                    echo 'error';
                }
            }
        }
    }}
}

?>