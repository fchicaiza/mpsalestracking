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

    $("#descripcion").val("");
    $("#idtpago").val("");
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
                            url: '../../ajax/tpago.php?op=listar',
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
        url: "../../ajax/tpago.php?op=guardaryeditar",
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
function mostrar(idtpa)
{
	$.post("../../ajax/tpago.php?op=mostrar",{idtpa : idtpa}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#descripcion").val(data.des_tpa);
 		$("#idtpago").val(data.id_tpa);

 	});
}
// Función para desactivar Rol
function desactivar(idtpa) {
    bootbox.confirm("¿Está seguro que desea desactivar este tipo de pago?", function (result) {
        if (result) {
            $.post("../../ajax/tpago.php?op=desactivar", {idtpa: idtpa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(idtpa) {
    bootbox.confirm("¿Está seguro que desea activar este Banco?", function(result) {
        if (result) {
            $.post("../../ajax/tpago.php?op=activar", {idtpa : idtpa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
// función para eliminar Rol
function eliminar(idtpa){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva este Banco?", function(result){
     
        if(result){
            $.post("../../ajax/tpago.php?op=eliminar", {idtpa:idtpa},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

