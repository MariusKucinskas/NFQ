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

if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['salinti'])) {
	$trinamosid=$_GET['salinti'];
} 
  if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['salinti']) ) {
	echo 'trinama\n';
	$sql='DELETE FROM prekes WHERE id="'.$trinamosid.'";';
	echo $sql;
	mysqli_query($con,$sql);
 } 


// atvaizavimas
$result = mysqli_query($con,"SELECT max(id) from prekes");
$row = mysqli_fetch_array($result);
 $id = $row['max(id)']+1;
 

 
 
 
 if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['veiksmas']) ) {
	 if ($_GET['veiksmas'] == 'filtras') {
		 echo 'filtras';
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
echo '<td>Kaina: '.$row['price'].'</td>';
  echo '<td>'.$row['details'].'</td>';
  
  
   echo '<td>'.$row['rusis'].'</td>';
echo '<td>' ;
// jeigu egzistuoja (nera empty) duomenu bazes laukelio extention reiksme
if( !(empty ($row['extension']))){
	echo '<img width="200" src=upload/'.$row['id'].'.'.$row['extension'].'>';
	echo '</img> ';
}
echo '</td>';

 //$result = mysqli_query($con,$sql);
echo '<td><a href="salinimas.php?salinti='.$row['id'].'">salinti</a></td>';
echo'</tr>';
  }
echo'</table>';
// istrinu infomacija is kintamojo "extension"
$extension="";


}
 ?>
