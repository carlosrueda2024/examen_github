<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
$db->debug=true;

$id_proveedor = $_POST["id_proveedor"];


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       
         echo"<h1>MODIFICAR PROVEEDOR</h1>";

$sql = $db->Prepare("SELECT *
                     FROM proveedores
                     WHERE id_proveedor = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_proveedor));
 /*  if ($rs) {*/
  foreach ($rs as $k => $fila) {  
        echo"<form action='proveedor_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombre"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telef' size='10' value='".$fila["telef"]."'></td>
                  </tr>
                  <tr>
                  <th><b>(*)Correo</b></th>
                  <td><input type='mail' name='correo' size='10' value='".$fila["correo"]."'></td>
                </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR PROVEEDOR'  >
                      <input type='hidden' name='id_proveedor' value='".$fila["id_proveedor"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/
}
echo "</body>
      </html> ";

 ?>