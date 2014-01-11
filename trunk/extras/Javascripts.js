/* Javascripts itMantenimiento */

function VerificarLogin(){
	var usr=document.ingresar.usuario;
	var pass=document.ingresar.password;
	if(usr.value==""){
		alert('Ingrese un nombre de usuario') ;
		document.ingresar.usuario.focus();
		return(false);
	}
	if(pass.value==""){
		alert('Ingrese una contraseña') ;
		document.ingresar.password.focus();
		return(false);
	}
	document.ingresar.submit();
}

function ValidarNuevaCondicionIva(){
	var desc=document.datosCondicionIva.descripcion;
	if(desc.value==""){
		alert('Ingrese una descripción') ;
		document.datosCondicionIva.descripcion.focus();
		return(false);
	}
	document.datosCondicionIva.submit();
}

function ValidarNuevaProvincia(){
	var desc=document.datosProvincia.nombre;
	if(desc.value==""){
		alert('Ingrese un nombre') ;
		document.datosProvincia.nombre.focus();
		return(false);
	}
	document.datosProvincia.submit();
}

function ValidarNuevoTipoTarea(){
	var desc=document.datosTipoTarea.nombre;
	if(desc.value==""){
		alert('Ingrese un nombre') ;
		document.datosTipoTarea.nombre.focus();
		return(false);
	}
	document.datosTipoTarea.submit();
}

function ValidarNuevaLocalidad(){
	var desc=document.datosLocalidad.nombre;
	var prov=document.datosLocalidad.provincia;
	if(desc.value==""){
		alert('Ingrese un nombre') ;
		document.datosLocalidad.nombre.focus();
		return(false);
	}
	if(prov.value==""){
		alert('Seleccione una localidad') ;
		document.datosLocalidad.provincia.focus();
		return(false);
	}
	document.datosLocalidad.submit();
}

function ValidarNuevaEmpresa(){
	var tipo=document.datosEmpresa.tipoEmpresa;
	var rSoc=document.datosEmpresa.razonSocial;
	var nFantasia=document.datosEmpresa.nombreFantasia;
	var loc =document.datosEmpresa.localidad;
	var cIva =document.datosEmpresa.condicionIva;
	if(tipo.value==""){
		alert('Seleccione un tipo de empresa') ;
		document.datosEmpresa.tipoEmpresa.focus();
		return(false);
	}
	if(rSoc.value==""){
		alert('Ingrese la razón social') ;
		document.datosEmpresa.razonSocial.focus();
		return(false);
	}
	if(nFantasia.value==""){
		alert('Ingrese el nombre de fantasia') ;
		document.datosEmpresa.nombreFantasia.focus();
		return(false);
	}
	if(loc.value==""){
		alert('Seleccione una localidad') ;
		document.datosEmpresa.localidad.focus();
		return(false);
	}
	if(cIva.value==""){
		alert('Seleccione una condición de Iva') ;
		document.datosEmpresa.condicionIva.focus();
		return(false);
	}
	document.datosEmpresa.submit();
}

function ValidarNuevaUbicacion(){
	var ubicacion=document.datosUbicacion.ubicacion;
	var empresa=document.datosUbicacion.empresa;
	if(ubicacion.value==""){
		alert('Ingrese una ubicación') ;
		document.datosUbicacion.ubicacion.focus();
		return(false);
	}
	if(empresa.value==""){
		alert('Seleccione una empresa') ;
		document.datosUbicacion.empresa.focus();
		return(false);
	}
	document.datosUbicacion.submit();
}

function ValidarNuevoPersonal(){
	var apNombre=document.datosPersonal.apellidoNombre;
	var localidad=document.datosPersonal.localidad;
	if(apNombre.value==""){
		alert('Ingrese el apellido y nombre') ;
		document.datosPersonal.apellidoNombre.focus();
		return(false);
	}
	if(localidad.value==""){
		alert('Seleccione una localidad') ;
		document.datosPersonal.localidad.focus();
		return(false);
	}
	document.datosPersonal.submit();
}

function ValidarNuevaTarea(){
	var nombre=document.datosTarea.nombre;
	var tipoTarea=document.datosTarea.tipoTarea;
	var tipoMantenimiento=document.datosTarea.tipoMantenimiento;
	if(nombre.value==""){
		alert('Ingrese el nombre') ;
		document.datosTarea.nombre.focus();
		return(false);
	}
	if(tipoTarea.value==""){
		alert('Seleccione un tipo de tarea') ;
		document.datosTarea.tipoTarea.focus();
		return(false);
	}
	if(tipoMantenimiento.value==""){
		alert('Seleccione un tipo de mantenimiento') ;
		document.datosTarea.tipoMantenimiento.focus();
		return(false);
	}
	document.datosTarea.submit();
}

