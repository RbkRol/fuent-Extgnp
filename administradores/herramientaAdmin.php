<?php
include('php/sesion.php');
// imprimir nombre del admin
$autentico = $_SESSION["nombreAdmin"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/style.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/js/jquery.dataTables.min.css">
    <title>Admin login</title>
    <style type="text/css">
        /*Estilos de la página*/
        .container {
            margin-top: 30pt;
            padding-top: 30pt;
            padding-left: 3%;
            padding-bottom: 30pt;
            padding-right: 3%;
            line-height: 16pt;
            background-color: white;
            box-shadow: 5pt 10pt 10pt rgb(213, 218, 229);
        }

        .titulo {
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(23, 36, 52);
            font-size: 16pt;
            text-align: justify;
        }

        .subtitulo {
            color: rgb(23, 36, 52);
            text-align: justify;
            margin-bottom: 2%;
        }

        .colorcito{
            background-color: white; 
            border-color: rgb(201,201,217);
        }

        .colorcito:hover{
            background-color: #fcd4c6ce;
            border-color: #fcd4c6ce;
        }

        .colorcito:select{
            border-color: rgb(249,250,252);
        }

        .colorcito:focus {
            outline: 0;
            background-color: #fff;
            box-shadow: 0 0 0 0.2rem #ff570a;
            color: white;
            
        }

        .propio {
            border-radius: 50px;
            width: 50px;
            height: 50px;
            color: #fff;
        }

        .propio:focus {
            color: #fff;
            border: 0;
            outline: 0 none;
        }

        .add-header-color{
            color: #fff;
            text-align: center;
            background-color: ;
        }

    </style>
</head>

<body class="body-tool">
    <header>
        <div class="primer-contenedor">
            <img class="logo" src="img/gnPicono.png" alt="GNPlogo">
            <div id="vertical-bar"></div>
        </div>

        <label>Administrador de Proveedores GNP</label>

        <div class="cerrar-sesion" id="cerrar-sesion">
            <?php echo "<p>$autentico</p>" ?>
            <img class="sesionL" src="img/cerrarSesioN.png">
            <a href="php/salir.php"> Cerrar sesión</a>
        </div>

        <div class="linea" id="linea" hidden>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="titulo">
                    Lista de Usuarios
                </div>
                <div class="subtitulo">Administrador de archivos</div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn btn-primary" id="agregar" >Agregar usuario</button>
            </div>
        </div>
        <br>
        <table id="datos" class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center">RFC</th>
                    <th style="text-align: center">Nombre</th>
                    <th style="text-align: center">Proveedor</th>
                    <th style="text-align: center">Correo</th>
                    <th style="text-align: center">Password</th>
                    <th style="text-align: center">Activo</th>
                    <th style="text-align: center">Acciones</th>
                    <th style="text-align: center">Permisos</th>
                </tr>
            </thead>
            <tbody id="editar" style="text-align: center">
                <?php
                include_once 'php/consultaUsuarios.php';
                ?>
            </tbody>
            </table>
        
    </div>
    <div class="texto">Consulta nuestro aviso de privacidad en www.gnp.com.mx</div>
    <footer>
        <img class="footer-logo" src="img/slogan.png" alt="Vivir es increíble">
        <img class="express-logo" src="img/iconoDe2.png" alt="logoExpress">
    </footer>

    <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#datos").DataTable({
                scrollY: '330pt',
                scrollCollapse: true,
                language: {
                    url: 'bootstrap-3.3.7-dist/js/Spanish.json'
                }
            });

            $(document).on("click", ".actualizar", function(evento){
                var id = $(this).attr("id");
                var nombre = $("#nombre" + id).text();
                var prov = $("#prov" + id).text();
                var correo = $("#correo" + id).text();
                var pwd = $("#pwd" + id).text();
                var activo = document.getElementById("activo" + id).checked;
                var atc = document.getElementById("atc" + id).checked;
                var cpm = document.getElementById("cpm" + id).checked;
                var sa = document.getElementById("sa" + id).checked;
                //console.log(id + " " + nombre + " " + prov + " " + correo + " " + pwd + " " + activo + " " + atc + " " + cpm + " " + sa)

                // La validación del email, parte dominio se hace para 2 y 3 letras
                expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                // AJAX CON JS! SIN JQUERY

                if( (nombre === "" || prov === "" || correo === "" || pwd ==="") || (!expr.test(correo)) ){
                    alert("Favor de llenar todos los campos y de proporcionar un correo válido");
                }else{
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById("toEdit-" + id).innerHTML = "" + this.responseText;
                        }
                    };
                    // Métodos. Ver el parametro false para respuesta asincrona
                    xhttp.open("POST", "php/update.php?rfc="+id+"&nombre="+nombre+"&empresa="+prov+"&correo="+correo+"&pwd="+pwd+"&status="+activo+"&p_atc="+atc+"&p_cpm="+cpm+"&p_sa="+sa );
                    xhttp.send();
                    alert("Registro actualizado");
                }
            });

            conta = 0;
            $(document).on("click", ".editar", function(evento){
                //alert(id);
                // Evitar editar multiples filas a la vez
                if(conta >0){

                    if(id!=$(this).attr("id")){
                        // alert(id);
                        // viejo id ponerle un false para editar la fila correcta
                        $("#nombre" + id).attr("contenteditable", "false");
                        $("#prov" + id).attr("contenteditable", "false");
                        $("#correo" + id).attr("contenteditable", "false");
                        $("#pwd" + id).attr("contenteditable", "false");
                        
                        // quitar color...
                        $("#nombre" + id).removeClass("border border-info");
                        $("#prov" + id).removeClass("border border-info");
                        $("#correo" + id).removeClass("border border-info");
                        $("#pwd" + id).removeClass("border border-info");
                        $("." + id).removeClass("actualizar");
                        $("." + id).attr("disabled", "true");
                        $("#activo" + id).attr("disabled", "true");
                        $("#atc" + id).attr("disabled", "true");
                        $("#cpm" + id).attr("disabled", "true");
                        $("#sa" + id).attr("disabled", "true");
                        // alert("viejo id: " + id + " nuevo id: " + $(this).attr("id"));
                    }
                }
                conta++;
                // Editar la fila correspondiente al pulsar su boton
                id = $(this).attr("id");
                var c = document.getElementById("activo" + id);
                // alert("Editando!! " + id + c);
                console.log("Valor: " + c);
                $("." + id).addClass("actualizar");
                $("." + id).removeAttr("disabled");
                $("#nombre" + id).attr("contenteditable", "true");
                $("#prov" + id).attr("contenteditable", "true");
                $("#correo" + id).attr("contenteditable", "true");
                $("#pwd" + id).attr("contenteditable", "true");
                $("#activo" + id).removeAttr("disabled");
                $("#atc" + id).removeAttr("disabled");
                $("#cpm" + id).removeAttr("disabled");
                $("#sa" + id).removeAttr("disabled");
                
                // Añadir color al editar...
                $("#nombre" + id).addClass("border border-info");
                $("#prov" + id).addClass("border border-info");
                $("#correo" + id).addClass("border border-info");
                $("#pwd" + id).addClass("border border-info");
                $("#activo" + id).addClass("border border-info");
            });

            // Contador para validar la inserción de registros
            cont_nvo = 0;
            
            $(document).on("click", "#agregar", function(){
                if(cont_nvo >0){
                    // Hacer nada
                }else{
                    var nva_fila = "<tr>";
                    nva_fila += "<td id='nvo_rfc' contenteditable class='border border-info'></td>";
                    nva_fila += "<td id='nvo_name' contenteditable class='border border-info'></td>";
                    nva_fila += "<td id='nvo_prov' contenteditable class='border border-info'></td>";
                    nva_fila += "<td id='nvo_mail' contenteditable class='border border-info'></td>";
                    nva_fila += "<td id='nvo_pwd' contenteditable class='border border-info'></td>";
                    nva_fila += "<td class='border border-info'><input id='nvo_activo' class='form-check-input' type='checkbox' checked disabled></td>";
                    nva_fila += "<td><button class='btn colorcito insertar'><span class='glyphicon glyphicon-floppy-disk' style='color: rgb(0,70,129); font-size: 10pt;' ></span></button></td>";
                    nva_fila += "<td><label><input id='nvo_atc' class='form-check-input' type='checkbox' checked disabled >ATC</label>";
                    nva_fila += "<label><input id='nvo_cpm' class='form-check-input' type='checkbox' checked disabled >CPM</label>";
                    nva_fila += "<label><input id='nvo_sa' class='form-check-input' type='checkbox' checked disabled >SA</label></td>";
                    nva_fila += "</tr>";

                    $("#editar").append(nva_fila);
                    $(this).focus().select();
                }
                cont_nvo++;
            });

            $(document).on("click", ".insertar", function(){
                nvo_rfc = $("#nvo_rfc").text();
                nvo_name = $("#nvo_name").text();
                nvo_prov = $("#nvo_prov").text();
                nvo_mail = $("#nvo_mail").text();
                nvo_pass = $("#nvo_pwd").text();
                nvo_stte = document.getElementById("nvo_activo").checked;
                nvo_atc = document.getElementById("nvo_atc").checked;
                nvo_cpm = document.getElementById("nvo_cpm").checked;
                nvo_sa = document.getElementById("nvo_sa").checked;

                nvo_rfc = nvo_rfc.toUpperCase();
                //alert("rfc: " + nvo_rfc);

                // La validación del email, parte dominio se hace para 2 y 3 letras
                expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                
                if(!expr.test(nvo_mail) ){
                    // expresion verdadera
                    alert("La dirección de correo no es válida");
                    // Inicializar de nuevo el mail
                    nvo_mail = "";
                }else if( nvo_rfc ==="" || nvo_name ==="" || nvo_prov === "" || nvo_mail === "" || nvo_pass === "" ){
                    //expresion verdadera
                    alert("Favor de llenar todos los campos");
                }
                else{
                    // si ambas expresiones son falsas, entra aqui
                    //alert("Correo válido: " + nvo_mail);
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status ==200){
                            $("#editar").html(this.responseText);
                        }
                    };
                    xhttp.open("POST", "php/insertar.php?rfc="+nvo_rfc+"&nombre="+nvo_name+"&prov="+nvo_prov+"&mail="+nvo_mail+"&pwd="+nvo_pass+"&estatus="+nvo_stte+"&nvoATC="+nvo_atc+"&nvoCPM="+nvo_cpm+"&nvoSA="+nvo_sa );
                    xhttp.send();
                    alert("Registro agregado");
                }
            });
        });
    </script>
</body>
</html>