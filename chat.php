<?php
//code by nakari
//Nakari github https://github.com/Nakaril
session_start();
// Si el usuario no ha ingresado su nombre de usuario, redirigirlo al index.html
if(!isset($_POST['username'])) {
	header("Location: index.html");
} else {
	// Establecer el nombre de usuario en la sesión
	$_SESSION['username'] = $_POST['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sala de chat</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		//Función para obtener actualizaciones del chat
		function getChat() {
			$.ajax({
				url: "getchat.php",
				success: function(data) {
					$('#chat').html(data);
					$('#chat').scrollTop($('#chat')[0].scrollHeight); //Hace que la ventana del chat se desplace automáticamente a la parte inferior
				}
			});
		}

		//Función para enviar un mensaje
		function sendMessage() {
			$.ajax({
				url: "sendmessage.php",
				method: "POST",
				data: {
					message: $('#message').val(),
					username: '<?php echo $_SESSION["username"] ?>'
				},
				success: function(data) {
					$('#message').val('');
					getChat();
				}
			});
		}

		//Actualizar el chat cada segundo con nuevas actualizaciones
		setInterval(function() {
			getChat();
		}, 1000); 
	</script>

	<style>
		#chat {
			border: 1px solid gray;
			padding: 10px;
			height: 200px;
			overflow-y: scroll;
		}
		body{
      background-color: #F5F5DC;
    }
		.message {
			margin-bottom: 10px;
			padding: 10px;
			background-color: #f2f2f2;
			border-radius: 5px;
			max-width: 80%;
		}
		
		.username {
			font-weight: bold;
			margin-right: 10px;
		}
		
		.timestamp {
			font-size: 12px;
			color: gray;
			margin-left: 10px;
			margin-top: 5px;
		}
		
		.input-container {
			display: flex;
			margin-top: 10px;
		}
		
		#message {
			flex: 1;
			padding: 5px;
			border: 1px solid gray;
			border-radius: 5px;
		}
		
		#send-button {
			margin-left: 10px;
			padding: 5px 10px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>Sala de chat</h1>
	<h2>Bienvenido, <?php echo $_SESSION['username'] ?>!</h2>
	<div id="chat">
		Esperando los mensajes...
	</div>
	<div class="input-container">
		<input type="text" id="message" name="message" placeholder="Escribe tu mensaje aquí">
		<button type="button" id="send-button" onclick="sendMessage()">Enviar</button>
	</div>

	<script>
		// Obtener el contenedor del chat y el botón de enviar
		var chatContainer = document.getElementById("chat");
		var sendButton = document.getElementById("send-button");

		// Hacer que la ventana del chat se desplace automáticamente hacia abajo
		chatContainer.scrollTop = chatContainer.scrollHeight;

		// Agregar un evento de clic al botón de enviar para que también envíe el mensaje al presionar la tecla Enter
		sendButton.addEventListener("click", sendMessageOnEnter);

		// Función para enviar un mensaje cuando se presiona la tecla Enter
		function sendMessageOnEnter(event) {
			if (event.keyCode === 13) {
				sendMessage();
			}
		}
	</script>
</body>
</html>