function ValidarNuevoUsuario(cantEmp){
    var nombre=document.datosUsuario.nombre;
    var pass=document.datosUsuario.pass;
    if(nombre.value==""){
        alert('Ingrese el nombre') ;
	document.datosUsuario.nombre.focus();
	return(false);
    }
    if(pass.value==""){
        alert('Ingrese la contraseña') ;
	document.datosUsuario.pass.focus();
	return(false);
    }

    /*var empr=false;
    for(var i=0;i<cantEmp){
        var empresa=document.datosUsuario.empresas[i];
        alert(empresa.checked);
        if(empresa.checked)
          empr=true;
    }
    if(!empr){
        alert('Seleccione al menos una empresa') ;
	return(false);
    }           */
	document.datosUsuario.submit();
}

function ValidarNuevoTablero(){
    var nombre=document.datosTablero.nombre;
    var ubicacion=document.datosTablero.ubicacion;
    if(nombre.value==""){
        alert('Ingrese el nombre') ;
	document.datosTablero.nombre.focus();
	return(false);
    }
    if(ubicacion.value==""){
        alert('Seleccione una ubicación') ;
	document.datosTablero.ubicacion.focus();
	return(false);
    }
    document.datosTablero.submit();
}

function ValidarNuevoEquipo(){
    var nombre=document.datosEquipo.nombre;
    var ubicacion=document.datosEquipo.ubicacion;
    if(nombre.value==""){
        alert('Ingrese el nombre') ;
	document.datosEquipo.nombre.focus();
	return(false);
    }
    if(ubicacion.value==""){
        alert('Seleccione una ubicación') ;
	document.datosEquipo.ubicacion.focus();
	return(false);
    }
    document.datosEquipo.submit();
}

function VerificarCambioLogin(){
    var passOld=document.cambiarLogin.passOld;
    var passNew=document.cambiarLogin.passNew;
    var passModif=document.cambiarLogin.passModif;
    if(passOld.value==""){
        alert('Ingrese la contraseña Actual') ;
	document.cambiarLogin.passOld.focus();
	return(false);
    }
    if(passNew.value==""){
        alert('Ingrese la contraseña Nueva') ;
	document.cambiarLogin.passNew.focus();
	return(false);
    }
    if(passModif.value==""){
        alert('Ingrese nuavamente la contraseña Nueva') ;
	document.cambiarLogin.passModif.focus();
	return(false);
    }
    if(passNew.value!=passModif.value){
        alert('La contraseña Nueva y su Repetición no coinciden, ingreselas nuevamente') ;
	return(false);
    }
    document.cambiarLogin.submit();
}

function actualizarHrs(indice,ultHs){
  var valor=document.getElementById("lapsoHrs_"+indice).value;
    document.getElementById("faltanHrs_"+indice).innerHTML=(valor-ultHs);
}

function actualizarKms(indice,ultKm){
  var valor=document.getElementById("lapsoKms_"+indice).value;
  document.getElementById("faltanKms_"+indice).innerHTML=(valor-ultKm);
}

function actualizarTareaSeleccionadaTMP(val,nombre,tipoMant){
    var ord=document.getElementById('ordenTMP').value;
    document.getElementById("idTarea_"+ord).value = val;
    document.getElementById("nombreTarea_"+ord).innerHTML = "("+val+") "+nombre;
    document.getElementById("tipoTarea_"+ord).innerHTML = tipoMant;
    $('#ventanaModalTablaTareas').dialog('close');
}

function mostrarTablaTareas(orden){
	document.getElementById('ordenTMP').value=orden;
	$('#ventanaModalTablaTareas').dialog('open');
}

 //window.opener..location.reload();
//http://geeks.ms/blogs/jalarcon/archive/2011/10/15/truco-c-243-mo-detectar-el-cierre-o-la-salida-de-una-p-225-gina-web.aspx

function borrarTarea(ord){
    document.getElementById("idTarea_"+ord).value = "";
    document.getElementById("nombreTarea_"+ord).innerHTML = "";
    document.getElementById("tipoTarea_"+ord).innerHTML = "";
    document.getElementById("lapsoHrs_"+ord).value = "0";
    document.getElementById("lapsoKms_"+ord).value = "0";
    document.getElementById("faltanHrs_"+ord).innerHTML = "0";
    document.getElementById("faltanKms_"+ord).innerHTML = "0";
}

function agregarFilasTMP(idEq,tipoEq,limReg){
     var i;
     for(i=1;i<=limReg;i++){
         if( document.getElementById("lapsoHrs_"+i).value != "0" || document.getElementById("lapsoKms_"+i).value != "0"){
           if( document.getElementById("idTarea_"+i).value == ""){
             alert("Seleccione la tarea de la fila "+i);
             return false;
           }
         }
     }
     document.datosRiesgosEpp.action="gestionTareasMantPreventivo.php?accion=agregar&idEqTab="+idEq;
     datosRiesgosEpp.submit();
}

