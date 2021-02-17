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

    $("#codigo").val("");
    $("#ruc").val("");
    $("#nombre").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#idempresa").val("");
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
	tabla=$('#tbllistado').dataTable(
	{
            "aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//PaginaciÃ³n y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../../ajax/empresa.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//PaginaciÃ³n
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
// Funcion para guardar y editar

function guardaryeditar(e)
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/empresa.php?op=guardaryeditar",
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
function mostrar(idempresa)
{
	$.post("../../ajax/empresa.php?op=mostrar",{idempresa : idempresa}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
                
                
                $("#codigo").val(data.cod_emp);
                $("#ruc").val(data.ruc_emp);
		$("#nombre").val(data.nom_emp);
                $("#direccion").val(data.dir_emp);
                $("#telefono").val(data.dir_emp);
 		$("#idempresa").val(data.id_emp);

 	})
}
// Función para desactivar Rol
function desactivar(idempresa) {
    bootbox.confirm("¿Está seguro que desea desactivar esta Empresa?", function (result) {
        if (result) {
            $.post("../../ajax/empresa.php?op=desactivar", {idempresa: idempresa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }



    });
}

// Función para activar Rol
function activar(idempresa) {
    bootbox.confirm("¿Está seguro que desea activar esta Empresa?", function(result) {
        if (result) {
            $.post("../../ajax/empresa.php?op=activar", {idempresa : idempresa}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
// función para eliminar Rol
function eliminar(idempresa){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva esta Empresa?", function(result){
     
        if(result){
            $.post("../../ajax/empresa.php?op=eliminar", {idempresa:idempresa},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

