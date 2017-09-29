<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">

.prisijugimas {
	width: 100%;
    height: 20px;
	position:absolute; 
    margin: auto;
	top: 0%;	
	float: left;
}

div{
	width: 30%;
    height: 15%;
	position:absolute; 
    margin: auto;
	top: 30%;	
	float: left;
}

h1{
	width: 30%;
    height: 20%;
float: left;
    margin: auto;
    top: 0;
    left: 0;
}



table{
 width: 55%;
 float: right;
}

</style>
</head>
<?php
session_start();
include 'index.php';
if (!isset($_SESSION['vartotojas'])) {
//echo '<a href="prisijungti.php">prisijungti</a>';
}
if (isset($_SESSION['vartotojas'])&&!($_SESSION['vartotojas']=="admin")){
	echo "Jums reikia administatoriaus teisiu";
}
	
if (isset($_SESSION['vartotojas'])&&($_SESSION['vartotojas']=="admin")) {
include 'prisijunges.php';

// tikrinimas prasideda cia

require ("valymas.php");
$kartas=0;

$pavadinimasErr='';

$con=mysqli_connect("localhost","root","","parduotuve");
// prisijungiu prie duombazes


if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti'])) {
	$redaguojamosid=$_GET['redaguoti']; 
	$sql="SELECT pavadinimas FROM kategorijos WHERE katid='".$_GET['redaguoti']."';";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$pavadinimas=$row['pavadinimas'];
} else {
$pavadinimas='';
//duomenu bazeje lentele "goods" su stulpeliais "id", "name", "price", "details"
$result = mysqli_query($con,"SELECT max(katid) from kategorijos");
$row = mysqli_fetch_array($result);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
// $_SERVER["REQUEST_METHOD"] == "POST" - patikrinam ar nuspaustas submit mygtukas su post metodu
	if (empty($_POST["pavadinimas"])) {
    $pavadinimasErr = "Neivestas kategorijos pavadinimas";
	$kartas=1;
  } else {
    $pavadinimas = valyti($_POST["pavadinimas"]);
  }
   
}

// tikrinimas baigiaisi cia


// atvaizdavimas prasideda cia
if (($kartas==0)&&($_SERVER["REQUEST_METHOD"] == "POST")) {








$result = mysqli_query($con,"SELECT max(katid) from kategorijos");



$row = mysqli_fetch_array($result);
 $katid = $row['max(katid)']+1;
// reikia prideti vieneta prie maksimalios reiksmes, kad reiksmes "neprasoktu"




$sql="INSERT INTO kategorijos (pavadinimas) VALUES ('".$pavadinimas."')";



// "INSERT INTO Goods (item, price) VALUES ('Mouse', '20')"
//echo $sql; //For testing. You can see exact query which is passed to DB.

// $loginname = $slaptazodis = $pastas = $adresas= $vardas = $pavarde='';

mysqli_query($con,$sql);
$result = mysqli_query($con,"SELECT katid, pavadinimas FROM kategorijos");
echo '<table  border="1">';
	echo '<th> Kategorijos ID </th>';
	echo '<th> Pavadinimas  </th>';
while($row = mysqli_fetch_array($result)) {
echo'<tr>';
  echo '<td>'.$row['katid'].'</td>';
  echo '<td>'.$row['pavadinimas'].'</td>';
echo'</tr>';
  }
echo'</table>';




}

include 'HTML_kategorijos_ivedimas.php';
}
?>


