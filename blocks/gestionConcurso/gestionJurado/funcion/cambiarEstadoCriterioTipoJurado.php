<?php

namespace gestionConcurso\gestionJurado\funcion;

use gestionConcurso\gestionJurado\funcion\redireccion;

include_once ('redireccionar.php');

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class CambiarEstado {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;
    var $miLogger;

    function __construct($lenguaje, $sql, $funcion, $miLogger) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
        $this->miLogger= $miLogger;
    }

    function procesarFormulario() {

        $conexion="estructura";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $parametro['estado']=$_REQUEST['estado'];
        $parametro['id_tipo']=$_REQUEST['id_tipo'];
        $parametro['id_criterio']=$_REQUEST['id_criterio'];
        $this->cadena_sql = $this->miSql->getCadenaSql("cambiarEstadoCriterioTipoJurado", $parametro);
        $resultadoEstado = $esteRecursoDB->ejecutarAcceso($this->cadena_sql, "acceso", $parametro, "actualizarEstadoCriterioTipoJurado");

        if($resultadoEstado){
            redireccion::redireccionar($_REQUEST['opcion'], $_REQUEST);
    		}else{
            redireccion::redireccionar('no'.$_REQUEST['opcion'], $_REQUEST);
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

$miRegistrador = new CambiarEstado($this->lenguaje, $this->sql, $this->funcion,$this->miLogger);

$resultado = $miRegistrador->procesarFormulario();
?>
