<?php
session_start();
unset($session['usuario']);
session_destroy();
header('Location: index.php');

?>