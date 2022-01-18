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
<form method="GET" action="esemenyek.php">
  <h2>Kilistázás</h2>
  <div class="input-mezo" >
  <button type="button" class="btn" onclick="listazas()" >Kilistazas</button>
  </div>
  </form>
  <div id="esemenyek">
    
  </div>
  </div>

  <script>
  
  var adatfeldolgoz = function(data){
        
            console.log(data);
            console.log(data.status);
            console.log(data.responseText);
            
            if(data.status != 200)
            {
                console.error("Hiba tortent:" + data.statusText );
                return;
            }
            
            var adat = JSON.parse(data.responseText);
            if(adat == null)
                console.error("Hiba");
                
            console.log(adat);
            
            
            
          }
 
  function listazas()
  {
    $.ajax(
        {
        url: "api.php",
        type: "GET", 
		data:{
		"action":"listazas"
		},
        contentType: "application/json",
        complete: adatfeldolgoz
        });
        
        
  }
  </script>
</div>

</body>
</html>