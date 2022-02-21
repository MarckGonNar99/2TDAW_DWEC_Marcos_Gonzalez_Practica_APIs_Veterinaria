<?php
    //sleep(2);   
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    include "functions.php";
    include "config.php";
    
    //PARA SIMULAR EL RETARDO DEL SERVIDOR
    sleep(1);  
    $conexion=conectarBD($dbhost,$dbuser,$dbpass);
    $conexion->select_db($dbname);
    
    //EL IF ES PARA PROBARLO A MANO
    //EN TEORIA EL FORMULARIO COMPRUEBA QUE LOS DATOS SON CORRECTOS 

    if(isset($_REQUEST['Titulo']) && 
       isset($_REQUEST['Contenido']) && 
       isset($_REQUEST['imagen']) && 
       isset($_REQUEST['Fecha_publicacion'])){

      	$Titulo = $_REQUEST['titulo'];
        $Contenido = $_REQUEST['contenido'];
        $imagen = $_REQUEST['imagen'];
        $Fecha_publicacion= $_REQUEST['fecha_publicacion'];
        
        $sentencia=$conexion->prepare("INSERT INTO 
                                            NOTICIAS 
                                            VALUES (null, ?,?,?,?);");
        $sentencia->bind_param("ssss",$Titulo,
                                       $Contenido,
                                       $imagen,
                                       $Fecha_publicacion);
        
        $sentencia->execute();
        $filas_afectadas = $sentencia->affected_rows;
        
    	if($filas_afectadas == 1){
           echo "$conexion->insert_id";
        }else{
           echo "false";
        }
        
    }else{
    	echo "false";
    }

   
 ?>
