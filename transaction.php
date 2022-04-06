<?php
   require_once "config/db.php";
   
   $sql = "SELECT * FROM transactions";
   $result = $conn->query($sql);
?>