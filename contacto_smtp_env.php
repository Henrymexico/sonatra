<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar variables desde .env
$dotenv = parse_ini_file(__DIR__ . '/.env');

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP con variables del .env
        $mail->isSMTP();
        $mail->Host       = $dotenv['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $dotenv['SMTP_USER'];
        $mail->Password   = $dotenv['SMTP_PASS'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = $dotenv['SMTP_PORT'];

        // Emisor y destinatario
        $mail->setFrom($dotenv['SMTP_USER'], 'Sitio Web SONATRA');
        $mail->addAddress($dotenv['SMTP_USER']);
        $mail->addReplyTo($correo, $nombre);

        // Contenido
        $mail->isHTML(false);
        $mail->Subject = 'Nuevo mensaje desde el sitio SONATRA';
        $mail->Body    = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

        $mail->send();
        header("Location: gracias.html");
        exit();
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<h2>Acceso no válido.</h2>";
}
?>
