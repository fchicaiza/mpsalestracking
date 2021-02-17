/* global bootbox */

var tabla;

//Función que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e)
    {
        guardaryeditar(e);
    });
}

function limpiar() {

    $("#des_cap").val("");
    $("#nom_cap").val("");
    $("#enl_cap").val("");
    $("#mat_cap").val("");
    $("#fec_cap").val("");
    $("#id_cap").val("");
}

//Función mostrar formulario
function mostrarform(flag) {

    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }

}

// funcion para cancelar formulario

function cancelarform() {
    limpiar();
    mostrarform(false);
}

// funcion para listar
// No olvides convencer al cliente de cambiar JQuery por Fetch o HttpRequest  
//Función Listar
function listar()
{
    tabla = $('#tbllistado').dataTable(
            {
                "aProcessing": true, //Activamos el procesamiento del datatables
                "aServerSide": true, //Paginación y filtrado realizados por el servidor
                dom: 'Bfrtip', //Definimos los elementos del control de tabla
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf' 
                ],
                "ajax":
                        {
                            url: '../../ajax/capacitacion.php?op=listar',
                            type: "get",
                            dataType: "json",
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        },
                "bDestroy": true,
                "iDisplayLength": 5, //Paginación
                "order": [[0, "desc"]]//Ordenar (columna,orden)
            }).DataTable();
}

// Funcion para guardar y editar

function guardaryeditar(e)
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/capacitacion.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    
    limpiar();
    
}
function mostrar(id_cap)
{
	$.post("../../ajax/capacitacion.php?op=mostrar",{id_cap : id_cap}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#des_cap").val(data.des_cap);
                $("#nom_cap").val(data.nom_cap);
                $("#enl_cap").val(data.enl_cap);
                $("#mat_cap").val(data.mat_cap);
                $("#fec_cap").val(data.fec_cap);
 		$("#id_cap").val(data.id_cap);

 	})
}
// Función para desactivar Rol
function desactivar(id_cap) {
    bootbox.confirm("¿Está seguro que desea desactivar esta Capacitacion?", function (result) {
        if (result) {
            $.post("../../ajax/capacitacion.php?op=desactivar", {id_cap: id_cap}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(id_cap) {
    bootbox.confirm("¿Está seguro que desea activar esta Capacitacion?", function(result) {
        if (result) {
            $.post("../../ajax/capacitacion.php?op=activar", {id_cap : id_cap}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
// función para eliminar Rol
function eliminar(id_cap){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva esta Capacitacion?", function(result){
     
        if(result){
            $.post("../../ajax/capacitacion.php?op=eliminar", {id_cap:id_cap},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

