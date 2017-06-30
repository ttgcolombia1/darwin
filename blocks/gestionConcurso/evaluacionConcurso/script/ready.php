<?php
//Se coloca esta condición para evitar cargar algunos scripts en el formulario de confirmación de entrada de datos.
//if(!isset($_REQUEST["opcion"])||(isset($_REQUEST["opcion"]) && $_REQUEST["opcion"]!="confirmar")){

?>
$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');

    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) {
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) {
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) {
    	$(this).find('.btn').toggleClass('btn-info');
    }

    $(this).find('.btn').toggleClass('btn-default');

});


$('#tablaConcursos').DataTable({
"language": {
    "lengthMenu": "Mostrar _MENU_ registro por p&aacute;gina",
    "zeroRecords": "No se encontraron registros coincidentes",
    "info": "Mostrando _PAGE_ de _PAGES_ p&aacute;ginas",
    "infoEmpty": "Ninguna hay datos registrados",
    "infoFiltered": "(filtrado de un m&aacute;ximo de _MAX_)",
    "search": "Buscar:",
    "paginate": {
                "first":      "Primera",
                "last":       "&Uacute;ltima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
},
"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
});



$('#tablaConsultaCalendario').DataTable({
"language": {
    "lengthMenu": "Mostrar _MENU_ registro por p&aacute;gina",
    "zeroRecords": "No se encontraron registros coincidentes",
    "info": "Mostrando _PAGE_ de _PAGES_ p&aacute;ginas",
    "infoEmpty": "Ninguna hay datos registrados",
    "infoFiltered": "(filtrado de un m&aacute;ximo de _MAX_)",
    "search": "Buscar:",
    "paginate": {
                "first":      "Primera",
                "last":       "&Uacute;ltima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
},
"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
});

$('#tablaConsultaInscrito').DataTable({
"language": {
    "lengthMenu": "Mostrar _MENU_ registro por p&aacute;gina",
    "zeroRecords": "No se encontraron registros coincidentes",
    "info": "Mostrando _PAGE_ de _PAGES_ p&aacute;ginas",
    "infoEmpty": "Ninguna hay datos registrados",
    "infoFiltered": "(filtrado de un m&aacute;ximo de _MAX_)",
    "search": "Buscar:",
    "paginate": {
                "first":      "Primera",
                "last":       "&Uacute;ltima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
},
"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
});

// Asociar el widget de validación al formulario detalleConcurso
$("#detalleConcurso").validationEngine({
    promptPosition : "centerRight",
    scroll: false
});

$(function() {
    $("#detalleConcurso").submit(function() {
        $resultado=$("#detalleConcurso").validationEngine("validate");
        if ($resultado) {
            return true;
        }
        return false;
    });


});

<?php /*?>
               $('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('option', 'maxDate', lockDate);
			 },
			 onClose: function() {
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_final')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }

	   });
 <?php */?>


$('#<?php echo $this->campoSeguro('fecha_inicio_concurso')?>').datepicker({
        <?php /*?>timeFormat: 'HH:mm:ss',<?php */?>
        dateFormat: 'yy-mm-dd',
        <?php /*?> maxDate: 0,<?php */?>
         minDate: 0,
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        yearRange: '+0:+5',
        <?php /*?>permite asirnara a otro campo como fecha minima */?>
        onSelect: function(dateText, inst) {
        var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio_concurso')?>').datepicker('getDate'));
        //lockDate.setDate(lockDate.getDate() + 1);
        $('input#<?php echo $this->campoSeguro('fecha_fin_concurso')?>').datepicker('option', 'minDate', lockDate);}
   });

$('#<?php echo $this->campoSeguro('fecha_fin_concurso')?>').datepicker({
        <?php /*?>timeFormat: 'HH:mm:ss',<?php */?>
        dateFormat: 'yy-mm-dd',
       <?php /*?> maxDate: 0,<?php */?>
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        yearRange: '-50:+0'
   });



$('#<?php echo $this->campoSeguro('fecha_inicio_calendario')?>').datepicker({
        <?php /*?>timeFormat: 'HH:mm:ss',<?php */?>
        dateFormat: 'yy-mm-dd',
        <?php /*?> maxDate: 0,<?php */?>
         minDate: '<?php echo isset($_REQUEST['inicio_concurso'])?$_REQUEST['inicio_concurso']:''?>',
         maxDate: '<?php echo isset($_REQUEST['cierre_concurso'])?$_REQUEST['cierre_concurso']:''?>',
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        yearRange: '+0:+5',
        <?php /*?>permite asirnara a otro campo como fecha minima */?>
        onSelect: function(dateText, inst) {
        var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio_calendario')?>').datepicker('getDate'));
        //lockDate.setDate(lockDate.getDate() + 1);
        $('input#<?php echo $this->campoSeguro('fecha_fin_calendario')?>').datepicker('option', 'minDate', lockDate);}
   });

$('#<?php echo $this->campoSeguro('fecha_fin_calendario')?>').datepicker({
        <?php /*?>timeFormat: 'HH:mm:ss',<?php */?>
        dateFormat: 'yy-mm-dd',
        maxDate: '<?php echo isset($_REQUEST['cierre_concurso'])?$_REQUEST['cierre_concurso']:''?>',
        changeYear: true,
        changeMonth: true,
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        yearRange: '-50:+0'
   });

        $(function() {
		$(document).tooltip();
	});

	// Asociar el widget tabs a la división cuyo id es tabs
	$(function() {
		$("#tabs").tabs();
	});

        $(function() {
            $("button").button().click(function(event) {
                    event.preventDefault();
            });
        });
$('#<?php echo $this->campoSeguro('tipo')?>').width(210);
$("#<?php echo $this->campoSeguro('tipo')?>").select2();
$('#<?php echo $this->campoSeguro('modalidad')?>').width(210);
$("#<?php echo $this->campoSeguro('modalidad')?>").select2();
$('#<?php echo $this->campoSeguro('consecutivo_factor')?>').width(450);
$("#<?php echo $this->campoSeguro('consecutivo_factor')?>").select2();
$('#<?php echo $this->campoSeguro('consecutivo_criterio')?>').width(450);
$("#<?php echo $this->campoSeguro('consecutivo_criterio')?>").select2();
$('#<?php echo $this->campoSeguro('consecutivo_actividad')?>').width(450);
$("#<?php echo $this->campoSeguro('consecutivo_actividad')?>").select2();
$('#<?php echo $this->campoSeguro('consecutivo_evaluar')?>').width(450);
$("#<?php echo $this->campoSeguro('consecutivo_evaluar')?>").select2();

    <?php
//}



?>
