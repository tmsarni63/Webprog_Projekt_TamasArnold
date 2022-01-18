<?php
session_start();
$conn=mysqli_connect('localhost:3307','root','','api_db')  or die("Enable connect");

$res=array();

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
    switch($action) {
case "regisztralas":

  
	  $felhasznalo_nev=mysqli_real_escape_string($conn,$_GET['felhasznalo_nev']);
	  $nev=mysqli_real_escape_string($conn,$_GET['nev']);
	  $email=mysqli_real_escape_string($conn,$_GET['email']);
	  $jelszo_1=mysqli_real_escape_string($conn,$_GET['jelszo_1']);
	  $jelszo_2=mysqli_real_escape_string($conn,$_GET['jelszo_2']);
	  if ($jelszo_1 != $jelszo_2) 
		{
			echo "A ket jelszo nem egyezik meg";
		}

else{
  
  $felhasznalo_ellenorzes = "SELECT * FROM felhasznalo WHERE felhasznalo_nev='$felhasznalo_nev' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $felhasznalo_ellenorzes);
  $felhasznalo = mysqli_fetch_assoc($result);
  
  if ($felhasznalo) {
    if ($felhasznalo['felhasznalo_nev'] === $felhasznalo_nev) {
      echo "Ez a felhasznalo mar letezik";
    }

    if ($felhasznalo['email'] === $email) {
      echo "Ez az email cim mar letezik";
    }
	 
  }
  else{
	  $jelszo=md5($jelszo_1);
	  $sql = "INSERT INTO felhasznalo (nev,felhasznalo_nev, email, jelszo) 
  			  VALUES('$nev','$felhasznalo_nev', '$email', '$jelszo')";
			  $conn->query($sql);
			  $_SESSION['felhasznalo_nev']=$felhasznalo_nev;

              header('location:bejelentkezes.php');
               echo "sikeresen regisztralt";
              }
             } ;       
            break;


           case "bejelentkezes":
                $felhasznalo_nev = mysqli_real_escape_string($conn,$_GET['felhasznalo_nev']);
                $jelszo = md5(mysqli_real_escape_string($conn,$_GET['jelszo']));
                $sql = "SELECT * FROM felhasznalo WHERE  jelszo='$jelszo' AND felhasznalo_nev='$felhasznalo_nev'";  	
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) == 1) {
                    $_SESSION['felhasznalo_nev'] = $felhasznalo_nev;
                    $_SESSION['uzenet'] = "Sikeresen bejelentkezett!";
                  while($row=$result->fetch_assoc()){
                  $_SESSION['id']=$row['id'];}
                  header('location:kezdooldal.php');
                  
                  } ;
               
            break;

            case "listazas":

              $sql="SELECT * FROM esemeny";
              $result = mysqli_query($conn, $sql);
              while($obj=$result->fetch_assoc()){
              $res[] =$obj;}
                echo json_encode($res);

              ;
                break;

                case "kereses":
                  $esemenytipusa=mysqli_real_escape_string($conn,$_GET['esemenytipusa']);
                  $helyszin=mysqli_real_escape_string($conn,$_GET['helyszin']);
                  $szemelyszam=mysqli_real_escape_string($conn,$_GET['szemelyszam']);
                  $elerhetoseg=mysqli_real_escape_string($conn,$_GET['elerhetoseg']);
                  $sql = "SELECT * FROM esemeny WHERE esemenytipusa='$esemenytipusa'AND helyszin='$helyszin' AND szemelyszam='$szemelyszam'AND elerhetoseg='$elerhetoseg'";
                  $result = mysqli_query($conn, $sql);



                  if($result->num_rows>0){

                    echo '<table >';
                 echo '<h2>Találatok:<h2>';
                echo '<tr>';
                    echo '<td></td>';
                    echo '<td>Esemenytipus</td>';
                    echo '<td >Helyszin</td>';
                    echo '<td >Szemelyszam</td>';
                    echo '<td >Elerhetoseg</td>';

                echo '</tr>';
                    foreach($result as $var){

                    echo '<tr>';
                            echo '<td></td>';
                            echo '<td>'.$var['esemenytipusa'].'</td>';
                            echo '<td>'.$var['helyszin'].'</td>';
                      echo '<td>'.$var['szemelyszam'].'</td>';
                      echo '<td>'.$var['elerhetoseg'].'</td>';

                    echo '</tr>';
                  }
                  echo'</table>';

                    }

                    break;

                    case "foglalas":
                      $esemenytipusa=mysqli_real_escape_string($conn,$_GET['esemenytipusa']);
                      $helyszin=mysqli_real_escape_string($conn,$_GET['helyszin']);
                      $szemelyszam=mysqli_real_escape_string($conn,$_GET['szemelyszam']);
                      $elerhetoseg=mysqli_real_escape_string($conn,$_GET['elerhetoseg']);
                      $datumtol=mysqli_real_escape_string($conn,$_GET['datumtol']);
                      $datumig=mysqli_real_escape_string($conn,$_GET['datumig']);
                      $nev=mysqli_real_escape_string($conn,$_GET['nev']);
                      $telefonszam=mysqli_real_escape_string($conn,$_GET['telefonszam']);

                        $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
                         //$id = $_SESSION['id'];
                      $sql = "SELECT * FROM esemeny";
                        $result=$conn->query($sql);
                        if($result){
                      if($result->num_rows>0){
                          $row=$result->fetch_assoc();
                          $esemeny_id=$row['id'];

                          $sql = "INSERT INTO foglalas (foglalas_id,esemeny_id,szemely_nev,telefonszam, datumtol, datumig,felhasznalo_id) 
                              VALUES('','$esemeny_id','$nev', '$telefonszam', '$datumtol','$datumig','$id')";
                          $conn->query($sql);
                          $sqll="UPDATE esemeny SET elerhetoseg='foglalt' where id='$esemeny_id' ";
                          $conn->query($sqll);

                          echo "Sikeresen foglalt";
                      }
                      }else{
                        echo "Nincs ilyen szabad esemeny!";
                      };
                      break;    
                      
                      
                      case "elistazas":
                        $sql="SELECT * FROM foglalas INNER JOIN felhasznalo ON felhasznalo.id=foglalas.felhasznalo_id";
                        $result = mysqli_query($conn, $sql);
                        if($result->num_rows>0)
                        {
                        while($row=$result->fetch_assoc()){
                        $id=$row['esemeny_id'];
                    
                        $sql="SELECT * FROM esemeny where id='$id'";
                        $results = mysqli_query($conn, $sql);
                        while($var=$results->fetch_assoc()){
                          
                          echo "Foglalas: ".$row['foglalas_id']."<br>"."Esemenytipus: ".$var['esemenytipusa']."<br>"."Helyszin: ".$var['helyszin']."<br>"."Szemelyszam: ".$var['szemelyszam'];
                        }
                      }
                      
                      }
                      else 
                      {echo "Önnek nincs foglalása!";}
                        ;
                        break;

                        case "lemondas":
                          $visszamondott=mysqli_real_escape_string($conn,$_GET['visszamondott']);
                          $sql = "SELECT* FROM foglalas WHERE foglalas_id='$visszamondott'";
                          $result=$conn->query($sql);
                          if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                            $visszamondott_esemeny=$row['esemeny_id'];
                            $sql="DELETE FROM foglalas where foglalas_id=$visszamondott"; 
                            $conn->query($sql);
                            $sqll="UPDATE esemeny SET elerhetoseg='elérhető' where id='$visszamondott_esemeny'";
                            $conn->query($sqll);
                            
                            
                          }
                          echo "Sikeresen torolte a foglalasat!";
                          }
                          else{
                            echo "Nincs ilyen foglalt esemenye!";
                          };
                          break;
                            }
                          }
?>

