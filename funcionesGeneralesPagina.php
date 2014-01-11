<?php
	require_once ("persistencia/UsuarioWeb.php");

   function logo() {
     echo "<div class='logo'> \n";
     echo "<div id='logoImg'> <img src=\"images/renault.png\"  width='80' height='101' border='0'/> </div>";
     echo "<div id='logoNombre'> Gardien Web </div>";
     echo "<div id='logoGardien'> <img src=\"images/nissan.png\"  width='80' height='101' border='0'/> </div> \n";
     echo "</div> \n";
   }
  
    function sinLoginPagina(){
     echo "<div id='menu'> \n";
     echo "<h3 class='titulo'>Ud. no puede visualizar esta p&aacute;gina</h3>\n";
     echo "</div> \n";
   }
   
   function mensajeAlerta($msj){
     echo "<div id='menu'> \n";
     echo "<h3 class='titulo'>$msj</h3>\n";
     echo "</div> <br/>\n";
   }
   
   function mensajeOk($msj){
     echo "<div id='menu'> \n";
     echo "<h3 class='titulo'>$msj</h3>\n";
     echo "</div> <br/>\n";
   }
   
   function selectSINO($param,$value){
   	$return="<select name='$param' >";
   	if ($value=='SI'){
    	$return = $return."<option value='SI' selected> SI </option>\n";
   	}else{
    	$return = $return."<option value='SI' > SI </option>\n";
   	}
    if ($value=='NO'){
    	$return = $return."<option value='NO' selected> NO </option>\n";
    }else{
    	$return = $return."<option value='NO' > NO </option>\n";
    }
    $return = $return."</select>\n";
    return $return;
   }
   
    function getHTMLScriptFecha($nombreComponente){
		$html = "";
		$html = $html."<script>\n";
		 $html = $html."$(function() {       \n";
		 $html = $html."    $('#$nombreComponente').datetimepicker({ \n";
		 $html = $html."               defaultDate: \"+1w\",    ";
		 $html = $html."               showTimepicker: false,    ";
		 $html = $html."       		   numberOfMonths: 1, ";
		 $html = $html."               dateFormat: 'dd/mm/yy',";
		 $html = $html."               showOn: 'button', \n";
		 $html = $html."               buttonImage: 'extras/pluging/timepicker-addon/calendar.gif', \n";
		 $html = $html."               buttonImageOnly: true\n";
		 $html = $html."    }); ".
		               " $.datepicker.regional['es'] = {
       			           closeText: 'Cerrar',
        		           prevText: '<Ant',
        		           nextText: 'Sig>',
        		           currentText: 'Hoy',
        		           monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        		           monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        		           dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        		           dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        		           dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        		           weekHeader: 'Sm',
        		           firstDay: 1,
        		           isRTL: false,
        		           showMonthAfterYear: false,
        		           yearSuffix: ''
    		};
    		$.datepicker.setDefaults($.datepicker.regional['es']);";
		 $html = $html." }) ";
		 $html = $html. "</script>\n";
		 return $html;
	 }
	 
	 function getHTMLScriptHora($nombreComponente,$hr,$min){
	 	$html = "";
	 	$html = $html."<script>\n";
		 $html = $html."$(function() {       \n";
		 $html = $html."    $('#$nombreComponente').datetimepicker({ \n";
		 $html = $html."               timeOnly: true,    ";
		 $html = $html."               showSecond: false,    ";
		 $html = $html."               hour: ".$hr.", \n";
	     $html = $html."               minute: ".$min.", \n";
		 $html = $html."               timeFormat: 'hh:mm', \n";
		 $html = $html."               showOn: 'button', \n";
		 //  $html = $html."              buttonImage: 'extras/pluging/timepicker-addon/calendar.gif', \n";
		 $html = $html."               buttonImageOnly: true\n";
		 $html = $html."    }); ".
		               " $.datepicker.regional['es'] = {
       			           closeText: 'Cerrar',
        		           prevText: '<Ant',
        		           nextText: 'Sig>',
        		           currentText: 'Hoy',
        		           monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        		           monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        		           dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        		           dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        		           dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        		           weekHeader: 'Sm',
        		           firstDay: 1,
        		           isRTL: false,
        		           showMonthAfterYear: false,
        		           yearSuffix: ''
    		};
    		$.datepicker.setDefaults($.datepicker.regional['es']);";
		 $html = $html." }) ";
		 $html = $html. "</script>\n";
		 return $html;
	 }

	 //formato de DB a formulario
  function convertirFechaDB_Form($dateString){ // from yyyy-dd-mm to dd-mm-yyyy
   if ($dateString!=""){
   	$day = substr($dateString,8,2);
   	$month = substr($dateString,5,2);
   	$year = substr($dateString,0,4);
   	$fecha=$day."/".$month."/".$year;
   	return $fecha;
   }
   else
     return $dateString;
  }
  
   //formato formulario a base de datos
  function convertirFechaForm_DB($fecha){  // from dd-mm-yyyy to yyyy-dd-mm
     $dateValue = $fecha;
    $year = substr($fecha,6,4);
     $month = substr($fecha,3,2);
     $day = substr($fecha,0,2);

     $dateValue=$year."-".$month."-".$day;
     return $dateValue;
  }
  //formato de BD a formulario - fechahora
  function convertirFechaHoraDB_Form($dateHrString){
  	if ($dateHrString!=""){
  	$hora = substr($dateHrString,11,8);	
   	$day = substr($dateHrString,8,2);
   	$month = substr($dateHrString,5,2);
   	$year = substr($dateHrString,0,4);
   	$fecha=$day."/".$month."/".$year." ".$hora;
   	return $fecha;
   }
   else
     return $dateHrString;
  }

  //formato de BD a formulario - fechahora
  function convertirFechaHoraForm_DB($fecha){  // from dd-mm-yyyy to yyyy-dd-mm
     $dateValue = $fecha;
     $year = substr($fecha,6,4);
     $month = substr($fecha,3,2);
     $day = substr($fecha,0,2);
     $hora = substr($dateHrString,11,8);	
     $dateValue=$year."-".$month."-".$day." ".$hora;
     return $dateValue;
  }
  
  function entreFechas($fecha,$fDesde,$fHasta){
  	$result=false;
  	if(verificarFechas($fDesde, $fecha)){
  		if(verificarFechas($fecha,$fHasta)){
  			$result=true;
  		}
  	}
  	return $result;
  }
  
  function verificarFechas($fechaAnt, $fechaPos) {  //el metodo retorna true si la $fAnt <= $fPos
  	$iDay=substr($fechaAnt,0,2);
  	$iMonth=substr($fechaAnt,3,2);
  	$iYear=substr($fechaAnt,6,4);
  	$fDay=substr($fechaPos,0,2);
  	$fMonth=substr($fechaPos,3,2);
  	$fYear=substr($fechaPos,6,4);
  	$result=false; //true- fecha valida false-fecha invalida

  	if ($fYear > $iYear){
  		$result=true;
  	} else {
  		if ($fYear == $iYear) {
  			if ($fMonth > $iMonth) {
  				$result=true;
  			}else{
  				if ($fMonth == $iMonth) {
  					if ($fDay > $iDay){
  						$result=true;
  					}else{
  						if($fDay == $iDay){
  							$result=true;
  						}else{
  							$result=false;
  						}
  					}
  				}else{
  					$result=false;
  				}
  			}
  		}else{
  			$result=false;
  		}
  	}
  	return $result;
  }

	 
	 /*public static String getHTMLScriptFechaYHora(String nombreComponente, String path, Date fechaMinima, Date fechaDefecto){
		 String html = "";
		 html += "<script type=\"text/javascript\">\n";
		 html += "$(function() {         " ;
		 html += "    $('#"+nombreComponente+"').datetimepicker({ ";
		 html += "               defaultDate: \"+1w\",    ";
		 html += "               hour: "+fechaDefecto.getHours()+",    ";
		 html += "               minute: "+fechaDefecto.getMinutes()+",    ";
		 if(fechaMinima!=null)
			 html += "               minDate: new Date("+(fechaMinima.getYear()+1900)+","+ fechaMinima.getMonth()+","+ fechaMinima.getDate()+"),\n";
		 html += "       		 numberOfMonths: 1, ";
		 html += "               dateFormat: 'dd/mm/yy',";
		 html += "               timeFormat: 'hh:mm', ";
		 html += "               showOn: 'button', \n";
		 html += "               buttonImage: '"+path+"js/jQuery/UI/jquery-ui-1.8.10.custom/development-bundle/demos/datepicker/images/calendar.gif', \n";
		 html += "               buttonImageOnly: true\n";
		 html += "    }); ";
		 html += " }) ";
		 html += "</script>\n";
		 return html;
	 }
	 
	 public static String getHTMLScriptHora(String nombreComponente, String path, Date fechaDefecto, boolean mostrarSeg){
		 String html = "";
		 html += "<script type=\"text/javascript\">\n";
		 html += "$(function() {         " ;
		 html += "    $('#"+nombreComponente+"').datetimepicker({ ";
		 html += "               timeOnly: true,     ";
		 html += "               showSecond: "+mostrarSeg+",  ";
		 html += "               hour: "+fechaDefecto.getHours()+",    ";
		 html += "               minute: "+fechaDefecto.getMinutes()+",    ";
		 html += "               second: "+fechaDefecto.getSeconds()+",    ";
		 String formatoHora="hh:mm";
		 if(mostrarSeg)
			 formatoHora="hh:mm:ss";
		 html += "               timeFormat: '"+formatoHora+"', ";
		 html += "               showOn: 'button', \n";
		 html += "               buttonImage: '"+path+"js/jQuery/UI/jquery-ui-1.8.10.custom/development-bundle/demos/datepicker/images/calendar.gif', \n";
		 html += "               buttonImageOnly: true\n";
		 html += "    }); ";
		 html += " }) ";
		 html += "</script>\n";
		 return html;
	 }*/
   ?>