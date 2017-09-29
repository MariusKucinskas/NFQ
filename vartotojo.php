<?php
include 'index.php';

if (isset($_SESSION['vartotojas'])&&($_SESSION['vartotojas']=="admin")) {
	echo '<a href="ivedimas.php"> Prekės įvedimas </a> <br>';
	echo '<a href="redagavimas.php"> Prekės redagavimas</a> <br>';
	echo '<a href="kategorijos_ivedimas.php"> Kategorijos ivedimas </a> <br>';
	echo '<a href="kategorijos_redagavimas.php"> Prekės redagavimas </a> <br>';
};

// echo  '<form method="GET">'; 
$con=mysqli_connect("localhost","root","","parduotuve");
echo	'<a href="vartotojo.php" ><img width="20%" src="logo.svg"></img>  </a>';
$result = mysqli_query($con,"SELECT * from kategorijos");
while($row = mysqli_fetch_array($result)) {

echo    '<a href="vartotojo.php?veiksmas=filtras&norima_rusis='.$row['katid'].'">'.$row['pavadinimas'].'        </a>' ;
//echo	'<a href="vartotojo.php?veiksmas=filtras&norima_rusis=2">Nerealūs monitoriai             </a>' ;

}

// echo "Pasirinktas elementas su ID=".$_GET['id'];

$result = mysqli_query($con,"SELECT max(id) from prekes");
$row = mysqli_fetch_array($result);
 $id = $row['max(id)']+1;
 
 if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['veiksmas']) ) {
	 if ($_GET['veiksmas'] == 'filtras') {
		$sql="SELECT id, name, price, details, rusis, extension FROM prekes WHERE rusis='".$_GET['norima_rusis']."' ";
	 }
 } else {
 $sql="SELECT id, name, price, details, rusis, extension FROM prekes";
 }
 $result = mysqli_query($con,$sql);
 
 



echo '<table  border="1">';
	echo '<th> ID </th>';
	echo '<th> Vardas </th>';
	echo '<th> Kaina </th>';
	echo '<th> Aprasymas </th>';
	echo '<th> Rusis </th>';
	echo '<th> Nuotrauka </th>';
while($row = mysqli_fetch_array($result)) {
echo'<tr>';
  echo '<td>'.$row['id'].'</td>';
  echo '<td>'.$row['name'].'</td>';
echo '<td>'.$row['price'].'</td>';
  echo '<td>'.$row['details'].'</td>';
  
  
   echo '<td>'.$row['rusis'].'</td>';
echo '<td>' ;
// jeigu egzistuoja (nera empty) duomenu bazes laukelio extention reiksme
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
 
 ?>
