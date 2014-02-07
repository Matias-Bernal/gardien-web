/* Javascripts GardienWeb */
var reclamanteNuevo = false;
var vehiculoNuevo = false;
var piezas_disponibles = new Array(1,2,3,4,5);
var piezas_solicitadas = new Array();
var last_row_reclamante = -1;
var last_row_vehiculo = -1;

function VerificarLogin()
{
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

function VerificarFormularioPedido()
{
	var aceptacion=document.pedido.Aceptacion_de_Cargos;
	var reclamante=document.pedido.Reclamante;
	var telefono=document.pedido.Telefono;
	var email=document.pedido.Email;
	var titular=document.pedido.Titular;
	var dominio=document.pedido.Dominio;
	var vin=document.pedido.VIN;
	var marca=document.pedido.Marca;
	var modelo=document.pedido.Modelo;
	if(aceptacion.value==""){
		alert('Debe enviar el documento de Aceptacion de Cargos') ;
		document.pedido.Aceptacion_de_Cargos.focus();
		return(false);
	}
	if(reclamante.value==""){
		alert('Debe ingresar el nombre del reclamante') ;
		document.pedido.Reclamante.focus();
		return(false);
	}
	if(telefono.value==""){
		alert('Debe ingresar el telefono del reclamante') ;
		document.pedido.Telefono.focus();
		return(false);
	}
	if(email.value==""){
		alert('Debe ingresar el email del reclamante') ;
		document.pedido.Email.focus();
		return(false);
	}
	if(titular.value==""){
		alert('Debe ingresar el titular del vehiculo') ;
		document.pedido.Titular.focus();
		return(false);
	}
	if(dominio.value==""){
		alert('Debe ingresar el dominio del vehiculo') ;
		document.pedido.Dominio.focus();
		return(false);
	}
	if(vin.value==""){
		alert('Debe ingresar el VIN del vehiculo') ;
		document.pedido.VIN.focus();
		return(false);
	}
	if(marca.value==""){
		alert('Debe ingresar la marca del vehiculo') ;
		document.pedido.Marca.focus();
		return(false);
	}
	if(modelo.value==""){
		alert('Debe ingresar el modelo del vehiculo') ;
		document.pedido.Modelo.focus();
		return(false);
	}
	document.pedido.submit();
}

function VerificarCambioLogin()
{
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
// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila)
{
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila)
{
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url)
{
    location.href=url;
}

function validarCUIT(e)
{
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	if (tecla==0) return true;
//	patron = /[A-Za-z0-9._]/;
	patron = /[0-9-]/;
 	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function validarNro(e)
{
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	if (tecla==0) return true;
//	patron = /[A-Za-z0-9._]/;
	patron = /[0-9]/;
 	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function esNro(a)
{
	if (a!='0' && a!='1' && a!='2' && a!='3' && a!='4' && a!='5' && a!='6' && a!='7' && a!='8' && a!='9')
		return false;
	else
		return true;
}

function validarFecha(resp)
{
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

function ContarTexto(actual, cajita, max)
{
	if (actual.value.length > max)       {
		actual.value = actual.value.substring(0, max);
		alert("No puede ingresar mas texto");
	}else
		cajita.value = max - actual.value.length;
}

function validarExtensionFoto(path,foto)
{
	var ext1= path.substring(path.length-4,path.length);
	if(ext1!='.gif' &&  ext1!='.GIF' && ext1!='.jpg' &&  ext1!='.JPG' &&
			ext1!='.bmp' &&  ext1!='.BMP' && ext1!='.png' &&  ext1!='.PNG') {
		alert("Formato incorrecto de "+ foto+". Solo se permiten archivos .gif, .jpg, .png o .bmp ") ;
		return false ;
	}else
		return true;
}

function doRedirect(pagina)
{
  window.location.href = pagina;
}
// Reclamante Nuevo
function nuevoReclamante()
{
	if(!reclamanteNuevo){
		reclamanteNuevo= true;
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_reclamante_nuevo";
		NvoCampo.innerHTML=
			"<fieldset>" +
			"		<p>*Nombre y Apeliido: <input type='text' name='nombre_reclamante_nuevo' id='nombre_reclamante_nuevo' /></p><br/>" +
			"		<p>*DNI/CUIT: <input type='text' name='dni_reclamante_nuevo' id='dni_reclamante_nuevo' /></p><br/>" +
			"		<p>*Telefono: <input type='text' name='telefono_reclamante_nuevo' id='telefono_reclamante_nuevo'/></p><br/>" +
			"		<p>Email: <input type='text' name='email_reclamante_nuevo' id='email_reclamante_nuevo'/></p>" +
			"		<a href='JavaScript:cancelarNuevoReclamante();'> Cancelar </a>" +
			"		<a href='JavaScript:agregarNuevoReclamante();'> Agregar </a>" +
			"	<br/>" +
			"	</fieldset>";
		var contenedor= document.getElementById("contenedor_nuevo_reclamante");
		contenedor.appendChild(NvoCampo);
	}
}

function cancelarNuevoReclamante()
{
	var eliminar = document.getElementById("divcampo_reclamante_nuevo");
	var contenedor= document.getElementById("contenedor_nuevo_reclamante");
	contenedor.removeChild(eliminar);
	reclamanteNuevo= false;
}

function agregarNuevoReclamante()
{	
	var nombre = document.getElementById('nombre_reclamante_nuevo').value;
	var dni = document.getElementById('dni_reclamante_nuevo').value;
	var tel = document.getElementById('telefono_reclamante_nuevo').value;
	var email = document.getElementById('email_reclamante_nuevo').value;
	nombre = nombre.replace(/\s/g,"%20");
	dni= dni.replace(/\s/g,"%20");
	tel = tel.replace(/\s/g,"%20");
	email = email.replace(/\s/g,"%20");
	// aca abajo podira usar el load que devuelve el estado si hay un error
	$('#div_reclamantes').load('agregar.php?agregar_reclamante=1&nombre='+nombre+'&dni='+dni+
				'&tel='+tel+'&email='+email);
	reclamanteNuevo= false;
}
// Vehiculo Nuevo
function nuevoVehiculo()
{
	if(!vehiculoNuevo){
		vehiculoNuevo= true;
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_vehiculo_nuevo";
		NvoCampo.innerHTML=
			"<fieldset>" +
			"		<p>*Nombre del Titular: <input type='text' name='titular_nuevo' id='titular_nuevo'/></p><br/>" +
			"		<p>*Dominio: <input type='text' name='dominio_nuevo' id='dominio_nuevo'/></p><br/>" +
			"		<p>*Vin: <input type='text' name='vin_nuevo' id='vin_nuevo'/></p><br/>" +
			"		<p>*Marca: <select name='marca_nuevo' id='marca_nuevo'>" +
			"			<option>RENAULT</option>" +
			"			<option>NISSAN</option>" +
			"			</select></p><br/>" +
			"		<p>*Modelo: <select name='modelo_nuevo' id='modelo_nuevo'>" +
			"			<option>MEGANE III</option>" +
			"			<option>LOGAN</option>" +
			"			<option>MARCH</option>" +
			"			<option>FRONTIER</option>" +
			"			</select></p><br/>" +
			"		<a href='JavaScript:cancelarNuevoVehiculo();'> Cancelar </a><br/>" +
			"		<a href='JavaScript:agregarNuevoVehiculo();'> Agregar </a>" +
			"</fieldset>";
		var contenedor= document.getElementById("contenedor_nuevo_vehiculo");
		contenedor.appendChild(NvoCampo);
	}
}

function cancelarNuevoVehiculo()
{
	var eliminar = document.getElementById("divcampo_vehiculo_nuevo");
	var contenedor= document.getElementById("contenedor_nuevo_vehiculo");
	contenedor.removeChild(eliminar);
	vehiculoNuevo= false;
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function agregarNuevoVehiculo()
{	
	var reclamante = readCookie('id_reclamante');
	var titular = document.getElementById('titular_nuevo').value;
	var dominio = document.getElementById('dominio_nuevo').value;
	var vin = document.getElementById('vin_nuevo').value;
	var marca = document.getElementById('marca_nuevo').value;
	var modelo = document.getElementById('modelo_nuevo').value;
	titular = titular.replace(/\s/g,"%20");
	dominio= dominio.replace(/\s/g,"%20");
	vin = vin.replace(/\s/g,"%20");
	marca = marca.replace(/\s/g,"%20");
	modelo = modelo.replace(/\s/g,"%20");
	// aca abajo podira usar el load que devuelve el estado si hay un error
	$('#div_vehiculos').load('agregar.php?agregar_vehiculo='+reclamante+'&titular='+titular+'&dominio='+dominio+
	 			'&vin='+vin+'&marca='+marca+'&modelo='+modelo);
	vehiculoNuevo= false;
}

// Piezas pedidas
function agregarPieza()
{
	if(piezas_solicitadas.length < 5){
		var pieza = piezas_disponibles.shift();
		piezas_solicitadas = piezas_solicitadas.concat(pieza);
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_"+(pieza);
		NvoCampo.innerHTML= 
			"<table>" +
			"	<thead>"+
			"		<tr><th width='200' align=center>* Numero Pieza</th><th width='300' align=center>Descripcion</th><th width= '50'></th></tr>"+
			"	</thead>" +
			"   <tr>" +
			"     <td align=center width='200' nowrap='nowrap'>" +
			"        <input type='text' size='35'name='pieza_" + pieza + "' id='pieza_" + pieza + "'>" +
			"     </td>" +
			"     <td align=center width='300' nowrap='nowrap'>" +
			"        <input type='text' size='55' name='descripcion_" + pieza + "' id='descripcion_" + pieza + "'>" +
			"     </td>" +
			"     <td align=center>" +
			"        <a href='JavaScript:quitarPieza(" + pieza +");'> Quitar </a>" +
			"     </td>" +
			"   </tr>" +
			"</table>";
		var contenedor= document.getElementById("contenedorpiezas");
		contenedor.appendChild(NvoCampo);
	}
}

function quitarPieza(iddiv)
{
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor = document.getElementById("contenedorpiezas");
  contenedor.removeChild(eliminar);
  piezas_disponibles = piezas_disponibles.concat(iddiv);
  var idx = piezas_solicitadas.indexOf(iddiv); // Localizamos el indice del elemento en array
  if(idx!=-1) piezas_solicitadas.splice(idx, 1); // Lo borramos definitivamente
}

function cargarVehiculos(idReclamante,id_fila_reclamante)
{
	if(last_row_reclamante != -1){
		document.getElementById(last_row_reclamante).style.backgroundColor = '#FFFFFF';
	}
	document.getElementById(id_fila_reclamante).style.backgroundColor = '#FF0000';
	last_row_reclamante = id_fila_reclamante;
	last_row_vehiculo = -1;
	document.cookie='id_reclamante='+idReclamante;
	$('#div_tabla_vehiculos').load('tablasExternas.php?id_reclamante='+idReclamante+' #cargar_vehiculo');
}

function guardarVehiculo(idVehiculo,id_fila_vehiculo)
{
	if(last_row_vehiculo != -1){
		document.getElementById(last_row_vehiculo).style.backgroundColor = '#FFFFFF';
	}
	document.getElementById(id_fila_vehiculo).style.backgroundColor = '#FF0000';
	last_row_vehiculo = id_fila_vehiculo;
	document.cookie='id_vehiculo='+idVehiculo;
}

function armarEmail(){
	var piezas_html = "";
	for(i=0;i<piezas_solicitadas.length;i++){
		num_pieza = document.getElementById('pieza_'+ piezas_solicitadas[i]).value;
		desc = document.getElementById('descripcion_'+ piezas_solicitadas[i]).value;
		piezas_html = piezas_html+' <p>PIEZA '+i+': NUMERO DE PIEZA: '+num_pieza+' DESCRIPCION: '+desc+'</p>';
	}
	document.cookie ='piezas_pedidas='+piezas_html;
	// var archivo = document.getElementById('archivo').value;
	// document.cookie ='archivo='+archivo;
	var datos_adicionales = document.getElementById('datos_Adicionales').value;
	document.cookie ='datos_adicionales='+datos_adicionales;
}