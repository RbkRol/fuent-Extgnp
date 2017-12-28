<?php
include("conexion.php");

$conexion=conectar();

if(!$conexion){
    die("No se puede establecer la conexión con la base de datos");

}else{
    $usRfc = $_REQUEST["rfc"];
    $usrNombre = $_REQUEST["nombre"];
    $usrEmpresa = $_REQUEST["prov"];
    $usrCorreo = $_REQUEST["mail"];
    $usrPass = $_REQUEST["pwd"];
    $usrEstatus = $_REQUEST["estatus"];
    $usrATC= $_REQUEST["nvoATC"];
    $usrCPM= $_REQUEST["nvoCPM"];
    $usrSA= $_REQUEST["nvoSA"];

    // Validar que los campos no estén vacíos
    if(empty ($_REQUEST["rfc"]) || empty($_REQUEST["nombre"]) || empty($_REQUEST["prov"]) || empty($_REQUEST["mail"]) || empty($_REQUEST["pwd"]) ){
        echo "Es necesario que todos los campos tengan datos";

    }else{
        if($usrEstatus=="true"){
            $usrEstatus=1;
        }else{
            $usrEstatus=0;
        }
    
        if($usrATC=="true"){
            $usrATC=1;
        }else{
            $usrATC=0;
        }
    
        if($usrCPM=="true"){
            $usrCPM=1;
        }else{
            $usrCPM=0;
        }
    
        if($usrSA=="true"){
            $usrSA=1;
        }else{
            $usrSA=0;
        }
    
        $sql = "INSERT INTO usr VALUES ('$usRfc', '$usrNombre', '$usrEmpresa', '$usrCorreo', '$usrPass', '$usrEstatus', '$usrATC', '$usrCPM', '$usrSA')";
        $resultado=mysqli_query($conexion, $sql );
    
        $sql_consulta = "SELECT * FROM usr";
        $consulta = mysqli_query($conexion, $sql_consulta);
    
        if($resultado){
            echo "Registro insertado con éxito!";

        }else{
            //echo "El registro no se efectuó";
        }
    
        while($row = mysqli_fetch_row($consulta)){
            // Columna Activo
            if($row[5]==0 ){
                //echo "Usuario inactivo";
                $usr_activo = "<input id='activo".$row[0]."' class='form-check-input' type='checkbox' disabled>";
            }else{
                    $usr_activo = "<input id='activo".$row[0]."' class='form-check-input' type='checkbox' checked  disabled>";
                }
            // Columna ATC
            if($row[6]==0){
                $atc = "<label><input id='atc".$row[0]."' class='form-check-input' type='checkbox' disabled >ATC</label>";
            }else{
                $atc = "<label><input id='atc".$row[0]."' class='form-check-input' type='checkbox' checked disabled >ATC</label>";
            }
            // Columna CPM
            if($row[7]==0){
                $cpm = "<label><input id='cpm".$row[0]."' class='form-check-input' type='checkbox' disabled >CPM</label>";
            }else{
                $cpm = "<label><input id='cpm".$row[0]."' class='form-check-input' type='checkbox' checked disabled >CPM</label>";
            }
            //Columna SA
            if($row[8]==0){
                $sa = "<label><input id='sa".$row[0]."' class='form-check-input' type='checkbox' disabled >SA</label>";
            }else{
                $sa = "<label><input id='sa".$row[0]."' class='form-check-input' type='checkbox' checked disabled >SA</label>";
            }
            
            echo "<tr id='toEdit-".$row[0]."'><td style='vertical-align: middle;'>$row[0]</td>
                <td id='nombre".$row[0]."' style='vertical-align: middle;'>$row[1]</td>
                <td id='prov".$row[0]."' style='vertical-align: middle;'>$row[2]</td>
                <td id='correo".$row[0]."' style='vertical-align: middle;'>$row[3]</td>
                <td id='pwd".$row[0]."' style='vertical-align: middle;'>$row[4]</td>
                <td style='vertical-align: middle;'>$usr_activo</td>
                <td>
                    <button id='".$row[0]."' class='btn colorcito editar' >
                        <span class='glyphicon glyphicon-pencil' style='color: rgb(0,70,129); font-size: 10pt;'></span>
                    </button>
                    <button id='".$row[0]."' class='btn colorcito ".$row[0]."' disabled >
                        <span class='glyphicon glyphicon-floppy-disk' style='color: rgb(0,70,129); font-size: 10pt;'></span>
                    </button>
                </td>
                <td>
                    $atc
                    $cpm
                    $sa
                </td>
    
            </tr>";
            }
        mysqli_close($conexion);

    }
}
?>