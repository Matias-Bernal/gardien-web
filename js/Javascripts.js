/* Javascripts GardienWeb */
var reclamanteNuevo = false;
var vehiculoNuevo = false;
var piezas_disponibles = new Array(1,2,3,4,5);
var piezas_solicitadas = new Array();
var piezas = new Array();
var last_row_reclamante = -1;
var last_row_vehiculo = -1;
var id_reclamante = 0;
var id_vehiculo = 0;

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

function VerificarCambioLogin()
{
    var passOld=document.cambiarLogin.passOld;
    var passNew=document.cambiarLogin.passNew;
    var passModif=document.cambiarLogin.passModif;
    if(passOld.value==""){
        alert('INGRESE LA CONTRASEÑA ACTUAL') ;
	document.cambiarLogin.passOld.focus();
	return(false);
    }
    if(passNew.value==""){
        alert('INGRESE LA CONTRASEÑA NUEVA') ;
	document.cambiarLogin.passNew.focus();
	return(false);
    }
    if(passModif.value==""){
        alert('INGRESE NUAVAMENTE LA CONTRASEÑA NUEVA') ;
	document.cambiarLogin.passModif.focus();
	return(false);
    }
    if(passNew.value!=passModif.value){
        alert('LA CONTRASEÑA NUEVA Y SU REPETICIÓN NO COINCIDEN, INGRESELAS NUEVAMENTE') ;
	return(false);
    }
    document.cambiarLogin.submit();
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
	return (a=='0' || a=='1' || a=='2' || a=='3' || a=='4' || a=='5' || a=='6' || a=='7' || a=='8' || a=='9');
}

function ContarTexto(actual, cajita, max)
{
	if (actual.value.length > max)       {
		actual.value = actual.value.substring(0, max);
		alert("No puede ingresar mas texto");
	}else
		cajita.value = max - actual.value.length;
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
			"<table width='450'>"+
			"		<tr> <td width=300 style='text-align:left;'>*Nombre y Apeliido:</td> <td style='text-align:left;'><input type='text' style='width: 420px;' name='nombre_reclamante_nuevo' id='nombre_reclamante_nuevo' maxlength='256'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>*DNI/CUIT:</td> <td style='text-align:left;'><p> <input type='text' style='width: 200px;' name='dni_reclamante_nuevo' id='dni_reclamante_nuevo' maxlength='11'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>*Telefono:</td> <td style='text-align:left;'><p> <input type='text' style='width: 420px;'name='telefono_reclamante_nuevo' id='telefono_reclamante_nuevo'maxlength='256'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>Email:</td> <td style='text-align:left;'><p> <input type='text' style='width: 420px;' name='email_reclamante_nuevo' id='email_reclamante_nuevo'maxlength='256'></td> </tr>"+
			"</table> "+
			"<table width='450'>"+
			"		<tr align=\"center\">"+
			"			<td><input name='agregar_reclamante' id='agregar_reclamante' type='button' onclick='agregarNuevoReclamante()' value='AGREGAR'></td>"+
			"			<td><input name='cancelar_reclamante' id='cancelar_reclamante' type='button' onclick='cancelarNuevoReclamante()' value='CANCELAR'></td>"+
			"		</tr>"+
			"</table> "+
			"<p>* Datos OBLIGATORIOS</p>";
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
	if(nombre!="" && dni!="" && tel!=""){
		nombre = nombre.replace(/\s/g,"%20");
		dni= dni.replace(/\s/g,"%20");
		tel = tel.replace(/\s/g,"%20");
		email = email.replace(/\s/g,"%20");
		// aca abajo podira usar el load que devuelve el estado si hay un error
		$('#div_reclamantes').load('agregar.php?agregar_reclamante=1&nombre='+nombre+'&dni='+dni+
					'&tel='+tel+'&email='+email);
		reclamanteNuevo= false;
	}else{
		alert('Faltan datos obligatorios. Intente Nuevamente');
	}
}
function cargarModelos(nomMarca){
	var value = nomMarca.options[nomMarca.selectedIndex].value;
	$('#modelo_nuevo').load('agregar.php?cargar_marca='+value);
}

