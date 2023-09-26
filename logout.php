<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['pseudo']);
unset($_SESSION);
session_destroy();
header('Location: index.php');
exit();
?>

