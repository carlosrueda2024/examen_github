
<?php
//session_start();

//$nElem = ((int)$_SESSION["sesion_valor"]);
$nElem = 5; /*Cantidad de registros*/
$nBotones = 3;  /*Cantidad de secciones*/
$posBoton = 1; /*Que los numeros de la paginacion vayan de  1 en 1*/

function paginacion ($vinc) {
  global $nElem;
  global $nPags;
  global $pag;
  global $posBoton;
  global $nBotones;
  global $paginas;
  global $urlnext;
  global $urlback;

   if (isset($_GET["posBoton"])) {
      $posBoton = $_GET["posBoton"];
   }
  if ($pag == $posBoton ) {
       $posBoton = ($pag == 1)? $posBoton : $posBoton - 1;
   }
  if ($pag == ($posBoton + $nBotones - 1)) {
	   $posBoton = (($posBoton + $nBotones - 1) == $nPags)? $posBoton : $posBoton + 1;
   }
  if ($nPags > 1) {
        $paginas = array();
        for ($i = $posBoton; $i < $pag; $i++){       
             $paginas[$i]["npag"] = $i;
             $paginas[$i]["pagV"] = "{$vinc}pag = $i";
        }
        $paginas[$pag]["npag"]=$pag;
                 
        if ($pag <> 1) {
            $i = $pag - 1;
            $urlback = "{$vinc}pag=$i&posBoton=$posBoton";            
        }
        for ($i = $posBoton; $i < $posBoton + $nBotones && $i <= $nPags; $i++) {
             $paginas[$i]["npag"] = $i;
             $paginas[$i]["pagV"] = "{$vinc}pag=$i&posBoton=$posBoton";             
        }
        if ($pag < $nPags) {
            $i = $pag + 1;
            $urlnext = "{$vinc}pag=$i&posBoton=$posBoton";            
        }                
    }
}

//$pag = $_GET["pag"];
isset($_GET["pag"])? $pag=$_GET["pag"]: $pag="";

function contarRegistros($db, $tabla) { 
 global $nElem;
 global $nPags;
 global $pag;
 global $regIni;
	if (!empty($tabla)) {
        $sqla = $db->Prepare("SELECT *
                             FROM INFORMATION_SCHEMA.COLUMNS
                             WHERE TABLE_SCHEMA='bd_sis_musica' 
                             AND COLUMN_NAME = 'estado' AND TABLE_NAME = '$tabla'
                             ");
        $rsa = $db->GetAll($sqla);
       
        if ($rsa){
		$sql = $db->Prepare("SELECT count(*) as num 
					  FROM "."$tabla"." 
					  WHERE estado <> 'X'
                    ");
		$rs = $db->GetAll($sql);	
        } else{
            $sql = $db->Prepare("SELECT count(*) as num 
					  FROM "."$tabla"." 
					  
                    ");
		$rs = $db->GetAll($sql);	
        }
		if ($rs) {
            $total =  $rs[0]["num"];

            $nPags = ceil((float)$total / (float)$nElem);
            if (empty($pag))
	            $pag = 1;
            elseif ($pag > $nPags) 
                    $pag = $nPags;
            $regIni = ($pag - 1) * $nElem;
			return $regIni;
		} else {
			return $regIni = 0;
		}
	} else
		return $regIni = 0;
}
function mostrar_paginacion(){
  global $nPags;
  global $pag;
  global $nBotones;
  global $paginas;
  global $urlnext;
  global $urlback;

  echo "<!-- PAGINACION-->";
  echo "<div class='paginacion'>";
  if(!empty($urlback)){
      echo "<a href='".$urlback."' class='paginacion-btn'>&laquo; Anterior</a>";
  }
  if(!empty($paginas)){
      foreach ($paginas as $k => $pagg){
          if($pagg["npag"] == $pag){
              echo "<span class='paginacion-num activo'>".$pagg["npag"]."</span>";
          } else {
              echo "<a href='".$pagg["pagV"]."' class='paginacion-num'>".$pagg["npag"]."</a>";
          }
      }
  }
  if(($nPags > $nBotones) && !empty($urlnext) && ($pag < $nPags)){
      echo "<a href='".$urlnext."' class='paginacion-btn'>Siguiente &raquo;</a>";
  }
  echo "</div>";
  echo "<!-- PAGINACION-->";
}

?>