<?php
/* 
Validar que la sesion esté activa. Importante incluir.
Se verifica cada variable creada en ctrlAcceso.php y cuando el valor ya no coincida,
se redirige a la salida de sesión: salir.php. La sesion dura 20 min.
*/
session_start();
if(!$_SESSION["adminAutentico"]){
   header("Location: php/salir.php");
   //print "Hola";
}
?>