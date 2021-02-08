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

    $("#nombre").val("");
    $("#idpventa").val("");
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
                            url: '../../ajax/pventa.php?op=listar',
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
        url: "../../ajax/pventa.php?op=guardaryeditar",
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
function mostrar(idpventa)
{
	$.post("../../ajax/pventa.php?op=mostrar",{idpventa : idpventa}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nom_pdv);
 		$("#idpventa").val(data.id_pdv);

 	})
}
// Función para desactivar Rol
function desactivar(idpventa) {
    bootbox.confirm("¿Está seguro que desea desactivar este Banco?", function (result) {
        if (result) {
            $.post("../../ajax/pventa.php?op=desactivar", {idpventa: idpventa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(idpventa) {
    bootbox.confirm("¿Está seguro que desea activar este Banco?", function(result) {
        if (result) {
            $.post("../../ajax/pventa.php?op=activar", {idpventa : idpventa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
// función para eliminar Rol
function eliminar(idpventa){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva este Banco?", function(result){
     
        if(result){
            $.post("../../ajax/pventa.php?op=eliminar", {idpventa:idpventa},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

