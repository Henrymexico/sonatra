<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'sonatra.com.mx';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@sonatra.com.mx';
        $mail->Password   = 'TU_CONTRASEÑA_AQUÍ'; // ← escribe la contraseña tú directamente
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Emisor y destinatario
        $mail->setFrom('info@sonatra.com.mx', 'Sitio Web SONATRA');
        $mail->addAddress('info@sonatra.com.mx'); // Puede ajustarse si creas otro correo
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
