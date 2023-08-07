<?php

  include "../Connection/connection.php"; // db connection

  session_start();

  session_unset();

  session_destroy();

  header("Location: ../Login/login.php");

?>
