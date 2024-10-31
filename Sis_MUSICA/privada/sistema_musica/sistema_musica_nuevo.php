<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='js/validacion_generos.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";
              
       echo"<h1>INSERTAR GENERO </h1>";

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='genero_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Nombre</b></th><td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Año Origen</b></th>
                    <td><input type='number' name='anio_origen' min='1900' max='2024' step='1' onkeydown='return false'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'> 
                      <h4>(*)datos obligatorios</h4>
                      <input type='button' value='ACEPTAR' onclick='validar();' >
                      <input type='reset' value='CANCELAR' >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>