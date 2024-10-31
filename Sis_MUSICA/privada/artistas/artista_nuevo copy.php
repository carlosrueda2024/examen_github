<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='js/validacion_artistas.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1>INSERTAR NUEVO ARTISTA</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                     FROM generos
                     WHERE estado = 'A'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='artista_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Generos</th>
                    <td>
                      <select name='id_genero'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_genero']."'>".$fila['genero']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre Artista</b></th>
                    <td><input type='text' name='nombre' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Nombre Artistico</b></th>
                    <td><input type='text' name='nombre_artistico' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)pais</b></th>
                    <td><input type='text' name='pais' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Fecha Creacion</b></th>
                    <td><input type='date' name='fec_creacion' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                    <input type='button' value='ACEPTAR' onclick='validar();' >
                    <input type='reset' value='CANCELAR' >
                    <h4>(*)datos obligatorios</h4>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>