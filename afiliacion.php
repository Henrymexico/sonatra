
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $telefono = htmlspecialchars(trim($_POST["telefono"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $empresa = htmlspecialchars(trim($_POST["empresa"]));
    $rfc = htmlspecialchars(trim($_POST["rfc"]));
    $direccion = htmlspecialchars(trim($_POST["direccion"]));
    $comentarios = htmlspecialchars(trim($_POST["comentarios"]));

    $para = "contacto@sonatra.com.mx";
    $asunto = "Nueva solicitud de afiliación - SONATRA";

    $cabeceras = "From: contacto@sonatra.com.mx\r\n";
    $cabeceras .= "Reply-To: $correo\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $contenido = "Nombre: $nombre\nTeléfono: $telefono\nCorreo: $correo\nEmpresa: $empresa\nRFC: $rfc\nDirección: $direccion\nComentarios: $comentarios";

    if (mail($para, $asunto, $contenido, $cabeceras)) {
        header("Location: gracias.html");
        exit();
    } else {
        echo "<h2>Error al enviar la solicitud. Inténtalo más tarde.</h2>";
    }
} else {
    echo "<h2>Acceso no válido.</h2>";
}
?>