function agregarFilasERelevados(limReg){
     var i;
     for(i=1;i<=limReg;i++){
         if( document.getElementById("hrsRelev_"+i).value != "0" || document.getElementById("kmsRelev_"+i).value != "0"){
           if( document.getElementById("idEqTabT_"+i).value == ""){
             alert("Seleccione el equipo de la fila "+i);
             return false;
           }
         }
     }
     document.datosRelevamiento.action="amvRelevamiento.php?accion=agregar";
     datosRelevamiento.submit();
}

function confirmarTMP(limReg){
    var i;
     for(i=1;i<=limReg;i++){
         if( document.getElementById("lapsoHrs_"+i).value != "0" || document.getElementById("lapsoKms_"+i).value != "0"){
           if( document.getElementById("idTarea_"+i).value == ""){
             alert("Seleccione la tarea de la fila "+i);
             return false;
           }
         }
     }
      datosRiesgosEpp.submit();
}

function mostrarTablaEquipos(orden){
    document.getElementById('ordenEqRel').value=orden;
    $('#ventanaModalTablaEquipos').dialog('open');
}

function actualizarEquipoTabSeleccionadoRel(limReg,id,nombre,regHr,regKm,ultRegHr,ultRegKm){
  var ord=document.getElementById('ordenEqRel').value;
     for(i=1;i<=limReg;i++){
         if( i!=ord && document.getElementById("idEqTabT_"+i).value == id){
           alert("Dicho Equipo ya se selecciono en este relevamiento");
           return false;
         }
     }

    document.getElementById("idEqTabT_"+ord).value = id;
    document.getElementById("nombreEq_"+ord).innerHTML = nombre;
    document.getElementById("regHrs_"+ord).innerHTML = regHr;
    document.getElementById("regKms_"+ord).innerHTML = regKm;
    if(regHr=="NO"){
      document.getElementById("hrsRelev_"+ord).readOnly = true;
    }
    if(regKm=="NO"){
      document.getElementById("kmsRelev_"+ord).readOnly = true;
    }
    document.getElementById("ultRegHrs_"+ord).innerHTML = ultRegHr;
    document.getElementById("ultRegKms_"+ord).innerHTML = ultRegKm;

    $('#ventanaModalTablaEquipos').dialog('close');
}




function borrarEqTab(ord){
    document.getElementById("idEqTabT_"+ord).value = "";
    document.getElementById("nombreEq_"+ord).innerHTML = "";
    document.getElementById("regHrs_"+ord).innerHTML = "SI";
    document.getElementById("regKms_"+ord).innerHTML = "SI";
    document.getElementById("hrsRelev_"+ord).value = "0";
    document.getElementById("kmsRelev_"+ord).value = "0";
}

function validarCUIT(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	if (tecla==0) return true;
//	patron = /[A-Za-z0-9._]/;
	patron = /[0-9-]/;
 	te = String.fromCharCode(tecla);
	return patron.test(te);
}


function validarNro(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	if (tecla==0) return true;
//	patron = /[A-Za-z0-9._]/;
	patron = /[0-9]/;
 	te = String.fromCharCode(tecla);
	return patron.test(te);
}


/*   Javascripts Centro Argentino de Jubilados   */

/* ................ Funciones de Uso General ................ */

function esNro(a){
	if (a!='0' && a!='1' && a!='2' && a!='3' && a!='4' && a!='5' && a!='6' && a!='7' && a!='8' && a!='9')
		return false;
	else
		return true;
}

function validarFecha(resp){
	var dot='/';
	var rta =true;
	if(resp.length!=10){
		rta = false;
	}else{
		for(i=0;i<resp.length;i++){
			if(i!=2 && i!=5){
				if(!esNro(resp.charAt(i))) {
					rta = false;
				}
			}else{
				if(resp.charAt(i)!='/'){
					rta = false;
				}
			}
		}
	}
	if(!rta){
		alert("Por favor ingrese una fecha con el siguiente formato: (dd/mm/aaaa)");
		document.getElementById("fecha").focus();
	}
	return rta;
}

function ContarTexto(actual, cajita, max) {
	if (actual.value.length > max)       {
		actual.value = actual.value.substring(0, max);
		alert("No puede ingresar mas texto");
	}else
		cajita.value = max - actual.value.length;
}

function validarExtensionFoto(path,foto){
	var ext1= path.substring(path.length-4,path.length);
	if(ext1!='.gif' &&  ext1!='.GIF' && ext1!='.jpg' &&  ext1!='.JPG' &&
			ext1!='.bmp' &&  ext1!='.BMP' && ext1!='.png' &&  ext1!='.PNG') {
		alert("Formato incorrecto de "+ foto+". Solo se permiten archivos .gif, .jpg, .png o .bmp ") ;
		return false ;
	}else
		return true;
}



function doRedirect(pagina){
  window.location.href = pagina;
}
