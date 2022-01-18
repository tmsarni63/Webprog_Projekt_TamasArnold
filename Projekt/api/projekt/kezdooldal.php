<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/kezdooldal.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body>
<div class="fejlec">
<div class="container">
<div class=menu>
	  <ul>
		<li>
		<a href="kezdooldal.php">FŐOLDAL</a>
		</li>
		<li>
		<a href="esemenyek.php">ESEMÉNYEK</a>
		</li>
		<li>
		<a href="foglalas.php">FOGLALÁS</a>
		</li>
		<li>
		<a href="kereses.php">KERESÉS</a>
		</li>
	</div>
	<div class="br">
		<?php  if (isset($_SESSION['felhasznalo_nev'])) : ?>
    	<strong class="fnev"><?php echo $_SESSION['felhasznalo_nev']; ?></strong>
		<span>|</span>
		<strong><a href="kijelentkezes.php">Kijelentkezés</a></strong> 
		<?php endif ?>
		</div>   
	</div>
  </div>
<div class="tartalom">
<div class="header">
  	<h2>Foglalas lemondása</h2>
  </div>	
  <form method="GET" action="kezdooldal.php">
  	<div id="error"></div>
	<div class="input-mezop">
  	  <label>Lemondott esemény</label>
  	  <input type="text"  id="visszamondott" >
  	</div>
	 <button type="button" class="btn" name="lemondas" id="lemondas">Lemondok róla</button><br><br>
	 <button type="button" class="btn" name="kilistazas" id="elistazas">Foglalás megtekintése</button>
	</form>
	
<div id="esemeny">
</div>
<script>
  $(document).ready(function(){
	 $('#elistazas').click(function(){
		 
			 $.ajax({
				 url:"api.php",
				 type:"GET",
				 data:{action:"elistazas"
				 },
				 success:function(response)
				 {
					 if(response=="Nincsenek foglalásai!")
				 { $('#esemeny').html(response);
				 }
					 
					else
					{ $('#esemeny').html(response);
				 }
				}
			 });
		 
		 
	 }); 
  
  });
  
    $(document).ready(function(){
	 $('#lemondas').click(function(){
		 var visszamondott=$("#visszamondott").val(); 
		 if(visszamondott!=''){
			 $.ajax({
				 url:"api.php",
				 type:"GET",
				 data:{visszamondott:visszamondott,action:"lemondas"
				 },
				 success:function(response)
				 {
					 if(response=="Nincs ilyen foglalasa!")
				 { $('#error').html(response);
				 }
					 
					else
					{ $('#esemeny').html(response);
				 }
				}
			 });
		 }
		 else
		 {alert("Kerem toltson ki minden mezot!");}
		 
	 }); 
  
  });
  </script>
  
</div>


</body>
</html>