<?php
    define("HOST", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DB", "mailReport");

    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DB);

    if (!$con) {
        echo "ERROR: " . mysqli_connect_errno();
        exit;
    }
?>