// Vehiculo Nuevo
function nuevoVehiculo()
{
	if(!vehiculoNuevo && id_reclamante!=0){
		vehiculoNuevo= true;
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_vehiculo_nuevo";
		NvoCampo.innerHTML=
			"<table width='450'>"+
			"		<tr> <td width=300 style='text-align:left;'>*Nombre del Titular:</td> <td style='text-align:left;'><input type='text' style='width: 420px;' name='titular_nuevo' id='titular_nuevo' maxlength='256'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>*Dominio:</td> <td style='text-align:left;'><input type='text' style='width: 200px;' name='dominio_nuevo' id='dominio_nuevo' maxlength='6'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>*Vin:</td> <td style='text-align:left;'><input type='text' style='width: 420px;' name='vin_nuevo' id='vin_nuevo' maxlength='17'></td> </tr>"+
			"		<tr> <td width=300 style='text-align:left;'>*Marca:</td> <td style='text-align:left;'>"+
			"			<select style='width: 420px;' name='marca_nuevo' id='marca_nuevo' onchange=\"cargarModelos(this)\">" +
			"				<option>RENAULT</option>" +
			"				<option>NISSAN</option>" +
			"			</select> </td>"+
			"		</tr>"+ 
			"		<tr> <td width=300 style='text-align:left;'>*Modelo:</td> <td style='text-align:left;'>"+
			"			<select style='width: 420px;' name='modelo_nuevo' id='modelo_nuevo'>" +
			"			</select> </td>"+
			"		</tr>"+
			"</table> "+
			"<table width='450'>"+
			"		<tr align=\"center\">"+
			"			<td><input name='agregar_vehiculo' id='agregar_vehiculo' type='button' onclick=\"agregarNuevoVehiculo()\" value='AGREGAR'></td>"+
			"			<td><input name='cancelar_vehiculo' id='cancelar_vehiculo' type='button' onclick=\"cancelarNuevoVehiculo()\" value='CANCELAR'></td>"+
			"		</tr>"+
			"</table> "+
			"<p>* Datos OBLIGATORIOS</p>";
		var contenedor= document.getElementById("contenedor_nuevo_vehiculo");
		contenedor.appendChild(NvoCampo);
	}else{
		alert('SELECCIONE PRIMERO UN RECLAMANTE');
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
	if(titular!="" && dominio!="" && vin!="" && marca!="" && modelo!=""){
		titular = titular.replace(/\s/g,"%20");
		dominio= dominio.replace(/\s/g,"%20");
		vin = vin.replace(/\s/g,"%20");
		marca = marca.replace(/\s/g,"%20");
		modelo = modelo.replace(/\s/g,"%20");
		// aca abajo podira usar el load que devuelve el estado si hay un error
		$('#div_vehiculos').load('agregar.php?agregar_vehiculo='+reclamante+'&titular='+titular+'&dominio='+dominio+
		 			'&vin='+vin+'&marca='+marca+'&modelo='+modelo);
		vehiculoNuevo= false;
	}else{
		alert('Faltan datos obligatorios. Intente Nuevamente');
	}
}

// Piezas pedidas
function agregarPieza()
{
	if(piezas_solicitadas.length < 5){
		var pieza = piezas_disponibles.shift();
		piezas_solicitadas = piezas_solicitadas.concat(pieza);
		var NvoCampo= document.createElement("div");
		NvoCampo.id= "divcampo_"+(pieza);
		piezas = piezas.concat(NvoCampo.id);
		NvoCampo.innerHTML= 
			"<table>" +
			"	<thead>"+
			"		<tr><th width='200' align=center>* Numero Pieza</th><th width='300' align=center>Descripcion</th><th width= '50'></th></tr>"+
			"	</thead>" +
			"   <tr>" +
			"     <td align=center width='200' nowrap='nowrap'>" +
			"        <input type='text' size='35'name='pieza_" + pieza + "' id='pieza_" + pieza + "' maxlength='25'>" +
			"     </td>" +
			"     <td align=center width='300' nowrap='nowrap'>" +
			"        <input type='text' size='55' name='descripcion_" + pieza + "' id='descripcion_" + pieza + "' maxlength='255'>" +
			"     </td>" +
			"     <td align=center>" +
			"        <input name='quitar_pieza' id='quitar_pieza' type='button' onclick='quitarPieza(" + pieza +");' value='QUITAR'>" +
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

  var i = piezas.indexOf("divcampo_" + iddiv); // Localizamos el indice del elemento en array
  if(i!=-1) piezas.splice(i, 1);

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
	id_reclamante = idReclamante;
	//$('#div_tabla_vehiculos').load('agregar.php?cargar_vehiculo='+idReclamante);
	$('#div_tabla_vehiculos').load('tablasExternas.php?id_reclamante='+idReclamante+' #cargar_vehiculo');
}

function guardarVehiculo(idVehiculo,id_fila_vehiculo)
{
	if(last_row_vehiculo != -1){
		document.getElementById(last_row_vehiculo).style.backgroundColor = '#FFFFFF';
	}
	document.getElementById(id_fila_vehiculo).style.backgroundColor = '#FF0000';
	last_row_vehiculo = id_fila_vehiculo;
	id_vehiculo = idVehiculo;
	document.cookie='id_vehiculo='+idVehiculo;
}

function armarEmail(){
	var aceptacion=document.pedido.archivo.value;
	if(id_reclamante==0){
		alert('DEBE SELECCIONAR UN RECLAMANTE') ;
	}else{
		if(id_vehiculo==0){
			alert('DEBE SELECCIONAR UN VEHICULO') ;
		}else{
			if(piezas_solicitadas.length < 1){
				alert('DEBE SOLICITAR AL MENOS UNA PIEZA') ;
			}else{
				var piezas_html = "";
				for(i=0;i<piezas_solicitadas.length;i++){
					num_pieza = document.getElementById('pieza_'+ piezas_solicitadas[i]).value;
					desc = document.getElementById('descripcion_'+ piezas_solicitadas[i]).value;
					piezas_html = piezas_html+' <p>PIEZA '+i+': NUMERO DE PIEZA: '+num_pieza+' DESCRIPCION: '+desc+'</p>';
				}
				document.cookie ='piezas_pedidas='+piezas_html;
				var datos_adicionales = document.getElementById('datos_Adicionales').value;
				document.cookie ='datos_adicionales='+datos_adicionales;
				if(aceptacion!=""){
					var archivo = document.getElementById('archivo').value;
					document.cookie ='archivo='+archivo;
					document.pedido.submit();
				}else{
					alert('DEBE ADJUNTAR EL FORMULARIO DE ACEPTACION DE CARGOS') ;
				}
			}
		}
	}
}

function verPedido(idPedido){
	window.location.href = 'verPedido.php?id_pedido='+idPedido;
}