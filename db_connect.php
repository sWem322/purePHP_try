<?php

function connect()
 {
 $host_db = "127.0.0.1";
 $user_db = "space_web";
 $pass_db = "Ie6fenge";
 $db      = "space_web";
 $conn = new mysqli($host_db, $user_db, $pass_db, $db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>