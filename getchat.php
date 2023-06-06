<?php
//Code by nakari
//Nakari github https://github.com/Nakaril
session_start();
$messages = file_get_contents("chatlog.txt");
$messagesArray = explode("\n\n", $messages);

// Construir el HTML para mostrar los mensajes
$chatHtml = '';
foreach ($messagesArray as $message) {
  if (!empty($message)) {
    $messageLines = explode("\n", $message);
    $timestamp = $messageLines[0];
    $username = $messageLines[1];
    $content = implode("\n", array_slice($messageLines, 2)); // Unir las líneas restantes en el contenido del mensaje
    $chatHtml .= '<div class="message">' .
      '<span class="username">' . $username . ':</span>' .
      '<span class="timestamp">' . $timestamp . '</span><br>' .
      $content .
      '</div>';
  }
}

echo $chatHtml;
?>
