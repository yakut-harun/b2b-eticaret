var url = "http://localhost/b2b/";

function kayitbutton(){


    var data = $("#bkayitform").serialize();

    $.ajax({
    
        type : "POST",
        url : url + "inc/register.php",
        data : data,
        success : function(result){
            
            if($.trim(result) == "empty"){
                alert("Lütfen boş alan bırakmayınız");
                

            }else if($.trim(result) == "format"){
                alert("E-posta formatı hatalı");
                

            }else if($.trim(result) == "match"){
                alert("Lütfen şifreleri aynı giriniz..!");
               

            }else if ($.trim(result) == "already"){
                alert("bu e-posta adresini başka bayi tarafından  kullanmaktadır...");

            }else if($.trim(result) == "error"){
                alert("bir hata ile oluştu...");

            }else if($.trim(result) == "ok"){
                alert("Üyeliğiniz başarıyla oluştuldu...");
                window.location.href = url;
            }else if($.trim(result) == "uzun"){
                alert("şifere 3 karakterden kısa olamaz");
                window.location.href = url;
            }
          
        }
    });
    
}

function girisbutton() {

    var data = $("#bgirisform").serialize();

   $.ajax({

    type : "POST",
    url : url+ "inc/login.php",
    data : data,

    success : function(result){
        if($.trim(result) == "empty"){
            alert("Lütfen boş alan birakmayiniz");


        }else if($.trim(result) == "error"){
            alert('E-posta veya şifre yanlış');


        }else if($.trim(result) == "ok"){
            alert('Başarıyla giriş yaptınız, yönlendiriliyorsunuz...');
            window.location.href = url + "profil.php";
        }
    }
    })}
    
       




    



function profilebutton(){


    var data = $("#profileform").serialize();

    $.ajax({
    
        type : "POST",
        url : url + "inc/profileupdate.php",
        data : data,
        success : function(result){
            
            if($.trim(result) == "empty"){
                alert("Lütfen boş alan bırakmayınız !");
                

            }else if($.trim(result) == "format"){
                alert("E-posta formatı hatalı");
                

            }else if ($.trim(result) == "already"){
                alert("bu e-posta adresini başka bayi tarafından  kullanmaktadır...");

            }else if($.trim(result) == "error"){
                alert("Bir hata ile oluştu...");

            }else if($.trim(result) == "ok"){
                alert("Profiliniz başarıyla güncellendi...");
                window.location.href=url + "profil.php";
            }
          
        }
    });
    
}

function passwordbutton(){


    var data = $("#passwordform").serialize();

    $.ajax({
    
        type : "POST",
        url : url + "inc/changepassword.php",
        data : data,
        success : function(result){
            
            if($.trim(result) == "empty"){
                alert("Lütfen Boş Alan Brakmayınız!");
                

            }else if($.trim(result) == "match"){
                alert("Lütfen Şifreleri Aynı Giriniz..!");
               

            }else if($.trim(result) == "error"){
                alert("Bir Hata İle Oluştu...");

            }else if($.trim(result) == "ok"){
                alert("Şifreniz Başarıyla Güncellendi");
                window.location.href = url+"profil.php?process=profile";
            }
          
        }
    });
    
}
function addressbutton(){


    var data = $("#addressform").serialize();

    $.ajax({
    
        type : "POST",
        url : url + "inc/addressupdate.php",
        data : data,
        success : function(result){
            
            if($.trim(result) == "empty"){
                alert("Lütfen Boş Alan Brakmayınız!");
                

            }else if($.trim(result) == "error"){
                alert("Bir Hata İle Oluştu...");

            }else if($.trim(result) == "ok"){
                alert("Adresiniz Başarıyla Güncellendi");
                window.location.href = url+"profil.php?process=address";
            }
          
        }
    });
    
}


function newaddress(){


    var data = $("#newaddressform").serialize();

    $.ajax({
    
        type : "POST",
        url : url + "inc/newaddress.php",
        data : data,
        success : function(result){
            
            if($.trim(result) == "empty"){
                alert("Lütfen Boş Alan Brakmayınız!");
                

            }else if($.trim(result) == "error"){
                alert("Bir Hata İle Oluştu...");

            }else if($.trim(result) == "ok"){
                alert("Adresiniz Başarıyla Eklendi");
                window.location.href = reload();
            }
          
        }
    });
    
}

function addcart(){

    var data =$("#addcartform").serialize();
    $.ajax({

        type:"post",
        url:url+"inc/addcart.php",
        data:data,
        success : function(result){

            if($.trim(result)=="login"){
                alert("Sepete eklemek için lütfen giriş yapınız");
            
            }else if($.trim(result)=="empty"){
                alert("Ürün adeti belirtiniz");
            }else if($.trim(result)=="qty"){
                alert("En az 1 adet seçmelisiniz");
            }else if($.trim(result)=="error"){
                alert("Hata oluştu");
            }else if($.trim(result)=="ok"){
                alert("Ürün sepete eklendi");
                 window.location.reload();
            }   

        }


    });



}
function ordercompleted(){
    // alert("asdas");
    
     
 
 
     var data = $("#orderformz").serialize();
     $.ajax({
         type : "POST",
         url  : url + "/inc/neworder.php",
         data : data,
         success : function(result){
 
             if($.trim(result) == "empty"){
                 alert("Lütfen boş alan bırakmayınız");
          
 
             }else if($.trim(result) == "error"){
                 
                 alert("Bir hata oluştu...");
          
 
 
             }else if($.trim(result) == "ok"){
                 alert("Siparişiniz için teşekkür ederiz...");
                 window.location.href ="profil.php?process=order";
             }
 
         }
     });
 
 }





