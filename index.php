<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if (!isset($_SESSION['vartotojas'])) {
	include('neprisijunges.php');
} else {
	include('prisijunges.php');
}
?>
