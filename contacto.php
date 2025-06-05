<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $mensaje = $_POST["mensaje"];
  $destino = "enriquecarranzae@gmail.com";
  $asunto = "Mensaje desde formulario SONATRA";
  $contenido = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";
  mail($destino, $asunto, $contenido);
  header("Location: gracias.html");
  exit();
}
?>