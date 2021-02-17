var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	//Cargamos los items al select categoria
	$.post("../../ajax/persona.php?op=selecRol", function(r){
	            $("#idrol").html(r);
	            $('#idrol').selectpicker('refresh');

	});
        
        $.post("../../ajax/persona.php?op=selecEmpresa", function(r){
	            $("#idempresa").html(r);
	            $('#idempresa').selectpicker('refresh');

	});
        
}
//FunciÃ³n limpiar
function limpiar()
{
    $("#dni").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#idempresa").val("");
    $("#idrol").val("");
}

//FunciÃ³n mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//FunciÃ³n cancelarform
function cancelarform()
{
    limpiar();
    mostrarform(false);
}

//FunciÃ³n Listar
function listar()
{
    tabla = $('#tbllistado').dataTable(
            {
                "aProcessing": true, //Activamos el procesamiento del datatables
                "aServerSide": true, //PaginaciÃ³n y filtrado realizados por el servidor
                dom: 'Bfrtip', //Definimos los elementos del control de tabla
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
                "ajax":
                        {
                            url: '../../ajax/persona.php?op=listar',
                            type: "get",
                            dataType: "json",
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        },
                "bDestroy": true,
                "iDisplayLength": 5, //PaginaciÃ³n
                "order": [[0, "desc"]]//Ordenar (columna,orden)
            }).DataTable();
}
//FunciÃ³n para guardar o editar

function guardaryeditar(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/persona.php?op=guardaryeditar",
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


//funcion para mostrar datos antes de editar
function mostrar(idpersona) {

    $.post("../../ajax/persona.php?op=mostrar", {idpersona: idpersona}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idrol").val(data.id_rol_per);
        $('#idrol').selectpicker('refresh');
        $("#idempresa").val(data.cod_emp_per);
        $('#idempresa').selectpicker('refresh');
        $("#dni").val(data.dni_per);
        $("#nombre").val(data.nom_per);
        $("#apellido").val(data.ape_per);
        $("#telefono").val(data.tel_per);
        $("#email").val(data.ema_per);
        $("#idpersona").val(data.id_per);

    });
}

//Funcion para desactivar categoria
function desactivar(idpersona)
{

    bootbox.confirm("¿Está seguro de desctivar el registro?", function (result) {
        if (result)
        {
            $.post("../../ajax/persona.php?op=desactivar", {idpersona: idpersona}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });

        }
    });

}

//Funcion para activar categoria
function activar(idpersona)
{

    bootbox.confirm("¿Está seguro de activar el registro?", function (result) {
        if (result)
        {
            $.post("../../ajax/persona.php?op=activar", {idpersona: idpersona}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });

        }
    });

}

//Funcion para eliminar person
function eliminar(idpersona)
{

    bootbox.confirm("¿Está seguro de eliminar de forma definitiva el registro?", function (result) {
        if (result)
        {
            $.post("../../ajax/persona.php?op=eliminar", {idpersona:idpersona}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });

        }
    });

}




init();