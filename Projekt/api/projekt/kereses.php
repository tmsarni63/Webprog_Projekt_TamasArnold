<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/kereses.css">
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
</div>
<div class="tartalom">
 
<div class="header">
  	<h2>Esemény keresése</h2>
  </div>	
  <form method="GET" action="kereses.php">
  	<div id="error"></div>
	<div class="input-mezo">
  	  <label>Esemény tipusa</label>
  	  <select id="esemenytipus" >
  <option value="Esküvő">Esküvő</option>
  <option value="Cégesrendezvény">Cégesrendezvény</option>
  <option value="Születésnap">Születésnap</option>
  <option value="Évforduló">Évforduló</option>
</select>
  	</div>
  	<div class="input-mezo">
  	  <label>Helyszin</label>
<select id="helyszin" >
<option value="Csikszereda">Csikszereda</option>
  <option value="Székelyudvarhely">Székelyudvarhely</option>
  <option value="Sepsiszentgyörgy">Sepsiszentgyörgy</option>
  <option value="Marosvásárhely">Marosvásárhely</option>
</select>
  	</div>
  	<div class="input-mezo">
  	  <label>Személyszám</label>
  	  <select id="szemelyszam" >
  <option value="Otven">~50</option>
  <option value="Szaz">~100</option>
  <option value="Ketszaz">~200</option>
</select>
  	</div>
	
  	<div class="input">
  	  <input type="radio" id="elerhetoseg"  value='elérhető' checked>
	  <label for="eler">Elerheto</label>
	  <input type="radio"id="elerhetoseg"  value='foglalt'>
	  <label for="foglalt">Foglalt</label>
  	</div>
  	
  	<div class="input-mezo">
	<button type="button" class="btn" id="kereses" >Kereses</button>
  	  
  	</div>
  	
  </form>
  
<div id="esemenyek">
    
  </div>
  
  <script>
  
 
 
 $(document).ready(function(){
	 $('#kereses').click(function(){
  var esemenytipus=$("#esemenytipus").val(); 
var helyszin=$("#helyszin").val();   
var szemelyszam=$("#szemelyszam").val();
var elerhetoseg=$("#elerhetoseg").val(); 

$.ajax(
        {
        url: "api.php",
        type: "GET",
        data:{
			esemenytipus:esemenytipus,
			helyszin:helyszin,
			szemelyszam:szemelyszam,
			elerhetoseg:elerhetoseg,
			action:"kereses"
		},
		success:function(response){
			
			if(response=="Nincs ilyen elérhető/foglalt esemény!")
			{  
					
            $('#error').html(response);
			
			
			}
			else{
				
				$('#esemenyek').html(response);
				
				
			} 
		}
        });
    
        
  });
 });
  </script>
  
  </div>
 
  </body>
</html>
 

  
