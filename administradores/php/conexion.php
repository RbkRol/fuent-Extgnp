<?php
function conectar(){
	/*
	$host = "35.193.154.149";
	$user="root";
	$pass="root";
	$db="proveedores";
	$port =3306;
	$socket="/cloudsql/proveedores-ext:us-central1:insprovext";
	*/
	$con=mysqli_connect(null,"root","root","proveedores",null,"/cloudsql/gnp-fuentes-ext-proveedores:us-central1:ins-gnp-fuentext") or die ("Error al conectar a la base de datos".mysqli_error());
	#mysqli_select_db($con,$db);
	return $con;
}
?>