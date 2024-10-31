<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Música</title>
  <link rel="stylesheet" href="css/estilos_ingresar.css">
</head>
<body>
  <div id="div-results">
    <div class="banner">SISTEMA DE MÚSICA</div>
    <button onclick="location.href='../index.html';" class="botoon botoon-regresar">
    <span class="icono-casita"></span> Regresar
    </button>
    <form action="validar.php" method="post" autocomplete="off">
      <div class="formu_ingreso">        
        <p><h2>Ingresar al Sistema</h2></p>
        <p><h2>Login:</h2> <input type="text" name="nick" size="11" value="" class="limpiar"></p>        
        <p><h2>Clave:</h2><input type="password" name="password" size="11" value=""></p>      
        <input type="submit" name="accion" value="Ingresar" size="5" class="boton" id="btn1">          
      </div> 
    </form>  
  </div>
</body>
</html>

