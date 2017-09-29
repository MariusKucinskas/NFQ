<?php 
function valyti($data) {
  $data = htmlspecialchars ($data);
  $data = stripslashes ($data);
  $data = trim ($data);
  return $data;
}
?>