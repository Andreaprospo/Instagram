<?php
session_destroy();
header("location: index.php?messaggio=hai effettuato correttamente il logout");
exit;
?>
