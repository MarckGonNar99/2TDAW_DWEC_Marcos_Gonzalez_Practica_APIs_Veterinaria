<?php //configura los datos de tu cuenta
include "functions.php";
include "config.php";

$conexion=conectarBD($dbhost,$dbuser,$dbpass);

// $sentencia=$conexion->prepare("DROP DATABASE IF EXISTS $dbname");
// $sentencia->execute();
echo "Base de datos anterior borrada<br>-------------------------<br>";

$sentencia=$conexion->prepare("CREATE DATABASE IF NOT EXISTS $dbname");
$sentencia->execute();
echo "Base de datos nueva creada<br>-------------------------<br>";

$conexion->select_db($dbname);

echo "Base de datos seleccionada <br>-------------------------<br>";

$sentencia=$conexion->prepare("CREATE TABLE IF NOT EXISTS noticias(
                            id INTEGER(4) AUTO_INCREMENT,
                            titulo VARCHAR(50),
                            contenido VARCHAR(500),
                            imagen VARCHAR(500),
                            fecha_publicacion DATE,
                            PRIMARY KEY(id));");
$sentencia->execute();
echo "Tabla creada correctamente<br>-----------------------------------------<br>";

$sentencia=$conexion->prepare("INSERT INTO noticias VALUES 
                     (1,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01'),
                      (2,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01'),
                      (3,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01'),
                      (4,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01'),
                      (5,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01'),
                      (6,'Huevo de dinosaurio conservado revela un rasgo evolutivo desconocido',
                      'Un raro embrión de dinosaurio ovorraptosaurio sugiere una postura dentro del huevo que hasta la fecha solo se había atribuido a las aves<br />',
                      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBQK9VFSMeyAsKUwFPe4Oyom14UP7DeqD53A&usqp=CAU', '2022-01-01');");
$sentencia->execute();

echo "Datos insertados correctamente<br>--------------------------------------<br>";

header( "refresh:3;url=./noticias.php" );
?>