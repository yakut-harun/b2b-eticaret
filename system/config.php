

<?php 




session_start();

date_default_timezone_set('Europe/Istanbul');
$server = "localhost";
$user = "root";
$pass = "";
$database = "b2b";
$db = "mysql:host=$server;port=3307;dbname=$database;charset=UTF8";
try {
    
    $db = new PDO($db, $user, $pass);
    
} catch (PDORxception $e) {
    print_r($e->getMessage());
    
}


$query = $db->prepare("SELECT * from ayarlar LIMIT :lim ");
$query->bindValue(':lim',(int)1,PDO::PARAM_INT);
$query->execute();
if($query->rowCount()){
    $arow    =$query->fetch(PDO::FETCH_OBJ);
    $site   =$arow->siteurl;



    #sabitler 
    define('site',$site);
    define('baslik',$arow->sitebaslik);
    }
    
    ## giriş 
        
function IP2(){

    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

    if( @$_SESSION['login'] == @sha1(md5(IP2().$_SESSION['code'])) ){
        
   
    $logincontrol = $db->prepare("SELECT * FROM bayiler WHERE id=:id AND bayikodu=:k");
    $logincontrol->execute([':id' => @$_SESSION['id'],':k'=> @$_SESSION['code']]);
    if($logincontrol->rowCount()){
        $par = $logincontrol->fetch(PDO::FETCH_OBJ);
        if($par->bayidurum==2){
            $bid   = $par->id;
            $blogo = $par->bayilogo;
            $bcode = $par->bayikodu;
            $bmail = $par->bayiemail;
            $bname = $par->bayiadi;
            $bgift = $par->bayiindirim;
            $bphone= $par->bayitelefon;
            $bfax  = $par->bayifax;
            $bvno  = $par->bayivergino;
            $bvd   = $par->bayivergidairesi;
            $bweb  = $par->bayisite;
            $bstatus = $par->bayidurum;
    
        }
        else {
            @session_destroy();

        }
    }
    else {
        @session_destroy(); 
    }

}
?>

