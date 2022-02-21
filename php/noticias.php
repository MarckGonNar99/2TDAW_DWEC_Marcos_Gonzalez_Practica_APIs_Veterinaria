<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Noticias</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="../estilos/estilos.css">
 <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="toast.js"></script>
<script type="text/javascript" src="app.js" defer></script>
</head>
<body>
<?php
      require('./funciones.php');
      if(isset($_COOKIE['mantener'])){
        session_decode($_COOKIE['mantener']);
      }

      if(isset($_SESSION['dni'])){
        if($_SESSION['dni']==='00000000A'){
          $r1=".";
          $e1="../";
          $e2=".";
          $conexion=conexion();
          echo insertar_cab($r1);
          echo insertar_nav($e1,$e2);


          echo'
          <main>
            <table>
                <thead>
                    <th>Título</th>
                    <th>Cuerpo</th>
                    <th>Foto</th>
                    <th>Fecha</th>
                </thead>
                <tbody class="lista_noticias">
                </tbody>
            </table>
          ';

          echo'
          <section>
            <form method="post" enctype="form-data" id="nuevo">
              <label for="titulo">Título</label>
              <input type="text" id="titulo" name="titulo"><br>
              <label for="contenido">Texto noticia</label>
              <input type="text" id="contenido" name="contenido">
              <label for="imagen">URL noticia</label>
              <input type="text" id="imagen" name="imagen">
              <input type="date" name="fecha" id="fecha">

              <input type="submit" name="insertar" id="insertar" value="Insertar">
            </form>
          </section>
          ';

        }else{
         echo"<h3 class='error'>ERROR: No tiene acceso a esta página</h3>";
         echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:../index.php">';
        }
       }else{
        echo"<h3 class='error'>ERROR: No tiene acceso a esta página</h3>";
        echo'<META HTTP-EQUIV="REFRESH"CONTENT="2;URL=http:login_registro.php">';
       }
?>

</body>
</html>