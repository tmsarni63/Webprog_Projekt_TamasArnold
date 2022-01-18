<?php 
session_start();
?>
<html>
<head>
 
  <link rel="stylesheet" type="text/css" href="css/regisztracio.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

  <div class="header">
  	<h2>Regisztráció</h2>
  </div>
	
  <form id="form" method="get" action="regisztracio.php">
  	<div id="error"></div>
	<div class="input-mezo">
  	  <label>Név</label>
  	  <input type="text" name="nev" id="nev">
  	</div>
  	<div class="input-mezo">
  	  <label>Felhasznalonév</label>
  	  <input type="text"  id="felhasznalo_nev" >
  	</div>
  	<div class="input-mezo">
  	  <label>Email</label>
  	  <input type="email"  id="email" >
  	</div>
  	<div class="input-mezo">
  	  <label>Jelszó</label>
  	  <input type="password"  id="jelszo_1" autocomplete="on">
  	</div>
  	<div class="input-mezo">
  	  <label>Jelszó megismétlése</label>
  	  <input type="password"  id="jelszo_2" autocomplete="on">
  	</div>
  	<div class="input-mezo">
  	 <button type="button" class="btn" id="regisztralas" >Registráció<button>
  	</div>
  	<p>
  		Már regisztráltál? <a href="bejelentkezes.php">Bejelentkezés</a>
  	</p>
  </form>
  
  <script>  
  
  $(document).ready(function(){
	 $('#regisztralas').click(function(){
var email=$("#email").val(); 
var felhasznalo_nev=$("#felhasznalo_nev").val();
var nev=$("#nev").val();
var jelszo_1=$("#jelszo_1").val(); 
var jelszo_2=$("#jelszo_2").val(); 
if(email!=''&&felhasznalo_nev!=''&&nev!=''&&jelszo_1!=''&&jelszo_2!='')
{ $.ajax(
        {
        url: "api.php",
        type: "GET",
        data:{
			email:email,
			felhasznalo_nev:felhasznalo_nev,
			nev:nev,
			jelszo_1:jelszo_1,
			jelszo_2:jelszo_2,
			action:"regisztralas"
		},
		success:function(response){
			if(response=="A ket jelszo nem egyezik meg")
			{ 
                
            $('#error').html(response);

			}
			else if(response=="Ez a felhasznalo mar letezik"){
				$('#error').html(response);
			} 
			else if(response=="Ez az email cim mar letezik"){
				$('#error').html(response);
			} 
			else
			{window.location='bejelentkezes.php';}
		}
        });
}  
else{
	alert("Kerem toltse ki az osszes mezot!");
}
        
  });
 });
  </script>
  
</body>
</html>