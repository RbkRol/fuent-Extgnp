<?php
//Recibir datos del formulario
$nombreAdmin = $_POST['admiName'];
$contrasenia = $_POST['adminPass'];

// Validar datos que vienen en el formulario
if(isset($nombreAdmin)){

    //Establecer conexion con BD
    include ('conexion.php');

    $con = conectar();

    //Consultar si los datos existen en la BD
    $query = "SELECT * FROM admin WHERE correo='$nombreAdmin' AND passwd='$contrasenia'";
    $resultado = mysqli_query($con, $query);
    if(!$resultado){
              echo "Administrador no registrado"; 
    }else{
        $num_registros = $resultado->num_rows;
        if($num_registros >0){
            // Guardar datos del admin en un arreglo
            $datosAdmin = mysqli_fetch_array($resultado);
        
             // Iniciar sesion
             session_start();
        
             // Declarar variables de sesion
             $_SESSION["adminAutentico"] = true; // guarda la sesion activa
             $_SESSION["nombreAdmin"] = $datosAdmin['correo'];
             // Verificar que el nombre del admin no esté vacío
             //print $datosAdmin['correo'];
             //print $query;
             // Dirigir a la página si las credenciales son buenas
             header("Location: ../herramientaAdmin.php");
        }else{
            //print_r ("no se encontro");
            header("Location: ../index.php?error=si");
        }
    }    

}else{
    // Regresar al login por credenciales erróneas
    header("Location: ../index.php?error=si");
}

?>

