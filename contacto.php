<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    $para = "info@sonatra.com.mx";
    $asunto = "Nuevo mensaje desde el sitio SONATRA";

    $cabeceras = "From: contacto@sonatra.com.mx\r\n";
    $cabeceras .= "Reply-To: $correo\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $contenido = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

    if (mail($para, $asunto, $contenido, $cabeceras)) {
        header("Location: gracias.html");
        exit();
    } else {
        echo "<h2>Error al enviar el mensaje. Inténtalo más tarde.</h2>";
    }
} else {
    echo "<h2>Acceso no válido.</h2>";
}
?>
