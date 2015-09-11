<?php

$etapa = strtolower($_REQUEST['etapa']);

$errors = array();

if ($_REQUEST['name'] == "") {
  $errors["name"] = "Nombre vacío";
} elseif(strlen($_REQUEST['name']) < 3) {
  $errors["name"] = "Nombre demasiado corto";
} else {
  $name = $_REQUEST['name'];
} 

if ($_REQUEST['email'] == "") {
  $errors["email"] = "Email vacío";
} elseif (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors["email"] = "Email incorrecto";
} else {
  $email = $_REQUEST['email'];
}

if ($_REQUEST['phone'] == "") {
  $errors["phone"] = "Teléfono vacío";
} elseif(strlen($_REQUEST['phone']) < 9) {
  $errors["phone"] = "Teléfono menor de 9 dígitos";
} else {
  $phone = $_REQUEST['phone'];
}

if (count($errors) === 0) {

  $to = 'pimpoyolega@gmail.com'; //Direccion de correo provisional para pruebas
  $title = 'SOLICITUD: deseo información de ' . $etapa;

  $message = '
<html>
<head>
  <title>' . $title . '</title>
</head>
<body>
  <p>Deseo información sobre ' . $etapa  . '</p>
  <p>Mi nombre: ' . $name  . '</p>
  <p>Mi email: ' . $email  . '</p>
  <p>Mi teléfono: ' . $phone . '</p>
</body>
</html>
';

  // Para enviar un correo HTML, debe establecerse la cabecera Content-type
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // headers adicionales
  $headers .= $to . "\r\n";
  $headers .= 'From: Landing page <aravacalanding@aravaca.com>' . "\r\n";

 // mail($to, $title, $message, $headers);
  die("{\"ok\": true}");
} else {

  $errors["ok"] = false;
  $json = json_encode($errors);
  die($json);
}


?>
