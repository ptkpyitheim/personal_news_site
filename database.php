<?php
 
 $mysqli = new mysqli('localhost', 'ptkpyitheim', 'hola1', 'module3');

 if($mysqli->connect_errno) {
     printf("Connection Failed: %s\n", $mysqli->connect_error);
     exit;
 }

 ?>
