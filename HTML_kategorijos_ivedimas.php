<html><body>
<h1><br><br><br><br><br><br>Kategorijos ivedmas</h1>
<div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<form action="kategorijos_ivedimas.php" method="POST" enctype="multipart/form-data"> 
Kategorijos pavadinimas: <input type="text" name="pavadinimas" size="35" value="<?php echo $pavadinimas; ?>" /> <span style="color:red"> <?php echo $pavadinimasErr; ?> </span>  <br>


<input  type="submit" name="submit" value="Siųsti">

<br>



</form>
</div>
</body></html>
</html>