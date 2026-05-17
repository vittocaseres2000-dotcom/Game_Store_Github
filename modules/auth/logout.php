<!--Trabajo_GrupalWeb/modules/auth/logout.php-->
<?php

session_start();

session_destroy();

header(
    "Location: login-view.php"
);
?>