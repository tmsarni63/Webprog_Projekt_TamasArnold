<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/regisztracio.css">  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
  <div class="header">
  	<h2>Bejelentkezés</h2>
  </div>
	 
  <form method="GET" action="bejelentkezes.php">
  	<div id="error"></div>
  	<div class="input-mezo">
  		<label>Felhasznalonev</label>
  		<input type="text"  id="felhasznalo_nev" >
  	</div>
  	<div class="input-mezo">
  		<label>Jelszo</label>
  		<input type="password" id="jelszo" autocomplete="on">
  	</div>
  	<div class="input-mezo">
  		<button type="button" class="btn" id="bejelentkezes">Bejelentkezés</button>
  	</div>
  	<p>
  		Meg nem regisztralt? <a href="regisztracio.php">Regisztracio</a>
  	</p>
  </form>
 
</body>
</html>
 <script>
  $(document).ready(function(){
	 $('#bejelentkezes').click(function(){
		 var felhasznalo_nev=$('#felhasznalo_nev').val();
		 var jelszo=$('#jelszo').val();
		 if(felhasznalo_nev!=''&&jelszo!='')
		 {
			 $.ajax({
				 url:"api.php",
				 type:"GET",
				 data:{action:"bejelentkezes", felhasznalo_nev:felhasznalo_nev, jelszo:jelszo
				 },
				 success:function(response)
				 {
					 if(response=="Rossz jelszo vagy felhasznalonev!")
				 { $('#error').html(response);
				 }
					 
					else
					{window.location='kezdooldal.php';
					}
				}
			 });
		 }
		 else{
			 alert("Toltson ki minden mezot!");
		 }
		 
	 }); 
  
  });
  </script>