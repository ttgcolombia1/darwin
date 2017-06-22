<?php
namespace gestionConcurso\detalleConcurso\funcion;
use gestionConcurso\detalleConcurso\funcion\redireccion;
include_once ('redireccionar.php');

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorCalendarioConcurso {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;
    var $miLogger;
    var $miArchivo;

    function __construct($lenguaje, $sql, $funcion, $miLogger,$miArchivo) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
        $this->miLogger= $miLogger;
        $this->miArchivo = $miArchivo;
    }

    function procesarFormulario() {
        $conexion="estructura";
	$esteRecursoDB=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        $arregloDatos = array('consecutivo_calendario'=>$_REQUEST['consecutivo_calendario'],
                              'consecutivo_concurso'=>$_REQUEST['consecutivo_concurso'],
                              'consecutivo_actividad'=>$_REQUEST['consecutivo_actividad'],
                              'descripcion'=>$_REQUEST['descripcion'],
                              'fecha_inicio'=>$_REQUEST['fecha_inicio_calendario'],
                              'fecha_fin'=>$_REQUEST['fecha_fin_calendario'],
                              'consecutivo_evaluar'=>!isset($_REQUEST['consecutivo_evaluar'])?0:$_REQUEST['consecutivo_evaluar'],
                              'estado'=>$_REQUEST['estado']
            );
        if($arregloDatos['consecutivo_calendario']==0)
             {  $cadenaSql = $this->miSql->getCadenaSql ( 'registroCalendarioConcurso',$arregloDatos );
                $resultadoCalendario = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "registra", $arregloDatos, "registroCalendarioConcurso" );
                $_REQUEST['consecutivo_calendario']=$resultadoCalendario;
             }
        else {  $cadenaSql = $this->miSql->getCadenaSql ( 'actualizaCalendarioConcurso',$arregloDatos );
                $resultadoCalendario = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "actualiza", $arregloDatos, "actualizarCalendarioConcurso" );
             }
        if($resultadoCalendario)
            {   //$_REQUEST['consecutivo']=0;$_REQUEST['consecutivo_persona'];
                //$_REQUEST['consecutivo_dato']=$_REQUEST['consecutivo_concurso'];
                //$this->miArchivo->procesarArchivo('datosConcurso');
                redireccion::redireccionar('actualizoCalendarioConcurso',$arregloDatos);  exit();
            }else
            {   $arregloDatos['detalle']='calendario';
                redireccion::redireccionar('noActualizoDetalle',$arregloDatos);  exit();
            }
  
    }

    function resetForm() {
        foreach ($_REQUEST as $clave => $valor) {

            if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
                unset($_REQUEST [$clave]);
            }
        }
    }

}

$miRegistrador = new RegistradorCalendarioConcurso($this->lenguaje, $this->sql, $this->funcion,$this->miLogger,$this->miArchivo);
$resultado = $miRegistrador->procesarFormulario();
?>