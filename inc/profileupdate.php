<?php

require_once '../system/function.php';

if( @$_SESSION['login'] != @sha1(md5(IP().$bcode)) ){
    go(site);
}


if($_POST){

    $bname = post('bname');
    
    $bmail = post('bmail');
    $bfax = post('bfax');
    $bmail = post('bmail');
    $bweb = post('bweb');
    $bphone = post('bphone');
    $bvno = post('bvno');
    $bvd = post('bvd');

  


if(!$bname || !$bmail || !$bphone || !$bvno || !$bvd){
    echo 'empty';


}else{
    if(!filter_var($bmail,FILTER_VALIDATE_EMAIL)){
        echo 'format';

    }
        else{
            $already = $db->prepare("SELECT bayikodu, bayiemail FROM bayiler WHERE bayiemail=:b AND bayikodu!=bayikodu");
            $already->execute([':b'=>$bmail,]);
            if($already->rowCount()){
                echo 'already';

            }else{
                $result = $db->prepare("UPDATE bayiler SET 
              
                bayiadi =:bname,
                bayiemail =:bmail,
                bayifax =:bfax,
                bayisite =:bweb,
                bayitelefon =:bphone,
                bayivergino =:bvno,
                bayivergidairesi =:bvd WHERE bayikodu =:kod AND id=:id");

                $result->execute([
                    
                    ':bname'=> $bname,
                    ':bmail'=> $bmail,
                    ':bfax'=> $bfax,
                    ':bweb'=> $bweb,
                    ':bphone'=> $bphone,
                    ':bvno'=> $bvno,
                    ':bvd'=> $bvd,
                    ':kod' => $bcode,
                    ':id'=> $bid,
                ]);

                if($result){
                    echo 'ok';
                }else{
                    echo 'error';
                }
            }
        
    }}
}

?>