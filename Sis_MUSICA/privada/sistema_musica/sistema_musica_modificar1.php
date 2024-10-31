<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_sistema_musica = $_POST["id_sistema_musica"];
$nombre = $_POST["nombre"];
$logotipo = $_FILES["logotipo"]["name"];
$logotipo_tmp = $_FILES["logotipo"]["tmp_name"];

// Verificar si el nombre no está vacío
if ($nombre != "") {
    if ($logotipo != "") {
        // Establecer el directorio de subida
        $upload_dir = "C:/wamp64/www/PAGINA/Sis_MUSICA/privada/tienda_ropa/logos/";
        
        // Crear el directorio si no existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Definir la ruta completa del archivo
        $upload_file = $upload_dir . basename($logotipo);

        // Mover el archivo subido a la ubicación deseada
        if (move_uploaded_file($logotipo_tmp, $upload_file)) {
            $logotipo = basename($logotipo); // Usar solo el nombre del archivo para almacenar en la base de datos
        } else {
            // Manejar el error si la carga del archivo falla
            $logotipo = ""; // Aquí puedes decidir qué hacer si falla la subida del archivo
        }
    } else {
        // Recuperar el valor actual de logotipo si no se sube un nuevo archivo
        $sql = "SELECT logotipo 
        FROM sistema_musica 
        WHERE id_sistema_musica = ?";
        $stmt = $db->Prepare($sql);
        $rs = $db->Execute($stmt, array($id_sistema_musica));
        if ($rs && !$rs->EOF) {
            $logotipo = $rs->fields["logotipo"];
        }
    }

    $reg = array();
    $reg["nombre"] = $nombre;
    $reg["logotipo"] = $logotipo;
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];

    $rs1 = $db->AutoExecute("sistema_musica", $reg, "UPDATE", "id_sistema_musica='" . $id_sistema_musica . "'");
    header("Location: sistema_musica_modificar.php");
    exit();
} else {
    require_once("../../libreria_menu.php");
    echo "<div class='mensaje'>";
    $mensaje = "NO SE MODIFICARON LOS DATOS DEL SISTEMA";
    echo "<h1>" . $mensaje . "</h1>";
    echo "<a href='sistema_musica_modificar.php'>
            <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
          </a>";
    echo "</div>";
}

echo "</body>
      </html>";
?>
