<?php

namespace gestionConcurso\caracterizaConcurso\funcion;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("index.php");
	exit ();
}
class redireccion {
	public static function redireccionar($opcion, $valor = "") {
		$miConfigurador = \Configurador::singleton ();
		//$miPaginaActual = $miConfigurador->getVariableConfiguracion ( "pagina" );
       	$miPaginaActual="caracterizaConcurso";
		
		switch ($opcion) {
        	case "inhabilitar":
        		$variable="pagina=".$miPaginaActual;
        		$variable.="&opcion=mensaje";
        		$variable.="&mensaje=inhabilito";
        		$variable.="&factor=".$valor['nombre_factor'];
        		break; 
        	
        	case "habilitar":
        		$variable="pagina=".$miPaginaActual;
        		$variable.="&opcion=mensaje";
        		$variable.="&mensaje=habilito";
        		$variable.="&factor=".$valor['nombre_factor'];
				break;
			
			case "nohabilitar":
				$variable="pagina=".$miPaginaActual;
				$variable.="&opcion=mensaje";
				$variable.="&mensaje=nohabilito";
				$variable.="&factor=".$valor['nombre_factor'];
				break; 
			
			case "insertoFactor":
				$variable="pagina=".$miPaginaActual;
				$variable.="&opcion=mensaje";
				$variable.="&mensaje=confirmaFactor";
				$variable.="&nombreFactor=".$valor['nombre'];
				break;
			
			case "noInsertoFactor":
				$variable="pagina=".$miPaginaActual;
				$variable.="&opcion=mensaje";
				$variable.="&mensaje=errorFactor";
				$variable.="&nombreFactor=".$valor['nombre'];
                break;
            
            case "insertoCriterio":
            	$variable="pagina=".$miPaginaActual;
            	$variable.="&opcion=mensaje";
            	$variable.="&mensaje=confirmaCriterio";
            	$variable.="&nombreCriterio=".$valor['nombre'];
                break;
            
            case "noInsertoCriterio":
            	$variable="pagina=".$miPaginaActual;
            	$variable.="&opcion=mensaje";
            	$variable.="&mensaje=errorCriterio";
            	$variable.="&nombreCriterio=".$valor['nombre'];
            	break;
            
            case "editoFactor":
            	$variable="pagina=".$miPaginaActual;
            	$variable.="&opcion=mensaje";
            	$variable.="&mensaje=confirmaEditaFactor";
            	$variable.="&id_factor=".$valor['id_factor'];
            	$variable.="&nombreFactor=".$valor['nombreFactor'];
            	break;
            	
            case "noEditoFactor":
            	$variable="pagina=".$miPaginaActual;
            	$variable.="&opcion=mensaje";
            	$variable.="&mensaje=errorEditaFactor";
            	$variable.="&id_factor=".$valor['id_factor'];
            	$variable.="&nombreFactor=".$valor['nombreFactor'];
            	break;

        	case "paginaPrincipal" :
				$variable = "pagina=" . $miPaginaActual;
				break;
		}
		
		foreach ( $_REQUEST as $clave => $valor ) {
			unset ( $_REQUEST [$clave] );
		}
		
		$url = $miConfigurador->configuracion ["host"] . $miConfigurador->configuracion ["site"] . "/index.php?";
		$enlace = $miConfigurador->configuracion ['enlace'];
		$variable = $miConfigurador->fabricaConexiones->crypto->codificar ( $variable );
		$_REQUEST [$enlace] = $enlace . '=' . $variable;
		$redireccion = $url . $_REQUEST [$enlace];
		
		echo "<script>location.replace('" . $redireccion . "')</script>";
	}
}

?>