<html>
<head>
<style type="text/css">
div{
	width: 30%;
    height: 15%;
	position:absolute; 
    margin: auto;
	top: 10%;	
	float: left;
}

h1{
	width: 20%;
    height: 20%;
float: left;
    margin: auto;
    top: 0;
    left: 0;
}

.didelis{
	color: blue;
	width: 40%;
    height: 40%;
    margin: auto;
left: 100%;
}

table{
 width: 55%;
 float: right;
}
</style>
</head>
</html>
<?php
$con=mysqli_connect("localhost","root","","parduotuve");

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




	// prasideda salinimas
if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['salinti'])) {
	$trinamosid=$_GET['salinti'];
} 
  if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['salinti']) ) {
	echo 'trinama\n';
	$sql='DELETE FROM kategorijos WHERE katid="'.$trinamosid.'";';
	echo $sql;
	mysqli_query($con,$sql);
 }
// salinimas baigiasi cia


if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti'])) {
	$redaguojamosid=$_GET['redaguoti'];
} 
  if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti']) ) {
	echo 'redaguojama\n';


	
	$sql='UPDATE kategorijos SET name="Redaguotas", price="99", details="Redaguota preke" WHERE id="'.$redaguojamosid.'";';
	echo $sql;
	
	

	mysqli_query($con,$sql);

  }


// atvaizavimas
$result = mysqli_query($con,"SELECT max(katid) from kategorijos");
$row = mysqli_fetch_array($result);
 $id = $row['max(katid)']+1;
 

 
 
 
 if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['veiksmas']) ) {
	 if ($_GET['veiksmas'] == 'filtras') {
		 echo 'filtras';
		$sql="SELECT katid, pavadinimas FROM kategorijos WHERE rusis='".$_GET['norima_rusis']."' ";
	 }
 } else {
 $sql="SELECT katid, pavadinimas FROM kategorijos";
 }
 $result = mysqli_query($con,$sql);
 



  
echo '<table  border="1">';
	echo '<th> Kategorijos ID </th>';
	echo '<th> Kategorijos pavadinimas </th>';
while($row = mysqli_fetch_array($result)) {
echo'<tr>';
  echo '<td>'.$row['katid'].'</td>';
  echo '<td>'.$row['pavadinimas'].'</td>';

 //$result = mysqli_query($con,$sql);
echo '<td><a href="kategorijos_ivedimas.php?redaguoti='.$row['katid'].'">redaguoti</a></td>';

echo '<td><a href="kategorijos_redagavimas.php?salinti='.$row['katid'].'">Salinti</a></td>';

 
echo'</tr>';
  }
echo'</table>';

}
 ?>
