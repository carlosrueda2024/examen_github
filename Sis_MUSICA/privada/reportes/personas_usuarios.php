<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script type='text/javascript'>
        var ventanaCalendario=false;
            function imprimir() {
                ventanaCalendario=window.open('personas_usuarios1.php', 'calendario', 'width=600, height=500, left=150, top=100, scrollbars=yes, menubars=no, statusbar=NO, status=NO, resizable=yes, location=NO');
            }
            </script>
            <script type='text/javascript'>
            var ventanaCalendario=false;
                function generar_pdf() {
                    ventanaCalendario=window.open('personas_usuarios_pdf.php', 'calendario', 'width=600, height=500, left=100, top=100, scrollbars=yes, menubars=no, statusbar=NO, status=NO, resizable=yes, location=NO');
                }
             </script>
         </head>
       <body>
       <p> &nbsp;</p>
       <h1>REPORTE DE PERSONAS CON USUARIOS</h1>";
// aqui iva la consulta
$sql = $db->Prepare("SELECT * FROM vista_per_usu");
$rs = $db->GetAll($sql);

if ($rs) {
    echo "<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PERSONAS</th><th>NOMBRE DE USUARIO</th>
                </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['persona']."</td>
                <td>".$fila['usuario_principal']."</td>
              </tr>";
        $b++;
    }
    echo "</table>
             <h2>
                <input type='radio' name='seleccionar' onclick='javascript:imprimir()'>Imprimir
            </h2>
            <h2>
                <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()'>Generar pdf
            </h2>
          </center>";
}
echo "</body>
      </html>";
?>
