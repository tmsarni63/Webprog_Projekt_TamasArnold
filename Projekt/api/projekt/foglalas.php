<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/foglalas.css">
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
		<strong><a href="kijelentkezes.php" >Kijelentkezés</a></strong>
		<?php endif ?>
		</div>   
  </div>
</div>

<form method="GET" action="foglalas.php">
<div class="form1">
<div class="header">
  	<h2>Esemény kiválasztása</h2>
  </div>	

  <div class="fejlec2">
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
  	</div>


  	</div>
	</div>
	<div class="form2">
	<div class="input-mezo">
	<label>Foglalás dátuma:</label>
	<input type="date" id="datumtol">
	</div>
	</div>
	<div class="form3">
	<div class="input-mezo">
	<label >Lejárás dátuma:</label>
	<input type="date" id="datumig" >
	</div>
	</div>
	<div class="form4" 	>
	</div>
	<div class="form5">
<div class="header">
  	<h2>Személyi adatok</h2>
  </div>	

  <div class="fejlec2">
  	<div class="input-mezo">
  	  <label>Név</label>
<input type="text" id="nev">
  	</div>
  	<div class="input-mezo">
  	  <label>Telefonszám</label>
  	  <input type="text" id="telefonszam">
  	</div>
	
  	<div class="input">
  	  <input type="radio" id="nem" value='nő' checked>
	  <label for="eler">Nő</label>
	  <input type="radio" id="nem" value='férfi'>
	  <label for="ber">Férfi</label>
  	</div>

  	</div>
	</div>
	
  	  <button type="button" class="btn" name="foglalas" id="foglalas">Foglalás</button>
  	
  </form>
<script>  
  
  $(document).ready(function(){
	 $('#foglalas').click(function(){
  var esemenytipus=$("#esemenytipus").val(); 
var helyszin=$("#helyszin").val();   
var szemelyszam=$("#szemelyszam").val();
var elerhetoseg=$("#elerhetoseg").val(); 
var datumtol=$("#datumtol").val(); 
var datumig=$("#datumig").val();  
var nev=$("#nev").val();
var telefonszam=$("#telefonszam").val(); 
var nem=$("#nem").val(); 
if(datumtol!=''&&datumig!=''&&nev!=''&&telefonszam!=''&&nem!='')
{ $.ajax(
        {
        url: "api.php",
        type: "GET",
        data:{
			esemenytipus:esemenytipus,
			helyszin:helyszin,
			szemelyszam:szemelyszam,
			elerhetoseg:elerhetoseg,
			datumtol:datumtol,
			datumig:datumig,
			nev:nev,
			telefonszam:telefonszam,
			nem:nem,
			action:"foglalas"
		},
		success:function(response){
			if(response=="Jelenleg nincs ilyen elerheto esemenyunk!")
			{ 
                
            $('#error').html(response);

			}
			else{
				window.location='kezdooldal.php';
			} 
		}
        });
}  
else{
	alert("Kerem toltse ki az osszes mezot!");
}
        
  });
 });
  </script>
  </div>

</body>
</html>