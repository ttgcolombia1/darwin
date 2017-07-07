<?php
use gestionPublicacion\funcion\redireccion;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class consultarPerfil{
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miSql;
        var $miSesion;
        var $rutaSoporte;   
	function __construct($lenguaje, $formulario, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
		
		$this->miSql = $sql;
                
                $this->miSesion = \Sesion::singleton();
                
	}
	function miForm() {
		
            // Rescatar los datos de este bloque
            $esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
            $rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
            $rutaBloque.=$this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
            $rutaBloque.= $esteBloque['grupo'] . "/" . $esteBloque['nombre'];
            $directorio = $this->miConfigurador->getVariableConfiguracion("host");
            $directorio.= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
            $directorio.=$this->miConfigurador->getVariableConfiguracion("enlace");
            $this->rutaSoporte = $this->miConfigurador->getVariableConfiguracion ( "host" ) .$this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
            $atributosGlobales ['campoSeguro'] = 'true';
            $_REQUEST ['tiempo'] = time ();
            // -------------------------------------------------------------------------------------------------
            $conexion="estructura";
            $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
        	//identifca lo roles para la busqueda de subsistemas
            $parametro=array('consecutivo_inscrito'=>$_REQUEST['consecutivo_inscrito']);    
            $cadena_sql = $this->miSql->getCadenaSql("consultarInscritoConcurso", $parametro);
            $resultadoListaPerfil= $esteRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");
            
            $esteCampo = "marcoPerfil";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            $atributos ["leyenda"] = "<b>".$this->lenguaje->getCadena ( $esteCampo )."</b>";
            echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
            unset ( $atributos );
                {
                    if($resultadoListaPerfil)
                    {	$cajaNombre="width='15%'";
                        $mostrarHtml= "<div style ='width: 95%; padding-left: 5%;' class='cell-border'>";
                        $mostrarHtml.= "<table id='tablaPerfiles' class='table table-striped table-bordered'>";
                        $mostrarHtml.= " <tbody>";
                                $mostrarHtml.= "<tr align='center'>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('inscripcion' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['consecutivo_inscrito']."</td>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('fecha_registro' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['fecha_registro']."</td>  </tr> ";
                                $mostrarHtml.= "<tr align='center'>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('nivel_concurso' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['nivel_concurso']."</td>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('modalidad' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['modalidad']."</td>  </tr> ";
                                $mostrarHtml.= "<tr align='center'>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('nombre' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['nombre']."</td>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('perfil' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['perfil']."</td>  </tr> ";
                                $mostrarHtml.= "<tr align='center'>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('dependencia' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['dependencia']."</td>
                                                        <th class='textoAzul' $cajaNombre>".$this->lenguaje->getCadena ('area' )."</th>
                                                        <td class='table-tittle estilo_tr '>".$resultadoListaPerfil[0]['area']."</td>  </tr> ";
                        $mostrarHtml.= "</tbody>";
                        $mostrarHtml.= "</table></div>";
                        echo $mostrarHtml;
                        unset($mostrarHtml);
                    }else
                    {
                            $atributos["id"]="divNoEncontroPerfil";
                            $atributos["estilo"]="";
                       //$atributos["estiloEnLinea"]="display:none"; 
                            echo $this->miFormulario->division("inicio",$atributos);

                            //-------------Control Boton-----------------------
                            $esteCampo = "noEncontroPerfil";
                            $atributos["id"] = $esteCampo; //Cambiar este nombre y el estilo si no se desea mostrar los mensajes animados
                            $atributos["etiqueta"] = "";
                            $atributos["estilo"] = "centrar";
                            $atributos["tipo"] = 'error';
                            $atributos["mensaje"] = $this->lenguaje->getCadena($esteCampo);;
                            echo $this->miFormulario->cuadroMensaje($atributos);
                            unset($atributos); 
                            //-------------Fin Control Boton----------------------

                           echo $this->miFormulario->division("fin");
                            //------------------Division para los botones-------------------------
                    }
                }
            echo $this->miFormulario->marcoAgrupacion ( 'fin' );
            unset ( $atributos );
    }
}

$miSeleccionador = new consultarPerfil( $this->lenguaje, $this->miFormulario, $this->sql );

$miSeleccionador->miForm ();
?>