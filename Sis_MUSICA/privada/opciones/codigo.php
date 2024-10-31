<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
$db->debug=true;

$sql = $db->Prepare("SELECT *
                     FROM grupos
                     WHERE estado = 'A'
                    ");
$rs = $db->GetAll($sql);

echo "<html>
      <head>
          <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
          <script type='text/javascript' src='../../ajax.js'></script>
          <script type='text/javascript' src='js/buscar_opciones.js'></script>
          <script type='text/javascript' src='js/buscar_opciones1.js'></script>
      </head>
      <body>
      <p> &nbsp;</p>";
echo "
<!-- ------INICIO BUSCADOR -------------- -->
      <center>
          <h1>LISTADO DE OPCIONES</h1>
          <b><a href='opcion_nuevo.php'>Nueva Opción</a></b>
          <form action='#' method='post' name='form'>
              <table border='1' class='listado'>
                  <tr>
                      <th>
                          <b>Grupo</b><br />
                          <input type='text' name='grupo' value='' size='10' onkeyUp='buscar_opciones()'>
                      </th>
                      <th>
                          <b>Opción</b><br />
                          <input type='text' name='opcion' value='' size='10' onkeyUp='buscar_opciones()'>
                      </th>
                  </tr>
              </table>
          </form>
      </center>
      <!-- ------FIN BUSCADOR -------------- -->
";

echo "
<!-- ------INICIO BUSCADOR -------------- -->
      <center>
          <form action='#' method='post' name='formu2'>
              <table border='1' class='listado'>
                  <tr>
                      <th>
                          <b>Grupo</b><br />
                          <select onchange='buscar_opciones1()' name='grupo1'>
                              <option value=''>--Seleccione--</option>";
foreach ($rs as $fila) {
    echo "<option value='".$fila['grupo']."'>".$fila['grupo']."</option>";
}
echo "                      </select>
                      </th>
                      <th>
                          <b>Opción</b><br />
                          <input type='text' name='opcion1' value='' size='10' onkeyUp='buscar_opciones1()'>
                      </th>
                  </tr>
              </table>
          </form>
      </center>
      <!-- ------FIN BUSCADOR -------------- -->
";

echo "<div id='opciones1'>";
contarRegistros($db, "opciones");

paginacion("opciones.php");

$sql3 = $db->Prepare("SELECT g.*, o.*
                      FROM grupos g, opciones o
                      WHERE g.id_grupo = o.id_grupo
                      AND g.estado <> 'X'
                      AND o.estado <> 'X'
                      ORDER BY o.id_opcion DESC
                      LIMIT ? OFFSET ?
");

$rs = $db->GetAll($sql3, array($nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
    <tr>
        <th>Nro</th><th>GRUPO</th><th>OPCIÓN</th><th>CONTENIDO</th>
        <th><img src='../../../imagenes/modificar.gif'></th><th><img src='../../../imagenes/borrar.jpeg'></th>
    </tr>";
    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;
    foreach ($rs as $fila) {
        echo "<tr>
           <td align='center'>".$b."</td>
           <td>".$fila['grupo']."</td>
           <td>".$fila['opcion']."</td>
           <td>".$fila['contenido']."</td>
           <td align='center'>
               <form name='formModif".$fila['id_opcion']."' method='post' action='opcion_modificar.php'>
               <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
               <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>
               <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar opcion Sistema'>
                   Modificar>>
               </a>
               </form>
           </td>
           <td align='center'>
               <form name='formElimi".$fila['id_opcion']."' method='post' action='opcion_eliminar.php'>
               <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
               <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar opcion Sistema'
                  onclick='return(confirm(\"Desea realmente eliminar la opción ".$fila['opcion']."?\"))'>
                   Eliminar>>
               </a>
               </form>
           </td>
       </tr>";
       $b = $b + 1;
    }
    echo "</table>
    </center>";
}

mostrar_paginacion();
echo "</div>";
echo "</body>
   </html>";
?>
