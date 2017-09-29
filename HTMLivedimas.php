<html>
<head>
<meta charset="UTF-8">

</head>
<body>
<h1>Prekes ivedimas</h1>
<div>
<form action="ivedimas.php" method="POST" enctype="multipart/form-data"> 
Vardas: <input type="text" name="name" size="35" value="<?php echo $name; ?>" /> <span style="color:red"> <?php echo $nameErr; ?> </span>  <br>
Kaina: <input type="number" step="0.01" name="price" maxlength="4" size="4" value="<?php echo $price; ?>" /> € <span style="color:red"> <?php echo $priceErr;?> </span> <br>
Aprašymas: <br>
<textarea name="details" rows="14" cols="70"><?php echo $details;?></textarea>
<br>


Rušis: <select type="text" name="rusis">
<?php $result = mysqli_query($con,"SELECT * from kategorijos");
while($row = mysqli_fetch_array($result)){
		print_r($row);
		echo $row['katid'];
		echo '<option value="'.$row['katid'].'" ';
		if ($rusis=="1") echo "selected";
		echo ' >'.$row['pavadinimas'].'</option>';
}		
?>

<select>
 <span style="color:red"> <?php echo $rusisErr;?> </span> <br>


<label for="file">Nuotrauka:</label> <input type="file" name="nuotrauka"> <span style="color:red"> <?php echo $nuotraukaErr;?> </span> <br>
<input class="didelis" type="submit" name="submit" value="Siusti">

<br>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['redaguoti'])) {
	echo "<input type='hidden' name='redaguoti' value=".$_GET['redaguoti'].">";
}
?>
</form>
</div>
</body></html>
</html>