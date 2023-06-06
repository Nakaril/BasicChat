<?php
//Code by nakari 
//github https://github.com/Nakaril
session_start();
$username = $_POST['username'];
$message = $_POST['message'];

// Agregar el mensaje al archivo de registro
$file = fopen("chatlog.txt", "a");
fwrite($file, "[" . date("m/d/Y h:iA", time()) . "] " . $username . ":\n" . $message . "\n\n");
fclose($file);
?>
