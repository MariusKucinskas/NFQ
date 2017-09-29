
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
	width: 20%;
    height: 20%;
    position:absolute; 
    margin: auto;
    top: 20%;
    left: 0;
}

.didelis{
	color: blue;
	width: 40%;
    height: 40%;
	 position:absolute; 
    margin: auto;
left: 100%;
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
echo '<a href="prisijungti.php">prisijungti</a>';
}
if (isset($_SESSION['vartotojas'])&&!($_SESSION['vartotojas']=="admin")){
	echo "Jums reikia administatoriaus teisiu";
}
	
if (isset($_SESSION['vartotojas'])&&($_SESSION['vartotojas']=="admin")) {
include 'prisijunges.php';
	
$con=mysqli_connect("localhost","root","","parduotuve");

// prisijungiu prie duombazes

// tikrinimas prasideda cia



require ("valymas.php");
$kartas=0;
// tikrinima ar vykdomas redagavimas is failo redagavimas.php


if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti'])) {
	$ar_redaguota=1;
	$redaguojamosid=$_GET['redaguoti']; 
	$sql="SELECT id, name, price, details, rusis, extension FROM prekes WHERE id='".$_GET['redaguoti']."';";	
	$row=mysqli_fetch_array(mysqli_query($con,$sql));
	$name=$row['name'];
	$price=$row['price'];
	$details=$row['details'];
	$row['id']=$redaguojamosid;
	$rusis=$row['rusis'];
	$extension=$row['extension'];

	
} else {
$name = $price = $details = $rusis= $extension ='';
//duomenu bazeje lentele "goods" su stulpeliais "id", "name", "price", "details"
$result = mysqli_query($con,"SELECT max(id) from prekes");
$row = mysqli_fetch_array($result);
}

$nameErr = $priceErr = $rusisErr = $nuotraukaErr ='';
$ar_redaguota=0;
if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti'])) {
	$ar_redaguota=1;
	$redaguojamosid=$_GET['redaguoti']; 
	$sql="SELECT id, name, price, details, rusis, extension FROM prekes WHERE id='".$_GET['redaguoti']."';";	
	$row=mysqli_fetch_array(mysqli_query($con,$sql));
	$name=$row['name'];
	$price=$row['price'];
	$details=$row['details'];
	$row['id']=$redaguojamosid;
	$rusis=$row['rusis'];
	$extension=$row['extension'];

	
} else {
$name = $price = $details = $rusis= $extension ='';
//duomenu bazeje lentele "goods" su stulpeliais "id", "name", "price", "details"
$result = mysqli_query($con,"SELECT max(id) from prekes");
$row = mysqli_fetch_array($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
// $_SERVER["REQUEST_METHOD"] == "POST" - patikrinam ar nuspaustas submit mygtukas su post metodu
	if (empty($_POST["name"])) {
    $nameErr = "Neivestas prekes pavadinimas";
	$kartas=1;
  } else {
    $name = valyti($_POST["name"]);
  }
  
  if (empty($_POST["price"])) {
    $priceErr = "Neivesta kaina";
	$kartas=1;
  } 
  elseif  (!filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT)) {
   $priceErr = "Kaina tuti buti skaicius";
	$kartas=1;
  }  
  
  else {
    $price = valyti($_POST["price"]);
  }
  /// tikrinu rusi
  
  if (empty($_POST["rusis"])) {
    $rusisErr = "Neivestas prekes rusis";
	$kartas=1;
  } else {
    $rusis = valyti($_POST["rusis"]);
  }

  
   if (empty($_POST["details"])) {
     $details = "";
   } else {
     $details = valyti($_POST["details"]);
   }
 /* 
if (empty($_POST["nuotrauka"])) {
    $nuotraukaErr = "Neprisegta nuotrauka";
	$kartas=1;
  } else {
    $name = valyti($_POST["nuotrauka"]);
  }  
  */
 
}
// tikrinimas baigiaisi cia
// atvaizdavimas prasideda cia


if (($kartas==0)&&($_SERVER["REQUEST_METHOD"] == "POST")) {
//database "test" should contain "Goods" table with "item" and "price" fields
//$details=valyti($_POST["details"]);



 $id = $row['max(id)']+1;
// reikia prideti vieneta prie maksimalios reiksmes, kad reiksmes "neprasoktu"



// failo ikelimas

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["nuotrauka"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts)
  &&(($_FILES["nuotrauka"]["type"] == "image/gif")
  || ($_FILES["nuotrauka"]["type"] == "image/jpeg")
  || ($_FILES["nuotrauka"]["type"] == "image/jpg")
  || ($_FILES["nuotrauka"]["type"] == "image/pjpeg")
  || ($_FILES["nuotrauka"]["type"] == "image/x-png")
  || ($_FILES["nuotrauka"]["type"] == "image/png"))
  && ($_FILES["nuotrauka"]["size"] < 2000000000)) {

if ($_FILES["nuotrauka"]["error"] > 0) {
    echo "Return Code: " . $_FILES["nuotrauka"]["error"] . "<br>";
  } else {

    if (file_exists("upload/" . $_FILES["nuotrauka"]["name"])) {
      echo $_FILES["nuotrauka"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["nuotrauka"]["tmp_name"], 
	  "upload/" .$id.".".$extension);
	 // echo "Stored in: " . "upload/" . $_FILES["nuotrauka"]["name"];
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['redaguoti'])) {
		$redaguojamosid = $_POST['redaguoti'];
		$sql="update prekes set name='".$name."', price='".$price."', details='".$details."', rusis='".$rusis."', extension='".$extension."' WHERE id='".$redaguojamosid."';";
} else {
		$sql="INSERT INTO prekes (name, price, details, rusis, extension) VALUES ('".$name."', '".$price."', '".$details."', '".$rusis."', '".$extension."')";
}
	
echo $sql;




mysqli_query($con,$sql);
$result = mysqli_query($con,"SELECT id, name, price, details, rusis, extension FROM prekes");
echo '<table  border="1">';
	echo '<th> ID </th>';
	echo '<th> Vardas </th>';
	echo '<th> Kaina </th>';
	echo '<th> Aprasymas </th>';
	echo '<th> Rusis </th>';
	echo '<th> Pletinys </th>';
	echo '<th> Nuotrauka </th>';
while($row = mysqli_fetch_array($result)) {
echo'<tr>';
  echo '<td>'.$row['id'].'</td>';
  echo '<td>'.$row['name'].'</td>';
echo '<td>'.$row['price'].'</td>';
  echo '<td>'.$row['details'].'</td>';
   echo '<td>'.$row['rusis'].'</td>';
      echo '<td>'.$row['extension'].'</td>';
echo '<td>' ;
// jeigu egzistuoja (nera empty) duomenu bazes laukelio extentsion reiksme
if( !(empty ($row['extension']))){
	echo '<img width="200" src=upload/'.$row['id'].'.'.$row['extension'].'>';
	echo '</img> ';
}
echo '</td>';
echo'</tr>';
  }
echo'</table>';
// istrinu infomacija is kintamojo "extension"
$extension=""; 
}


include 'HTMLivedimas.php';
}
?>
