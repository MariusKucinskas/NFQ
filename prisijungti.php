<?php
session_start();
$name = $Err = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$con=mysqli_connect("localhost","root","","parduotuve");
	
  if (empty($_POST["name"])) {
    $Err = "Įveskite vardą";	
  } else {
    $name = htmlspecialchars($_POST["name"]); 
	if (empty($_POST["pass"])) {
		$Err = "Įveskite slaptažodį";	
	}
	else {
		$pass = $_POST["pass"];
		
$sql="SELECT loginname, slaptazodis FROM vartotojai WHERE loginname='".$_POST['name']."';";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	if ($_POST["pass"]==$row['slaptazodis'])
	{
		echo "Sekmingai prisijungta<br>Ivestas pass:";
		echo $_POST["pass"];
		echo '<br>DB pass:';
		echo $row['slaptazodis'];
		$_SESSION['vartotojas'] =  $_POST['name'];
	//	Echo '<a href="index.php">Toliau</a>';
	header("Location: vartotojo.php"); // naudoju PHP redirect
	} else {
		echo 'Blogas slaptazodis';
	}
	
	

	}
  }
}
//print_r ($_SESSION);
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Vardas: <input type="text" name="name" value="<?php echo $name;?>"><br>
Slaptažodis: <input type="password" name="pass"><br>
<span><?php echo $Err; ?></span><br>
<input type="submit">
</form>