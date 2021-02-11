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

    $("#id_ciu").val("");
    $("#cod_ciu").val("");
    $("#nom_ciu").val("");

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
                            url: '../../ajax/ciudad.php?op=listar',
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
        url: "../../ajax/ciudad.php?op=guardaryeditar",
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
function mostrar(id_ciu)
{
	$.post("../../ajax/ciudad.php?op=mostrar",{id_ciu : id_ciu}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
                $("#cod_ciu").val(data.cod_pro);   
		$("#nom_ciu").val(data.nom_pro);
 		$("#id_ciu").val(data.id_pro);

 	})
}
// Función para desactivar Rol
function desactivar(id_ciu) {
    bootbox.confirm("¿Está seguro que desea desactivar esta Ciudad?", function (result) {
        if (result) {
            $.post("../../ajax/ciudad.php?op=desactivar", {id_ciu: id_ciu}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(id_ciu) {
    bootbox.confirm("¿Está seguro que desea activar esta Ciudad?", function(result) {
        if (result) {
            $.post("../../ajax/ciudad.php?op=activar", {id_ciu : id_ciu}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
// función para eliminar Rol
function eliminar(id_ciu){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva esta ciudad?", function(result){
     
        if(result){
            $.post("../../ajax/ciudad.php?op=eliminar", {id_ciu:id_ciu},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();




