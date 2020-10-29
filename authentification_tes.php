<?php

$login=$_POST['login'];
$passe=$_POST['passe'];
if($passe=="blaisemu" and $login=="blaise") header('location:menu.php');
else echo "<h1> Votre mot de passe est incorrect !!! ";
?>
