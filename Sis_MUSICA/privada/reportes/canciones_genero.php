<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html>
    <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
        <script type='text/javascript'>
            function validar() {
                genero = document.formu.genero.value;
                if (document.formu.genero.value == '') {
                    alert('Seleccione el genero');
                    document.formu.genero.focus();
                    return;
                }
                ventanaCalendario = window.open('canciones_genero1.php?genero='+ genero , 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
            }
        </script>
    </head>
    <body>
        <p></p>
        <h1>REPORTES DE CANCIONES CON GENERO</h1>
        <form method='post' name='formu'>";
        
        /*Consulta para seleccionar unicamente los generos que tinenen al menos una cancion */
        $sql2 = $db->Prepare(" SELECT CONCAT_WS(' ', g.nombre) as genero, g.id_genero
                    FROM generos g
                    JOIN canciones c ON g.id_genero = c.id_genero
                    WHERE g.estado = 'A'
                    GROUP BY g.id_genero
                    HAVING COUNT(c.id_cancion) > 0
                    ");
        $rs2 = $db->GetAll($sql2);


echo"<center>
<table border='1'>
    <tr>
        <th><h2>*Seleccione genero </th></th></th>
    <td>
        <select name='genero'>
        <option value=''>--Seleccione--</option>
        <option value='T'>Todos</option>";
        foreach ($rs2 as $k => $fila) {
        echo"<option value='".$fila['id_genero']."'>".$fila['genero']."</option>";    
        }  
        echo"</select>
    </td>
    </tr>
    <tr>
        <td align='center' colspan='6'>
            <input type='hidden' name='accion' value=''>
            <input type='button' value='Aceptar' onclick='validar();' ' class='boton2'>
        </td>
    </tr>
</table>
</form>
</center>";
echo "</body>
    </html> ";
?>