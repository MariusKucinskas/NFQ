<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	width: 30%;
    height: 20%;
    position:absolute; 
    margin: auto;
    top: 0;
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

h2{
 width: 55%;
 float: right;
}


</style>
</head>
<?php
// tikrinimas prasideda cia

require ("valymas.php");
$kartas=0;
$loginname = $slaptazodis = $pastas = $adresas= $vardas = $pavarde='';
$loginnameErr = $slaptazodisErr = $pastasErr = $adresasErr = $vardasErr = $pavardeErr='';
$con=mysqli_connect("localhost","root","","parduotuve");

// prisijungiu prie duombazes




if ($_SERVER["REQUEST_METHOD"] == "POST") { 
// $_SERVER["REQUEST_METHOD"] == "POST" - patikrinam ar nuspaustas submit mygtukas su post metodu

	if (empty($_POST["loginname"])) {
    $loginnameErr = "Neivestas vartotojo vardas";
	$kartas=1;
  } else {
    $loginname = valyti($_POST["loginname"]);
  }
  
  $sql='SELECT loginname from vartotojai WHERE loginname="'.$loginname.'";';
$result = mysqli_query($con,$sql);

if (mysqli_num_rows($result)!=0) {
	$loginnameErr = "Toks vartotojo vardas jau yra";
	$kartas=1;
} 
  
  	if (empty($_POST["slaptazodis"])) {
    $slaptazodisErr = "Neivestas slaptazodis";
	$kartas=1;
  } else {
    $slaptazodis = valyti($_POST["slaptazodis"]);
  }

  if (empty($_POST["pastas"])) {
    $pastasErr = "Neivestas el. pastas";
	$kartas=1;
  }  elseif (!filter_input(INPUT_POST, "pastas", FILTER_VALIDATE_EMAIL)) {
    $pastasErr = "Blogai ivestas pastas";
	$pastas = htmlspecialchars($_POST["pastas"]);
	$kartas=1;
  }
  else {
    $pastas = valyti($_POST["pastas"]);
  }
  
  if (empty($_POST["adresas"])) {
    $adresasErr = "Neivestas jusu namu adresas";
	$kartas=1;
  } else {
    $adresas = valyti($_POST["adresas"]);
  }
  
 if (empty($_POST["vardas"])) {
    $vardasErr = "Neivestas vardas";
	$kartas=1;
  } else {
    $vardas = valyti($_POST["vardas"]);
  }
  
   if (empty($_POST["pavarde"])) {
    $pavardeErr = "Neivesta pavarde";
	$kartas=1;
  } else {
    $pavarde = valyti($_POST["pavarde"]);
  }

 
}

// tikrinimas baigiaisi cia


// atvaizdavimas prasideda cia
if (($kartas==0)&&($_SERVER["REQUEST_METHOD"] == "POST")) {

$result = mysqli_query($con,"SELECT max(vartotojo_id) from vartotojai");



$row = mysqli_fetch_array($result);
 $id = $row['max(vartotojo_id)']+1;
// reikia prideti vieneta prie maksimalios reiksmes, kad reiksmes "neprasoktu"

// prekiu saraso is DB atvaizdavimas




 

 

$sql="INSERT INTO vartotojai (loginname, slaptazodis, pastas, adresas, vardas, pavarde) VALUES ('".$loginname."', '".$slaptazodis."', '".$pastas."', '".$adresas."', '".$vardas."', '".$pavarde."' )";



// "INSERT INTO Goods (item, price) VALUES ('Mouse', '20')"
//echo $sql; //For testing. You can see exact query which is passed to DB.

// $loginname = $slaptazodis = $pastas = $adresas= $vardas = $pavarde='';

mysqli_query($con,$sql);
$result = mysqli_query($con,"SELECT loginname, slaptazodis, pastas, adresas, vardas, pavarde FROM vartotojai");

echo '<h2> Sveikiname Jūs sėkmingai užsiregistravote </h2>';





}
// loginname, slaptazodis, pastas, adresas, vardas, pavarde
// $loginnameErr = $slaptazodisErr = $pastasErr = $adresasErr = $vardasErr = $pavardeErr='';
?>


<html><body>
<h1>Vartotojo registracija</h1>
<div>
<form action="registracija.php" method="POST" enctype="multipart/form-data"> 
Vartojo vardas: <input type="text" name="loginname" size="35" value="<?php echo $loginname; ?>" /> <span style="color:red"> <?php echo $loginnameErr; ?> </span>  <br>
Slaptazodis: <input type="password" name="slaptazodis" size="35" value="<?php echo $slaptazodis; ?>" /> <span style="color:red"> <?php echo $slaptazodisErr; ?> </span>  <br>
Pastas: <input type="text" name="pastas" size="35" value="<?php echo $pastas; ?>" /> <span style="color:red"> <?php echo $pastasErr; ?> </span>  <br> 
Adresas: <input type="text" name="adresas" size="35" value="<?php echo $adresas; ?>" /> <span style="color:red"> <?php echo $adresasErr; ?> </span>  <br>
Vardas: <input type="text" name="vardas" size="35" value="<?php echo $vardas; ?>" /> <span style="color:red"> <?php echo $vardasErr; ?> </span>  <br>
Pavarde: <input type="text" name="pavarde" size="35" value="<?php echo $pavarde; ?>" /> <span style="color:red"> <?php echo $pavardeErr; ?> </span>  <br>


<input class="didelis" type="submit" name="submit" value="Siųsti">

<br>



</form>
</div>
</body></html>
</html>