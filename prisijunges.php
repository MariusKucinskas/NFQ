<div class="prisijugimas" style="background:#E0FFFF;">
<?php
if (isset($_SESSION['vartotojas'])) {
	Echo "Prisijungęs: ".$_SESSION['vartotojas'];
}
?>
<a href='atsijungti.php'>Atsijungti</a>
</div>